<?php
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';
require_once __DIR__ . '/../includes/session.php';

/* ✅ Vérification du rôle de l'utilisateur */
$roles_autorises = ['Admin'];
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_autorises)) {
    die("⛔ Accès refusé.");
}
?>

<body class="peine-body">
    <div class="main-content">
        <h1>⚖️ Ajouter une Peine</h1>

        <?php if (isset($_GET["error"])): ?>
            <p class="error-message">
                <?= htmlspecialchars($_GET["error"]); ?>
            </p>
        <?php endif; ?>
        
        <form action="/actions/ajouter_cop.php" method="POST" class="special-form">
            <!-- ✅ Infraction -->
            <label for="fait">Infraction :</label>
            <input type="text" name="fait" id="fait" placeholder="Description de l'infraction" required>

            <!-- ✅ Type de peine -->
            <label for="type_de_peine">Type de Peine :</label>
            <select name="type_de_peine" id="type_de_peine" required>
                <option value="Contravention">Contravention</option>
                <option value="Délit Mineur">Délit Mineur</option>
                <option value="Délit Majeur">Délit Majeur</option>
                <option value="Crime">Crime</option>
            </select>

            <!-- ✅ Amende -->
            <label for="amende">Montant de l'Amende (€) :</label>
            <input type="number" name="amende" id="amende" placeholder="Ex: 500" step="0.01">

            <!-- ✅ Garde à vue -->
            <label for="gav">Durée de Garde à Vue (HH:MM:SS) :</label>
            <input type="time" name="gav" id="gav" value="00:00:00">

            <!-- ✅ Durée d'unité de peine -->
            <label for="up">Durée de Peine (Jours) :</label>
            <input type="number" name="up" id="up" placeholder="Ex: 30">

            <!-- ✅ Explication -->
            <label for="explications">Explication :</label>
            <textarea name="explications" id="explications" rows="4" required></textarea>

            <!-- ✅ Commentaire (optionnel) -->
            <label for="commentaire">Commentaire :</label>
            <textarea name="commentaire" id="commentaire" rows="3"></textarea>

            <!-- ✅ Auteur (pré-rempli avec l'admin connecté) -->
            <label for="auteur">Auteur :</label>
            <input type="text" name="auteur" value="<?= htmlspecialchars($_SESSION['user']['nom'] . ' ' . $_SESSION['user']['prenom']); ?>" readonly>

            <!-- ✅ Bouton Soumettre -->
            <button type="submit" class="btn-submit">Ajouter la Peine</button>
        </form>
    </div>
</body>
</html>
