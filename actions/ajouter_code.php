<?php
require_once __DIR__ . '/../includes/actions.php'; // ✅ Inclusion des systèmes d'actions

// 🚀 VARIABLES DISCORD
$webhook_url_code = getenv('DISCORD_WEBHOOK_CODE');

// Vérification des droits
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_boss_doj_em)) {
    header("Location: /private/code_etat.php");
    exit();
}

// ✅ Fonction pour envoyer un message sur Discord en Embed
function sendDiscordEmbed($title, $description, $fields, $color = 16711680) {
    global $webhook_url_code; // ✅ Utilisation de la variable globale

    $embed = [
        "title" => $title,
        "description" => $description,
        "color" => $color,
        "fields" => $fields,
        "footer" => [
            "text" => "Département de la Justice - San Andreas",
            "icon_url" => "https://dev-doj.cloug.fr/public/assets/images/logo.png"
        ],
        "timestamp" => date("c")
    ];

    $payload = json_encode(["embeds" => [$embed], "allowed_mentions" => ["parse" => ["roles"]]]);

    $ch = curl_init($webhook_url_code);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

// ✅ Fonction pour générer un id_dossier unique au format 0130-XXXXXX
function genererIdDossier($pdo) {
    do {
        $random_part = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $id_dossier = "0131-" . $random_part;

        // Vérifie si l'ID existe déjà en base
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM codes_etat WHERE id_dossier = ?");
        $stmt->execute([$id_dossier]);
        $exists = $stmt->fetchColumn();
    } while ($exists > 0);

    return $id_dossier;
}

// ✅ Générer un ID dossier unique
$id_dossier = genererIdDossier($pdo);

// ✅ Générer un lien unique pour l'avis
function genererLienUnique($length = 12) {
    return bin2hex(random_bytes($length / 2));
}
$lien_unique = genererLienUnique();

// Vérification des champs obligatoires
if (isset($_POST['type'], $_POST['lieu'], $_POST['date_debut'], $_POST['responsable'], $_POST['motif'])
    && !empty($_POST['type'])
    && !empty($_POST['lieu'])
    && !empty($_POST['date_debut'])
    && !empty($_POST['responsable'])
) {
    $type = $_POST['type'];
    $lieu = trim($_POST['lieu']);
    $date_debut = $_POST['date_debut'];
    $date_fin = !empty($_POST['date_fin']) ? $_POST['date_fin'] : NULL;
    $responsable = trim($_POST['responsable']);
    $motif = trim($_POST['motif']);

    try {
        // Insertion du code d’état
        $query = "INSERT INTO codes_etat (id_dossier, type, lieu, date_debut, date_fin, responsable, raison, lien_unique) 
                  VALUES (:id_dossier, :type, :lieu, :date_debut, :date_fin, :responsable, :motif, :lien_unique)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            ':id_dossier' => $id_dossier,
            ':type' => $type,
            ':lieu' => $lieu,
            ':date_debut' => $date_debut,
            ':date_fin' => $date_fin,
            ':responsable' => $responsable,
            ':motif' => $motif,
            ':lien_unique' => $lien_unique,
        ]);



        // Récupérer l'ID de l’enregistrement ajouté
        $record_id = $pdo->lastInsertId();

        // Enregistrer l'action dans les logs
        log_action($_SESSION['user']['id'], 'INSERT', 'codes_etat', $record_id, [
            'id_dossier' => $id_dossier,
            'type' => $type,
            'lieu' => $lieu,
            'date_debut' => $date_debut,
            'date_fin' => $date_fin,
            'responsable' => $responsable,
            'raison' => $motif
        ]);

        // ✅ **Création de l'Embed Discord**
        $embedTitle = "🟢🟠🔴 Nouveau code déclaré !";
        $embedDescription = "Un nouveau code d'état a été enregistré!";
        $embedFields = [
            ["name" => "🆔 ID Dossier", "value" => $id_dossier, "inline" => true],
            ["name" => "🟢🟠🔴Couleur du code", "value" => $type, "inline" => false],
            ["name" => "📍 Lieu", "value" => $lieu, "inline" => false],
            ["name" => "📅 Date de début", "value" => $date_debut, "inline" => true],
            ["name" => "🏁 Date de fin", "value" => $date_fin, "inline" => true],
            ["name" => "👤 Responsable", "value" => $responsable, "inline" => false],
            ["name" => "🎯 Motif du code", "value" => $motif, "inline" => false]
        ];

        // 🔹 Envoyer l'Embed à Discord
        sendDiscordEmbed($embedTitle, $embedDescription, $embedFields);

        // Redirection après succès
        header("Location: /private/code_etat.php?success=1");
        exit();
    } catch (PDOException $e) {
        die("Erreur lors de l'ajout : " . $e->getMessage());
    }
}
