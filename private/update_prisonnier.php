<?php
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';
require_once __DIR__ . '/../includes/database.php';

// Vérifie si l'utilisateur appartient au DOJ
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_boss_doj_em)) {
    header("Location: /private/prison.php");
    exit();
}

// Vérifier si un ID est fourni
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: /private/prison.php?error=no_id");
    exit;
}

$id = intval($_GET['id']);

// Récupérer les informations du prisonnier
$query = "SELECT * FROM prison WHERE id = :id";
$stmt = $pdo->prepare($query);
$stmt->execute([':id' => $id]);
$prisonier = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$prisonier) {
    header("Location: /private/prison.php?error=not_found");
    exit;
}
?>

<body class="prison-body">
    <div class="main-content">
        <h1>Modifier un Prisonnier</h1>

        <form method="POST" action="/actions/update_prison.php" class="special-form">
            <input type="hidden" name="id" value="<?= htmlspecialchars($prisonier['id']); ?>">

            <label>Prisonnier</label>
            <input type="text" name="prisonier" value="<?= htmlspecialchars($prisonier['prisonier']); ?>" required>

            <label>Responsable</label>
            <input type="text" name="responsable" value="<?= htmlspecialchars($prisonier['responsable']); ?>" required>

            <label>Date d'incarcération</label>
            <input type="date" name="date_incarceration" value="<?= htmlspecialchars($prisonier['date_incarceration']); ?>" required>

            <label>Durée de Peine</label>
            <input type="text" name="duree" value="<?= htmlspecialchars($prisonier['duree']); ?>" required>

            <label>Motif</label>
            <textarea name="motif" required><?= htmlspecialchars($prisonier['motif']); ?></textarea>

            <label>Numéro RA</label>
            <input type="text" name="numero_ra" value="<?= htmlspecialchars($prisonier['numero_ra'] ?? ''); ?>">

            <label>DAC</label>
            <input type="text" name="dac" value="<?= htmlspecialchars($prisonier['dac'] ?? ''); ?>">

            <div class="button-group">
                <button type="submit" class="btn-update">Modifier</button>
                <button type="submit" formaction="/actions/delete_prison.php" class="btn-delete">Supprimer</button>
            </div>
        </form>
    </div>
</body>
</html>
