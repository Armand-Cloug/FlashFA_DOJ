<?php
require_once __DIR__ . '/../includes/header_admin.php';
require_once __DIR__ . '/../includes/navbar_admin.php';

/* ✅ Vérification du rôle de l'utilisateur */
$roles_autorises = ['Admin'];
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_autorises)) {
    die("⛔ Accès refusé.");
}
?>

<body class="accueil-body">

    <!-- ✅ Conteneur principal -->
    <div class="main-content">
        <h1>Administration</h1>

        <div class="section-container">
            <div class="card">
                Section 1 
            </div>
            <div class="card">
                Section 2
            </div>
        </div>
    </div>
</body>
</html>