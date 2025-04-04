<?php
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/session.php';
?>

<head>
<link rel="stylesheet" href="/public/assets/css/login.css">
</head>

<body class="login-body">

    <div class="login-container">
        <h2>Connexion</h2>
        <?php if (isset($_GET["error"])): ?>
            <p class="error-message">
                <?php
                switch ($_GET["error"]) {
                    case "1": echo "Email ou mot de passe incorrect."; break;
                    case "2": echo "Veuillez remplir tous les champs."; break;
                }
                ?>
            </p>
        <?php endif; ?>
        <?php if (isset($_GET["success"])): ?>
            <p class="success-message">Inscription réussie ! Connectez-vous.</p>
        <?php endif; ?>
        <?php if (isset($_SESSION["error"])): ?>
            <div class="error-message">
                <?= htmlspecialchars($_SESSION["error"]); ?>
            </div>
            <?php unset($_SESSION["error"]); // ✅ Supprime l'erreur après affichage ?>
        <?php endif; ?>
        <form action="/actions/login.php" method="POST">
            <input type="email" name="email" placeholder="Adresse email" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit">Se connecter</button>
        </form>
        <a href="register.php" class="  link">S'inscrire</a>
    </div>

</body>
</html>

