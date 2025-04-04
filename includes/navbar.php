<?php
require_once __DIR__ . '/session.php';
require_once __DIR__ . '/perm.php';

/* ✅ Définition des logos en fonction des rôles */
$role = $_SESSION['user']['role'] ?? 'Citoyen'; // Si non défini, par défaut "Citoyen"

$logos = [
    'Citoyen' => 'citoyen_logo.png',
    'SASP' => 'sasp_logo.png',
    'Etat Major' => 'sasp_logo.png',
    'Etudiant' => 'etudiant_logo.png',
    'Avocat' => 'avocat_logo.png',
    'Avocat du BAP' => 'avocat_logo.png',
    'Substitut du Procureur' => 'proc_logo.png',
    'Procureur' => 'proc_logo.png',
    'Procureur de District' => 'proc_logo.png',
    'Procureur Général' => 'proc_logo.png',
    'Juge Adjoint' => 'juge_logo.png',
    'Juge' => 'juge_logo.png',
    'Juge de District' => 'juge_logo.png',
    'Admin' => 'admin_logo.png'
];

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

        <?php $current_page = basename($_SERVER['PHP_SELF']); ?>

        <ul class="menu">
            <li><a href="../views/accueil.php" class="<?= ($current_page == 'accueil.php') ? 'active' : ''; ?>"><i class="fas fa-home"></i>🏠 Accueil</a></li>
            <li><a href="../private/profil.php" class="<?= ($current_page == 'profil.php') ? 'active' : ''; ?>"><i class="fas fa-user"></i>👤 Mon Profil</a></li>
            <li><a href="../private/code.php" class="<?= ($current_page == 'code.php') ? 'active' : ''; ?>"><i class="fas fa-book"></i>📖 Codes de Lois</a></li>
            <li><a href="../private/avis.php" class="<?= ($current_page == 'avis.php') ? 'active' : ''; ?>"><i class="fas fa-book"></i>🚨 Avis de Recherche</a></li>

            <!-- ⚖️ Menu Justice -->
            <?php if (in_array($_SESSION['user']['role'], $roles_justice)): ?>
                <li><a href="../private/mandat.php" class="<?= ($current_page == 'mandat.php') ? 'active' : ''; ?>"><i class="fas fa-book"></i>📝 Mandats</a></li>
                <li><a href="../private/code_etat.php" class="<?= ($current_page == 'code_etat.php') ? 'active' : ''; ?>"><i class="fas fa-book"></i>🔴 Code d'Etat</a></li> 
                <li><a href="../private/prison.php" class="<?= ($current_page == 'prison.php') ? 'active' : ''; ?>"><i class="fas fa-book"></i>🔒 Prisonnier</a></li>
                <li><a href="../private/jugement.php" class="<?= ($current_page == 'jugement.php') ? 'active' : ''; ?>"><i class="fas fa-book"></i>⚖️ Jugements</a></li>
                <li><a href="../private/reglement_bareau.php" class="<?= ($current_page == 'reglement_bareau.php') ? 'active' : ''; ?>"><i class="fas fa-book"></i>📕 Réglements Barreau</a></li>
                <li><a href="../private/reglement_doj.php" class="<?= ($current_page == 'reglement_doj.php') ? 'active' : ''; ?>"><i class="fas fa-book"></i>📘 Réglements du DOJ</a></li>
            <?php endif; ?>
            
            <!-- 🏛 Menu des Procureurs et Juges -->
            <?php if (in_array($_SESSION['user']['role'], $roles_proc)): ?>
                <li><a href="../private/dossier.php" class="<?= ($current_page == 'dossier.php') ? 'active' : ''; ?>"><i class="fas fa-book"></i>📂 Dossier d'accusation</a></li>
            <?php endif; ?>
            
            <!-- 👨‍⚖️ Menu des avocats -->
            <?php if (in_array($_SESSION['user']['role'], $roles_avocats)): ?>
                <li><a href="../private/def.php" class="<?= ($current_page == 'def.php') ? 'active' : ''; ?>"><i class="fas fa-book"></i>📂 Dossier de défense</a></li>
            <?php endif; ?>
            
            <!-- ❔ Bouton pour aller à la page d'aide -->
            <li><a href="../private/aide.php" class="<?= ($current_page == 'aide.php') ? 'active' : ''; ?>"><i class="fas fa-book"></i>❔ Aide </a></li>
            
            <!-- 🛠 Menu des Admins -->
            <?php if ($_SESSION['user']['role'] === 'Admin'): ?>
                <li><a href="../private/admin.php" class="<?= ($current_page == 'admin.php') ? 'active' : ''; ?>"><i class="fas fa-tools"></i>⚙️ Admin</a></li>
            <?php endif; ?>
            
            <!-- Bouton seulement présent pour le dev -->
            <li><a href="../actions/logout.php" class="<?= ($current_page == 'logout.php') ? 'active' : ''; ?>"><i class="fas fa-book"></i>🔧 DEV LOGOUT</a></li>
        </ul>


    <?php else: ?>
        <!-- ❌ Affichage si NON connecté -->
        <div class="profile-section">
            <p>Vous n'êtes pas connecté.</p>
            <a href="/views/login.php" class="login-btn"><i class="fas fa-sign-in-alt"></i> Se connecter</a>
        </div>
    <?php endif; ?>
</div>