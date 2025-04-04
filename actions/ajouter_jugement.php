<?php
require_once __DIR__ . '/../includes/actions.php'; // ✅ Inclusion des systèmes d'actions

// 🚀 VARIABLES DISCORD
$webhook_url_jugement = getenv('DISCORD_WEBHOOK_JUGEMENT');

// ✅ Vérification de l'authentification
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_boss_doj)) {
    header("Location: /private/jugement.php?error=⛔ Accès refusé.");
    exit;
}

// ✅ Fonction pour envoyer un message sur Discord en Embed
function sendDiscordEmbed($title, $description, $fields, $color = 16711680) {
    global $webhook_url_jugement; // ✅ Utilisation de la variable globale

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

    $ch = curl_init($webhook_url_jugement);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

// ✅ Fonction générique pour générer un id_dossier unique
function genererIdDossier($pdo, $prefix, $table) {
    do {
        $random_part = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $id_dossier = $prefix . "-" . $random_part;

        // Vérifie si l'ID existe déjà en base
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM $table WHERE id_dossier = ?");
        $stmt->execute([$id_dossier]);
        $exists = $stmt->fetchColumn();
    } while ($exists > 0);

    return $id_dossier;
}

// ✅ Générer les ID pour chaque table avec leur préfixe respectif
$id_dossier_jugement = genererIdDossier($pdo, "0140", "jugement");
$id_dossier_dac = genererIdDossier($pdo, "0141", "dac");
$id_dossier_def = genererIdDossier($pdo, "0142", "def");


// ✅ Vérification que les données sont bien envoyées
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nom_affaire'], $_POST['lien_dac'], $_POST['lien_def'])) {
    $nom_affaire = trim($_POST['nom_affaire']);
    $proc = !empty($_POST['proc']) ? trim($_POST['proc']) : 'Non assigné';
    $avocat = !empty($_POST['avocat']) ? trim($_POST['avocat']) : 'Non assigné';
    $lien_dac = trim($_POST['lien_dac']); // ✅ On garde le lien DAC envoyé par le formulaire
    $lien_def = trim($_POST['lien_def']); // ✅ On garde le lien DEF envoyé par le formulaire

    try {
        $pdo->beginTransaction(); // 🔹 Démarrer une transaction SQL

        // ✅ 1. Insérer le jugement
        $queryJugement = "INSERT INTO jugement (id_dossier, nom_affaire, proc, avocat, lien_dac, lien_def) 
                          VALUES (:id_dossier, :nom_affaire, :proc, :avocat, :lien_dac, :lien_def)";
        $stmtJugement = $pdo->prepare($queryJugement);
        $stmtJugement->execute([
            'id_dossier' => $id_dossier_jugement,
            ':nom_affaire' => $nom_affaire,
            ':proc' => $proc,
            ':avocat' => $avocat,
            ':lien_dac' => $lien_dac,
            ':lien_def' => $lien_def
        ]);
        $jugement_id = $pdo->lastInsertId(); // 🔹 Récupérer l'ID du jugement ajouté

        // ✅ 2. Insérer le DAC correspondant (avec le procureur comme responsable)
        $queryDac = "INSERT INTO dac (id_dossier, nom_affaire, responsable, statut, lien_dac, lien_dc) 
                     VALUES (:id_dossier, :nom_affaire, :responsable, 'A Rédiger', :lien_dac, :lien_dc)";
        $stmtDac = $pdo->prepare($queryDac);
        $stmtDac->execute([
            'id_dossier' => $id_dossier_dac,
            ':nom_affaire' => $nom_affaire,
            ':responsable' => $proc, // ✅ Le Procureur est responsable du DAC
            ':lien_dac' => $lien_dac,
            ':lien_dc' => "" // ✅ Valeur vide pour `lien_dc`
        ]);

        // ✅ 3. Insérer le DEF correspondant (avec l'avocat comme responsable)
        $queryDef = "INSERT INTO def (id_dossier, nom_affaire, responsable, statut, lien_def) 
                     VALUES (:id_dossier, :nom_affaire, :responsable, 'A Rédiger', :lien_def)";
        $stmtDef = $pdo->prepare($queryDef);
        $stmtDef->execute([
            'id_dossier' => $id_dossier_def,
            ':nom_affaire' => $nom_affaire,
            ':responsable' => $avocat, // ✅ L'Avocat est responsable du DEF
            ':lien_def' => $lien_def
        ]);

        // ✅ 4. Récupérer et calculer la date du jugement (+5 jours à 21h45)
        $queryDate = "SELECT date_creation FROM jugement WHERE id = :id";
        $stmtDate = $pdo->prepare($queryDate);
        $stmtDate->execute([':id' => $jugement_id]);
        $dateCreation = $stmtDate->fetchColumn();

        if ($dateCreation) {
            $dateJugement = new DateTime($dateCreation);
            $dateJugement->modify('+5 days');
            $dateJugement->setTime(21, 45);
            $formattedDateJugement = $dateJugement->format('d/m/Y à H:i');
        } else {
            $formattedDateJugement = "Non défini";
        }

        $pdo->commit(); // 🔹 Valider la transaction

        // ✅ **Création de l'Embed Discord**
        $embedTitle = "⚖️ Nouveau Jugement Ajouté !";
        $embedDescription = "Un nouveau jugement a été enregistré!";

        $embedFields = [
            ["name" => "🏛 Affaire", "value" => $nom_affaire, "inline" => false],
            ["name" => "⚖ Procureur", "value" => $proc, "inline" => true],
            ["name" => "👨‍⚖ Avocat", "value" => $avocat, "inline" => true],
            ["name" => "📅 Date du Jugement", "value" => $formattedDateJugement, "inline" => false],
            ["name" => "📄 Dossier d'accusation", "value" => "[🔗 Accéder au DAC]($lien_dac)", "inline" => true],
            ["name" => "📄 Dossier de défense", "value" => "[🔗 Accéder au DEF]($lien_def)", "inline" => true],
            ["name" => "🔗 Détails", "value" => "[Accéder au Jugement](https://dev-doj.cloug.fr/private/jugement.php)", "inline" => false]
        ];

        // 🔹 Envoyer l'Embed à Discord
        sendDiscordEmbed($embedTitle, $embedDescription, $embedFields);

        // ✅ Redirection après succès
        header('Location: ../private/jugement.php?success=Jugement, DAC et DEF ajoutés avec succès.');
        exit();

    } catch (PDOException $e) {
        $pdo->rollBack(); // 🔹 Annuler la transaction en cas d'erreur
        error_log("Erreur SQL : " . $e->getMessage());
        http_response_code(500);
        exit('Erreur interne du serveur.');
    }
} else {
    http_response_code(400);
    exit('Requête invalide.');
}
?>
