<?php
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';
require_once __DIR__ . '/../includes/database.php';

// Vérifie si l'utilisateur appartient au DOJ
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_proc)) {
    header("Location: /private/dossier.php");
    exit();
}

// Vérifier l'ID du DAC
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: /private/dossier.php?error=Dossier introuvable");
    exit();
}

$dac_id = $_GET['id'];

// Récupérer les informations du DAC
$query = "SELECT * FROM dac WHERE id = :id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id', $dac_id, PDO::PARAM_INT);
$stmt->execute();
$dac = $stmt->fetch(PDO::FETCH_ASSOC);

// Si aucun DAC trouvé, rediriger
if (!$dac) {
    header("Location: /private/dossier.php?error=Dossier introuvable");
    exit();
}
?>

<body class="dossier-body">
    <div class="main-content">
        <h1>✏️ Modifier le Dossier</h1>

        <?php if (isset($_GET["error"])): ?>
            <p class="error-message">
                <?= htmlspecialchars($_GET["error"]); ?>
            </p>
        <?php endif; ?>

        <form action="/actions/update_dossier.php" method="POST" class="special-form">
            <input type="hidden" name="id" value="<?= htmlspecialchars($dac['id']); ?>">

            <label for="nom_affaire">Nom de l'affaire :</label>
            <input type="text" name="nom_affaire" id="nom_affaire" value="<?= htmlspecialchars($dac['nom_affaire']); ?>" required>

            <label for="responsable">Responsable :</label>
            <input type="text" name="responsable" id="responsable" value="<?= htmlspecialchars($dac['responsable'] ?? ''); ?>">

            <label for="lien_dac">Lien vers le DAC :</label>
            <input type="text" name="lien_dac" id="lien_dac" value="<?= htmlspecialchars($dac['lien_dac']); ?>" required>

            <label for="lien_dc">Lien vers le dossier complet :</label>
            <input type="text" name="lien_dc" id="lien_dc" value="<?= htmlspecialchars($dac['lien_dc']); ?>" required>

            <label for="statut">Statut :</label>
            <select name="statut" id="statut" required>
                <option value="A Rédiger" <?= $dac['statut'] === 'A Rédiger' ? 'selected' : ''; ?>>A Rédiger</option>
                <option value="En cours de rédaction" <?= $dac['statut'] === 'En cours de rédaction' ? 'selected' : ''; ?>>En cours de rédaction</option>
                <option value="Transmis au Juge" <?= $dac['statut'] === 'Transmis au Juge' ? 'selected' : ''; ?>>Transmis au Juge</option>
                <option value="Affaire close" <?= $dac['statut'] === 'Affaire close' ? 'selected' : ''; ?>>Affaire close</option>
            </select>

            <button type="submit" class="btn-update">Modifier</button>

            <?php if (isset($_SESSION['user']) && in_array($_SESSION['user']['role'], $roles_boss_doj)): ?>
                <button type="submit" formaction="/actions/delete_dossier.php" class="btn-delete">Supprimer</button>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>
