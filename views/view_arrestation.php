<?php
require_once __DIR__ . '/../includes/database.php';

if (!isset($_GET['lien'])) {
    die("⛔ Accès refusé.");
}

$lien_unique = $_GET['lien'];

$stmt = $pdo->prepare("SELECT * FROM mandats WHERE lien_unique = ?");
$stmt->execute([$lien_unique]);
$avis = $stmt->fetch();

if (!$avis) {
    die("⛔ Avis introuvable.");
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

    <title>Mandat d'Arrêt - DOJ</title>
    <link rel="icon" href="/public/assets/images/juge_logo.png">

    <link rel="stylesheet" href="/public/assets/css/views/amener.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
</head>

<body>

    <h1>Avis de recherche</h1>

    <p><strong>Identifiant :</strong> <?= htmlspecialchars($avis['id']) ?></p>
    <p><strong>Identifiant du dossier :</strong> <?= htmlspecialchars($avis['id_dossier']) ?></p>
    <p><strong>Type de mandat :</strong> <?= htmlspecialchars($avis['type']) ?></p>
    <p><strong>Cible :</strong> <?= htmlspecialchars($avis['cible']) ?></p>
    <p><strong>Adresse :</strong> <?= htmlspecialchars($avis['adresse']) ?></p>
    <p><strong>Durée :</strong> <?= htmlspecialchars($avis['duree']) ?></p>
    <p><strong>Biens :</strong> <?= htmlspecialchars($avis['biens']) ?></p>
    <p><strong>Motif :</strong> <?= htmlspecialchars($avis['motif']) ?></p>
    <p><strong>Auteur :</strong> <?= htmlspecialchars($avis['auteur']) ?></p>
    <p><strong>Statut :</strong> <?= htmlspecialchars($avis['status']) ?></p>
    <p><strong>Date de création :</strong> <?= htmlspecialchars($avis['date_creation']) ?></p>
    <p><strong>Lien unique :</strong> <?= htmlspecialchars($avis['lien_unique']) ?></p>

</body>
</html>
