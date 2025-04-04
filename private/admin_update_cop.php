<?php
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';
require_once __DIR__ . '/../includes/database.php';
require_once __DIR__ . '/../includes/session.php';

/* ✅ Vérification du rôle de l'utilisateur */
$roles_autorises = ['Admin'];
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_autorises)) {
    die("⛔ Accès refusé.");
}

// ✅ Vérifier si un ID est passé en GET
if (!isset($_GET['id']) || empty($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: /private/peines.php?error=❌ ID invalide.");
    exit();
}

$peine_id = intval($_GET['id']);

// ✅ Récupérer les informations de la peine
$query = "SELECT * FROM peines WHERE id = :id";
$stmt = $pdo->prepare($query);
$stmt->execute(['id' => $peine_id]);
$peine = $stmt->fetch(PDO::FETCH_ASSOC);

// ✅ Vérifier si la peine existe
if (!$peine) {
    header("Location: /private/peines.php?error=⚠️ Peine introuvable.");
    exit();
}
?>

<body class="peine-body">
    <div class="main-content">
        <h1>⚖️ Modifier une Peine</h1>

        <?php if (isset($_GET["error"])): ?>
            <p class="error-message">
                <?= htmlspecialchars($_GET["error"]); ?>
            </p>
        <?php endif; ?>
        
        <form action="/actions/update_cop.php" method="POST" class="special-form">
            <input type="hidden" name="id" value="<?= htmlspecialchars($peine['id']) ?>">

            <!-- ✅ Infraction -->
            <label for="fait">Infraction :</label>
            <input type="text" name="fait" id="fait" required value="<?= htmlspecialchars($peine['fait']) ?>">

            <!-- ✅ Type de peine -->
            <label for="type_de_peine">Type de Peine :</label>
            <select name="type_de_peine" id="type_de_peine" required>
                <option value="Contravention" <?= $peine['type_de_peine'] === 'Contravention' ? 'selected' : '' ?>>Contravention</option>
                <option value="Délit Mineur" <?= $peine['type_de_peine'] === 'Délit Mineur' ? 'selected' : '' ?>>Délit Mineur</option>
                <option value="Délit Majeur" <?= $peine['type_de_peine'] === 'Délit Majeur' ? 'selected' : '' ?>>Délit Majeur</option>
                <option value="Crime" <?= $peine['type_de_peine'] === 'Crime' ? 'selected' : '' ?>>Crime</option>
            </select>

            <!-- ✅ Amende -->
            <label for="amende">Montant de l'Amende (€) :</label>
            <input type="number" name="amende" id="amende" step="0.01" value="<?= htmlspecialchars($peine['amende']) ?>">

            <!-- ✅ Garde à vue -->
            <label for="gav">Durée de Garde à Vue (HH:MM:SS) :</label>
            <input type="time" name="gav" id="gav" value="<?= htmlspecialchars($peine['gav']) ?>">

            <!-- ✅ Durée d'unité de peine -->
            <label for="up">Durée de Peine (Jours) :</label>
            <input type="number" name="up" id="up" value="<?= htmlspecialchars($peine['up']) ?>">

            <!-- ✅ Explication -->
            <label for="explications">Explication :</label>
            <textarea name="explications" id="explications" rows="4" required><?= htmlspecialchars($peine['explications']) ?></textarea>

            <!-- ✅ Commentaire (optionnel) -->
            <label for="commentaire">Commentaire :</label>
            <textarea name="commentaire" id="commentaire" rows="3"><?= htmlspecialchars($peine['commentaire'] ?? '') ?></textarea>

            <!-- ✅ Bouton Modifier -->
            <button type="submit" class="btn-update">Modifier</button>

            <?php if (isset($_SESSION['user']) && in_array($_SESSION['user']['role'], $roles_autorises)): ?>
                <button type="submit" formaction="/actions/delete_cop.php" class="btn-delete">Supprimer</button>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>
