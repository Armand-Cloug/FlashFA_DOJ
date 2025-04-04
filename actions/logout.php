<?php
require_once __DIR__ . '/../includes/actions.php'; // ✅ Inclusion des systèmes d'actions

if (isset($_SESSION['user'])) {
    // 📝 Enregistrer l'action dans les logs avant la déconnexion
    log_action($_SESSION['user']['id'], 'LOGOUT', 'users', $_SESSION['user']['id'], [
        'email' => $_SESSION['user']['email'],
        'ip' => $_SERVER['REMOTE_ADDR'],
        'user_agent' => $_SERVER['HTTP_USER_AGENT']
    ]);
}

// ✅ Détruire la session et rediriger vers la page de connexion
session_destroy();
header("Location: /views/login.php");
exit;
?>

