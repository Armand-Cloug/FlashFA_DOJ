<?php
session_start();

// Définir les pages accessibles sans connexion
$public_pages = ['accueil.php', 'login.php', 'register.php'];

// Récupérer le nom de la page actuelle
$current_page = basename($_SERVER['PHP_SELF']);

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user']) && !in_array($current_page, $public_pages)) {
    header("Location: /views/login.php");
    exit();
}
?>
