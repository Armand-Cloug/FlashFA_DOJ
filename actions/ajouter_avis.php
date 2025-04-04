<?php
require_once __DIR__ . '/../includes/actions.php'; // ✅ Inclusion des systèmes d'actions

// 🚀 VARIABLES DISCORD
$webhook_url_avis = getenv('DISCORD_WEBHOOK_AVIS');

/* ✅ Vérification du rôle de l'utilisateur */
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_boss_doj)) {
    header("Location: /private/avis.php?error=Accès refusé.");
    exit;
}

// ✅ Fonction pour envoyer un message sur Discord en Embed
function sendDiscordEmbed($title, $description, $fields, $color = 16711680) {
    global $webhook_url_avis;

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

    $ch = curl_init($webhook_url_avis);
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
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM avis WHERE id_dossier = ?");
        $stmt->execute([$id_dossier]);
        $exists = $stmt->fetchColumn();
    } while ($exists > 0);

    return $id_dossier;
}

// ✅ Générer un ID dossier unique
$id_dossier = genererIdDossier($pdo);

// ✅ Récupération et nettoyage des données du formulaire
$nom_cible = trim($_POST['nom_cible'] ?? '');
$naissance_cible = trim($_POST['naissance_cible'] ?? '');
$alias_cible = trim($_POST['alias_cible'] ?? '');
$prime = trim($_POST['prime'] ?? '');
$motif = trim($_POST['motif'] ?? '');
$taille_cible = trim($_POST['taille_cible'] ?? '');
$poids_cible = trim($_POST['poids_cible'] ?? '');
$yeux_cible = trim($_POST['yeux_cible'] ?? '');
$auteur = trim($_POST['auteur'] ?? '');
$status = 'Actif';

// ✅ Vérification des champs obligatoires
if (empty($nom_cible) || empty($naissance_cible) || empty($alias_cible) || empty($motif) || empty($taille_cible) || empty($poids_cible) || empty($yeux_cible) || empty($auteur)) {
    header("Location: /private/ajouter_avis.php?error=Tous les champs obligatoires doivent être remplis.");
    exit;
}

// ✅ Générer un lien unique pour l'avis
function genererLienUnique($length = 12) {
    return bin2hex(random_bytes($length / 2));
}
$lien_unique = genererLienUnique();

try {
    // ✅ Insertion en base de données
    $stmt = $pdo->prepare("INSERT INTO avis (id_dossier, nom_cible, naissance_cible, alias_cible, prime, motif, taille_cible, poids_cible, yeux_cible, auteur, status, lien_unique) 
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->execute([
        $id_dossier, $nom_cible, $naissance_cible, $alias_cible, $prime, $motif, $taille_cible, $poids_cible, $yeux_cible, $auteur, $status, $lien_unique
    ]);

    // ✅ Récupérer l'ID de l'avis ajouté
    $record_id = $pdo->lastInsertId();

    // 📝 Enregistrer l'action dans les logs
    log_action($_SESSION['user']['id'], 'INSERT', 'avis', $record_id, [
        'id_dossier' => $id_dossier,
        'nom_cible' => $nom_cible,
        'naissance_cible' => $naissance_cible,
        'alias_cible' => $alias_cible,
        'prime' => $prime,
        'motif' => $motif,
        'taille_cible' => $taille_cible,
        'poids_cible' => $poids_cible,
        'yeux_cible' => $yeux_cible,
        'auteur' => $auteur,
        'status' => $status,
        'lien_unique' => $lien_unique
    ]);

    // ✅ **Création de l'Embed Discord**
    $embedTitle = "🚨 Nouvel avis de recherche publié !";
    $embedDescription = "Un nouvel avis de recherche a été enregistré!";
    $embedFields = [
        ["name" => "🆔 ID Dossier", "value" => $id_dossier, "inline" => true],
        ["name" => "🎯 Cible", "value" => $nom_cible, "inline" => true],
        ["name" => "📅 Naissance", "value" => $naissance_cible, "inline" => true],
        ["name" => "🆔 Alias", "value" => $alias_cible, "inline" => true],
        ["name" => "📏 Taille", "value" => $taille_cible, "inline" => true],
        ["name" => "⚖️ Poids", "value" => $poids_cible, "inline" => true],
        ["name" => "👀 Yeux", "value" => $yeux_cible, "inline" => true],
        ["name" => "✍️ Auteur", "value" => $auteur, "inline" => false],
        ["name" => "💰 Prime", "value" => !empty($prime) ? $prime . "$" : "Aucune", "inline" => false],
        ["name" => "🔗 Lien de l'avis", "value" => "[Accéder à l'avis](https://dev-doj.cloug.fr/private/" . $lien_unique . ")", "inline" => false]
    ];

    sendDiscordEmbed($embedTitle, $embedDescription, $embedFields);

    header("Location: /private/avis.php?success=1");
    exit;
} catch (PDOException $e) {
    error_log("Erreur lors de l'ajout de l'avis : " . $e->getMessage());
    header("Location: /private/ajouter_avis.php?error=Erreur lors de l'ajout de l'avis.");
    exit;
}
