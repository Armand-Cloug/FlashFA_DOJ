<?php
require_once __DIR__ . '/../includes/database.php';

if (!isset($_GET['lien'])) {
    die("⛔ Accès refusé.");
}

$lien_unique = $_GET['lien'];

$stmt = $pdo->prepare("SELECT * FROM codes_etat WHERE lien_unique = ?");
$stmt->execute([$lien_unique]);
$code = $stmt->fetch();

if (!$code) {
    die("⛔ Code d'Etat introuvable.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="author" content="Cloug">
    <meta name="date" content="2025">
    <meta name="copyright" content="DOJ de San Andreas">
    <meta name="keywords" content="">
    <meta name="description" content="Site web du DOJ de FlashFA">

    <title>Code d'Etat - DOJ</title>
    <link rel="icon" href="/public/assets/images/juge_logo.png">

    <link rel="stylesheet" href="/public/assets/css/views/code.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
</head>

<body>

    <h1>Code d'Etat</h1>

    <p><strong>Identifiant :</strong> <?= htmlspecialchars($code['id']) ?></p>
    <p><strong>Identifiant Dossier :</strong> <?= htmlspecialchars($code['id_dossier']) ?></p>
    <p><strong>Couleur du Code :</strong> <?= htmlspecialchars($code['type']) ?></p>
    <p><strong>Lieu du Code :</strong> <?= htmlspecialchars($code['lieu']) ?></p>
    <p><strong>Date de début :</strong> <?= htmlspecialchars($code['date_debut']) ?></p>
    <p><strong>Date de fin :</strong> <?= htmlspecialchars($code['date_fin']) ?></p>
    <p><strong>Reponsable :</strong> <?= htmlspecialchars($code['responsable']) ?></p>
    <p><strong>Motif :</strong> <?= htmlspecialchars($code['raison']) ?></p>

</body>
</html>
