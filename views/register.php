<?php
require_once __DIR__ . '/../includes/header.php';
?>

<head>
    <link rel="stylesheet" href="/public/assets/css/login.css">
</head>

<body class="login-body"> 

    <div class="login-container"> 
        <h2>Inscription</h2>
        
        <?php if (isset($_GET["error"])): ?>
            <p class="error-message">
                <?php
                switch ($_GET["error"]) {
                    case "1": echo "L'email doit être valide et se terminer par @doj.us."; break;
                    case "2": echo "Cet email est déjà utilisé."; break;
                    case "3": echo "Une erreur est survenue, veuillez réessayer."; break;
                    case "4": echo "Veuillez remplir tous les champs."; break;
                }
                ?>
            </p>
        <?php endif; ?>

        <?php if (isset($_SESSION["error"])): ?>
            <div class="error-message">
                <?= htmlspecialchars($_SESSION["error"]); ?>
            </div>
            <?php unset($_SESSION["error"]); // ✅ Supprime l'erreur après affichage ?>
        <?php endif; ?>


        <form action="/actions/register.php" method="POST">
            <input type="text" name="nom" placeholder="Nom" required>
            <input type="text" name="prenom" placeholder="Prénom" required>
            <input type="email" name="email" placeholder="Adresse email (@doj.us)" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit">S'inscrire</button>
        </form>

        <a href="login.php" class="link">Déjà un compte ? Se connecter</a>
    </div>

</body>
</html>

