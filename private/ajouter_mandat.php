<?php
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';
require_once __DIR__ . '/../includes/session.php';

/* ✅ Vérification du rôle de l'utilisateur */
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_boss_doj)) {
    header("Location: /views/jugement.php");
    exit();
}
?>

<body class="mandat-body">
    <div class="main-content">
        <h1>📜 Ajouter un Mandat</h1>

        <?php if (isset($_GET["error"])): ?>
            <p class="error-message">
                <?= htmlspecialchars($_GET["error"]); ?>
            </p>
        <?php endif; ?>
        
        <form action="/actions/ajouter_mandat.php" method="POST" class="special-form">
            <!-- ✅ Type de mandat -->
            <label for="type">Type de mandat :</label>
            <select name="type" id="type" required onchange="toggleFields()">
                <option value="arrestation">Mandat d'Arrestation</option>
                <option value="perquisition">Mandat de Perquisition</option>
                <option value="amener">Mandat d'Amener</option>
                <option value="fermeture_temporaire">Mandat de fermeture administrative temporaire</option>
                <option value="fermeture_definitive">Mandat de fermeture administrative definitive</option>
            </select>

            <!-- ✅ Cible -->
            <label for="cible">Cible du mandat :</label>
            <input type="text" name="cible" id="cible" placeholder="Nom de la personne ou Entité concernée" required>

            <!-- ✅ Adresse (uniquement pour perquisition_lieu) -->
            <div id="perquisition" style="display: none;">
                <label for="adresse">Adresse :</label>
                <input type="text" name="adresse" id="adresse" placeholder="Lieu de la perquisition">
                <label>Biens ciblés :</label>
                <div class="checkbox-group">
                    <label><input type="checkbox" name="biens[]" value="Dossiers médicaux"> Dossiers médicaux</label>
                    <label><input type="checkbox" name="biens[]" value="Téléphone & carte SIM"> Téléphone & carte SIM</label>
                    <label><input type="checkbox" name="biens[]" value="Propriété immobilière"> Propriété immobilière</label>
                    <label><input type="checkbox" name="biens[]" value="Véhicules"> Véhicules</label>
                    <label><input type="checkbox" name="biens[]" value="Comptes bancaires"> Comptes bancaires</label>
                </div>
            </div>

            <div id="fermeture_temporaire" style="display: none;">
                <label for="duree">Durée de fermeture : </label>
                <input type="text" name="duree" id="duree" placeholder="Durée de la fermeture en Jours">
            </div>

            <!-- ✅ Motif -->
            <label for="motif">Motif du mandat :</label>
            <textarea name="motif" id="motif" rows="4" required></textarea>

            <!-- ✅ Auteur (pré-rempli avec l'admin connecté) -->
            <label for="auteur">Auteur :</label>
            <input type="text" name="auteur" value="<?= htmlspecialchars($_SESSION['user']['nom'] . ' ' . $_SESSION['user']['prenom']); ?>" readonly>

            <!-- ✅ Bouton Soumettre -->
            <button type="submit" class="btn-submit">Créer le Mandat</button>
        </form>
    </div>

    <script>
        function toggleFields() {
            let type = document.getElementById("type").value;
            document.getElementById("perquisition").style.display = (type === "perquisition") ? "block" : "none";
            document.getElementById("fermeture_temporaire").style.display = (type === "fermeture_temporaire") ? "block" : "none";
        }
    </script>

</body>
</html>