<?php
require_once __DIR__ . '/../includes/header_admin.php';
require_once __DIR__ . '/../includes/navbar_admin.php';
require_once __DIR__ . '/../includes/database.php';

/* ✅ Vérification du rôle de l'utilisateur */
$roles_autorises = ['Admin'];
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_autorises)) {
    die("⛔ Accès refusé.");
}
?>

<body class="accueil-body">
    <!-- ✅ Conteneur principal -->
    <div class="main-content">
        <h1>Debug</h1>
        <div class="section-container">
            <div class="card"> Session.php
                <ul> <pre><?php print_r($_SESSION); ?></pre> </ul>
            </div>
            <div class="card"> Issues
                <?php require_once __DIR__ . '/../private/admin/issue_admin.php';?>
            </div>
            <?php require_once __DIR__ . '/../private/admin/link_admin.php';?>
            <div class="card"> Rien
                <ul> Il me faut juste une div en plus posez pas de question </ul>
            </div>
        </div>
    </div>
</body>
</html>