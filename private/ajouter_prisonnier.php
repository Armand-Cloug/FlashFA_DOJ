<?php
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';

// Vérification que l'utilisateur a les droits
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_boss_doj_em)) {
    header("Location: /private/prison.php");
    exit;
}
?>

<body class="prison-body">
    <div class="main-content">
        <h1>Ajouter un Prisonnier</h1>

        <form action="/actions/ajouter_prisonnier.php" method="POST" class="special-form">
            <!-- Prisonnier -->
            <label for="prisonier">Nom du prisonnier :</label>
            <input type="text" id="prisonier" name="prisonier" required>

            <!-- Responsable -->
            <label for="responsable">Responsable :</label>
            <input type="text" id="responsable" name="responsable" required>

            <!-- Date d'incarcération -->
            <label for="date_incarceration">Date :</label>
            <input type="date" id="date_incarceration" name="date_incarceration" required>

            <!-- Durée de Peine -->
            <label for="duree">Durée de Peine :</label>
            <input type="text" id="duree" name="duree" required>

            <!-- Motif -->
            <label for="motif">Motif :</label>
            <textarea id="motif" name="motif" rows="3" required></textarea>

            <!-- Numéro RA (facultatif) -->
            <label for="numero_ra">Numéro RA :</label>
            <input type="text" id="numero_ra" name="numero_ra">

            <!-- DAC (facultatif) -->
            <label for="dac">DAC :</label>
            <input type="text" id="dac" name="dac">

            <!-- Bouton d'ajout -->
            <button type="submit" class="btn-add">Ajouter</button>
        </form>
    </div>
</body>
</html>