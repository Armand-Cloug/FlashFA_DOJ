<?php
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';
require_once __DIR__ . '/../includes/session.php';
require_once __DIR__ . '/../includes/database.php'; // Connexion à la base de données

// Vérifie si l'utilisateur appartient au DOJ
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_boss_doj)) {
    header("Location: /views/jugement.php");
    exit();
}

// ✅ Récupérer la liste des avocats
$stmtAvocats = $pdo->prepare("SELECT id, nom, prenom FROM users WHERE grade IN ('Avocat', 'Avocat du BAP')");
$stmtAvocats->execute();
$avocats = $stmtAvocats->fetchAll(PDO::FETCH_ASSOC);

// ✅ Récupérer la liste des procureurs
$stmtProcureurs = $pdo->prepare("SELECT id, nom, prenom FROM users WHERE grade IN ('Substitut du Procureur', 'Procureur', 'Procureur de District', 'Procureur Général')");
$stmtProcureurs->execute();
$procureurs = $stmtProcureurs->fetchAll(PDO::FETCH_ASSOC);
?>

<body class="jugement-body">
    <div class="main-content">
        <h1>📁 Ajouter un Jugement</h1>

        <?php if (isset($_GET["error"])): ?>
            <p class="error-message">
                <?= htmlspecialchars($_GET["error"]); ?>
            </p>
        <?php endif; ?>
        
        <form action="/actions/ajouter_jugement.php" method="POST" class="special-form">
            <!-- ✅ Nom de l'affaire -->
            <label for="nom_affaire">Nom de l'affaire :</label>
            <input type="text" name="nom_affaire" id="nom_affaire" placeholder="Nom du jugement" required>

            <!-- ✅ Procureur en charge -->
            <label for="proc">Procureur :</label>
            <select name="proc" id="proc">
                <option value="">Sélectionner un procureur (optionnel)</option>
                <?php foreach ($procureurs as $procureur): ?>
                    <option value="<?= htmlspecialchars($procureur['nom'] . ' ' . $procureur['prenom']); ?>">
                        <?= htmlspecialchars($procureur['nom'] . ' ' . $procureur['prenom']); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <!-- ✅ Avocat responsable -->
            <label for="avocat">Avocat :</label>
            <select name="avocat" id="avocat">
                <option value="">Sélectionner un avocat (optionnel)</option>
                <?php foreach ($avocats as $avocat): ?>
                    <option value="<?= htmlspecialchars($avocat['nom'] . ' ' . $avocat['prenom']); ?>">
                        <?= htmlspecialchars($avocat['nom'] . ' ' . $avocat['prenom']); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <!-- ✅ Lien vers le DAC -->
            <label for="lien_dac">Lien DAC :</label>
            <input type="url" name="lien_dac" id="lien_dac" placeholder="URL du Dossier d'Accusation">

            <!-- ✅ Lien vers le DEF -->
            <label for="lien_def">Lien DEF :</label>
            <input type="url" name="lien_def" id="lien_def" placeholder="URL du Dossier de Défense">

            <!-- ✅ Bouton Soumettre -->
            <button type="submit" class="btn-submit">Créer le Jugement</button>
        </form>
    </div>
</body>
</html>