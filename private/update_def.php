<?php
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';
require_once __DIR__ . '/../includes/database.php';

// Vérifie si l'utilisateur appartient au DOJ
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_avocats)) {
    header("Location: /private/def.php");
    exit();
}

// Vérifier l'ID du DEF
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: /private/def.php?error=Dossier introuvable");
    exit();
}

$def_id = $_GET['id'];

// Récupérer les informations du DEF
$query = "SELECT * FROM def WHERE id = :id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id', $def_id, PDO::PARAM_INT);
$stmt->execute();
$def = $stmt->fetch(PDO::FETCH_ASSOC);

// Si aucun def trouvé, rediriger
if (!$def) {
    header("Location: /private/def.php?error=Dossier introuvable");
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

        <form action="/actions/update_def.php" method="POST" class="special-form">
            <input type="hidden" name="id" value="<?= htmlspecialchars($def['id']); ?>">

            <label for="nom_affaire">Nom de l'affaire :</label>
            <input type="text" name="nom_affaire" id="nom_affaire" value="<?= htmlspecialchars($def['nom_affaire']); ?>" required>

            <label for="responsable">Responsable :</label>
            <input type="text" name="responsable" id="responsable" value="<?= htmlspecialchars($def['responsable'] ?? ''); ?>">

            <label for="lien_def">Lien vers le def :</label>
            <input type="text" name="lien_def" id="lien_def" value="<?= htmlspecialchars($def['lien_def']); ?>" required>

            <label for="statut">Statut :</label>
            <select name="statut" id="statut" required>
                <option value="A Rédiger" <?= $def['statut'] === 'A Rédiger' ? 'selected' : ''; ?>>A Rédiger</option>
                <option value="En cours de rédaction" <?= $def['statut'] === 'En cours de rédaction' ? 'selected' : ''; ?>>En cours de rédaction</option>
                <option value="Transmis au Juge" <?= $def['statut'] === 'Transmis au Juge' ? 'selected' : ''; ?>>Transmis au Juge</option>
                <option value="Affaire close" <?= $def['statut'] === 'Affaire close' ? 'selected' : ''; ?>>Affaire close</option>
            </select>

            <button type="submit" class="btn-update">Modifier</button>

            <?php if (isset($_SESSION['user']) && in_array($_SESSION['user']['role'], $roles_boss_doj)): ?>
                <button type="submit" formaction="/actions/delete_def.php" class="btn-delete">Supprimer</button>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>
