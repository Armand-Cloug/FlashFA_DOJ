<?php
require_once __DIR__ . '/session.php';

/* ✅ Définition des logos en fonction des rôles */
$role = $_SESSION['user']['role'] ?? 'Citoyen'; // Si non défini, par défaut "Citoyen"

$logos = [
    'Admin' => 'admin_logo.png'
];

// Vérifie si l'utilisateur a bien le rôle "admin" (insensible à la casse)
if (empty($_SESSION['user']['role']) || strtolower($_SESSION['user']['role']) !== 'admin') {
    header("Location: ../views/accueil.php");
    exit();
}

/* ✅ Sélection du logo */
$logo = $logos[$role] ?? 'citoyen_logo.png'; // Utilise un logo par défaut si le rôle est inconnu
?>

<head>
    <link rel="stylesheet" href="/public/assets/css/style.css">
</head>

<div class="sidebar">
    <?php if (isset($_SESSION['user']) && $_SESSION['user'] !== null): ?>
        <!-- ✅ Profil affiché si connecté -->
        <div class="profile-section">
            <img src="/public/assets/images/<?= $logo; ?>" alt="Logo de rôle">
            <h3><?= htmlspecialchars($_SESSION['user']['nom'] . ' ' . $_SESSION['user']['prenom']); ?></h3>
            <p><?= htmlspecialchars($_SESSION['user']['role']); ?></p>
        </div>

        <ul class="menu">
            <!-- 🛠 Menu des Admins -->
            <?php if ($_SESSION['user']['role'] === 'Admin'): ?>
                <li><a href="../views/accueil.php"><i class="fas fa-home"></i>🏠 Accueil</a></li>
                <li><a href="../private/admin_user.php"><i class="fas fa-tools"></i>👤 Gestions Utilisateurs</a></li>
                <li><a href="../private/admin_mandat.php"><i class="fas fa-tools"></i>📝 Gestions Mandats</a></li>
                <li><a href="../private/admin_cop.php"><i class="fas fa-tools"></i>📖 Gestions COP</a></li>
                <li><a href="../private/admin_avis.php"><i class="fas fa-tools"></i>🚨 Gestion Avis</a></li>
                <li><a href="../private/admin_prison.php"><i class="fas fa-tools"></i>🔒 Gestions Prison</a></li>
                <li><a href="../private/admin_jugement.php"><i class="fas fa-book"></i>⚖️ Gestion Jugements</a></li>
                <li><a href="../private/admin_code.php"><i class="fas fa-book"></i>🟢🟠🔴 Gestion Codes</a></li>
                <li><a href="../private/admin_logs.php"><i class="fas fa-book"></i>🗂️ Logs </a></li> 
            <?php endif; ?>

            <!-- Bouton seulement présent pour le dev -->
            <li><a href="../private/admin_debug.php"><i class="fas fa-book"></i>🔧 DEV DEBUG</a></li>
            <li><a href="../actions/logout.php"><i class="fas fa-book"></i>🔧 DEV LOGOUT</a></li>
        </ul>

    <?php else: ?>
        <!-- ❌ Affichage si NON connecté -->
        <div class="profile-section">
            <p>Vous n'êtes pas connecté.</p>
            <a href="/views/login.php" class="login-btn"><i class="fas fa-sign-in-alt"></i> Se connecter</a>
        </div>
    <?php endif; ?>
</div>