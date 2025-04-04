<?php
require_once __DIR__ . '/../includes/actions.php'; // ✅ Inclusion des systèmes d'actions

// 🚀 VARIABLES DISCORD
$webhook_url_mandat = getenv('DISCORD_WEBHOOK_MANDAT');

/* ✅ Définition des rôles autorisés */
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_boss_doj)) {
    header("Location: /private/mandat.php?error=Accès refusé.");
    exit;
}

// ✅ Fonction pour envoyer un message sur Discord en Embed
function sendDiscordEmbed($title, $description, $fields, $color = 16711680) {
    global $webhook_url_mandat; // ✅ Utilisation de la variable globale

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

    $ch = curl_init($webhook_url_mandat);
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
        $id_dossier = "0130-" . $random_part;

        // Vérifie si l'ID existe déjà en base
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM mandats WHERE id_dossier = ?");
        $stmt->execute([$id_dossier]);
        $exists = $stmt->fetchColumn();
    } while ($exists > 0);

    return $id_dossier;
}

// ✅ Générer un ID dossier unique
$id_dossier = genererIdDossier($pdo);

// ✅ Récupération et nettoyage des données du formulaire
$type = $_POST['type'] ?? '';
$cible = trim($_POST['cible'] ?? '');
$adresse = trim($_POST['adresse'] ?? '');
$duree = trim($_POST['duree'] ?? '');
$motif = trim($_POST['motif'] ?? '');
$auteur = trim($_POST['auteur'] ?? '');
$status = 'Actif';

// ✅ Vérifier si "biens" est un tableau avant d'utiliser `implode`
$biens = isset($_POST['biens']) ? implode(", ", $_POST['biens']) : null;

// ✅ Vérification des champs obligatoires
if (empty($type) || empty($cible) || empty($motif) || empty($auteur)) {
    header("Location: /private/ajouter_mandat.php?error=Tous les champs obligatoires doivent être remplis.");
    exit;
}

// ✅ Générer un lien unique pour le mandat
function genererLienUnique($length = 12) {
    return bin2hex(random_bytes($length / 2));
}
$lien_unique = genererLienUnique();

try {
    // ✅ Insertion en base de données
    $stmt = $pdo->prepare("INSERT INTO mandats (id_dossier, type, cible, adresse, duree, biens, motif, auteur, status, lien_unique) 
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$id_dossier, $type, $cible, $adresse, $duree, $biens, $motif, $auteur, $status, $lien_unique]);

    // ✅ Récupérer l'ID du mandat ajouté
    $record_id = $pdo->lastInsertId();

    // 📝 Enregistrer l'action dans les logs
    log_action($_SESSION['user']['id'], 'INSERT', 'mandats', $record_id, [
        'id_dossier' => $id_dossier,
        'type' => $type,
        'cible' => $cible,
        'adresse' => $adresse,
        'duree' => $duree,
        'biens' => $biens,
        'motif' => $motif,
        'auteur' => $auteur,
        'status' => $status,
        'lien_unique' => $lien_unique
    ]);

    // ✅ Générer un lien pour voir le mandat
    $lien_mandat = "https://dev-doj.cloug.fr/private/mandat.php?lien=" . $lien_unique;

    // ✅ Définition du type de mandat pour Discord
    $discord_types = [
        "arrestation" => "Mandat d'Arrestation",
        "perquisition" => "Mandat de Perquisition",
        "amener" => "Mandat d'Amener",
        "fermeture_temporaire" => "Mandat de Fermeture Administrative Temporaire",
        "fermeture_definitive" => "Mandat de Fermeture Administrative Définitive"
    ];
    $discord_type = $discord_types[$type] ?? "Type de mandat inconnu";

    // ✅ **Création de l'Embed Discord**
    $embedTitle = "📝 Nouveau Mandat Publié !";
    $embedDescription = "Un nouveau mandat a été enregistré!";
    $embedFields = [
        ["name" => "🏷️ Type de Mandat", "value" => $discord_type, "inline" => false],
        ["name" => "🎯 Cible du Mandat", "value" => $cible, "inline" => true],
        ["name" => "👤 Auteur du Mandat", "value" => $auteur, "inline" => true],
        ["name" => "🔍 Motif", "value" => $motif, "inline" => false],
        ["name" => "🔗 Lien du mandat", "value" => "[🔗 Accéder au Mandat]($lien_mandat)", "inline" => false]
    ];

    sendDiscordEmbed($embedTitle, $embedDescription, $embedFields);

    // ✅ Redirection après ajout
    header("Location: /private/mandat.php?success=1");
    exit;
} catch (PDOException $e) {
    error_log("Erreur lors de l'ajout du mandat : " . $e->getMessage());
    header("Location: /private/ajouter_mandat.php?error=Erreur lors de l'ajout du mandat.");
    exit;
}
