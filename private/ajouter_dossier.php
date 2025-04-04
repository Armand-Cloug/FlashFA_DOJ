<?php
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';
require_once __DIR__ . '/../includes/session.php';

// Vérifie si l'utilisateur appartient au DOJ
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_proc)) {
    header("Location: /views/dossier.php");
    exit();
}
?>

<body class="dossier-body">
    <div class="main-content">
        <h1>📁 Ajouter un Dossier</h1>

        <?php if (isset($_GET["error"])): ?>
            <p class="error-message">
                <?= htmlspecialchars($_GET["error"]); ?>
            </p>
        <?php endif; ?>
        
        <form action="/actions/ajouter_dossier.php" method="POST" class="special-form">
            <!-- ✅ Nom de l'affaire -->
            <label for="nom_affaire">Nom de l'affaire :</label>
            <input type="text" name="nom_affaire" id="nom_affaire" placeholder="Nom du dossier" required>

            <!-- ✅ Responsable du dossier -->
            <label for="responsable">Responsable :</label>
            <input type="text" name="responsable" id="responsable" placeholder="Nom du responsable (optionnel)">

            <!-- ✅ Lien vers le DAC -->
            <label for="lien_dac">Lien DAC :</label>
            <input type="url" name="lien_dac" id="lien_dac" placeholder="URL du DAC" required>

            <!-- ✅ Lien vers le Dossier Complet -->
            <label for="lien_dc">Lien Dossier Complet :</label>
            <input type="url" name="lien_dc" id="lien_dc" placeholder="URL du Dossier Complet" required>

            <!-- ✅ Statut du dossier -->
            <label for="statut">Statut du dossier :</label>
            <select name="statut" id="statut" required>
                <option value="A Rédiger">A Rédiger</option>
                <option value="En cours de rédaction">En cours de rédaction</option>
                <option value="Transmis au Juge">Transmis au Juge</option>
                <option value="Affaire close">Affaire close</option>
            </select>

            <!-- ✅ Bouton Soumettre -->
            <button type="submit" class="btn-submit">Créer le Dossier</button>
        </form>
    </div>
</body>
</html>
