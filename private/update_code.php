<?php
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';
require_once __DIR__ . '/../includes/database.php';

// Vérification des droits
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_boss_doj_em)) {
    header("Location: /private/code_etat.php");
    exit();
}

// Vérifier si un ID est passé en GET
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: /private/code_etat.php?error=no_id");
    exit();
}

$id = $_GET['id'];

// Récupérer les informations du code d'état
$query = "SELECT * FROM codes_etat WHERE id = :id";
$stmt = $pdo->prepare($query);
$stmt->execute(['id' => $id]);
$code = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérifier si le code existe
if (!$code) {
    header("Location: /private/code_etat.php?error=not_found");
    exit();
}
?>

<body class="code-body">
    <div class="main-content">
        <h1>Modifier un Code d'État</h1>

        <form action="/actions/update_code.php" method="POST" class="special-form">
            <input type="hidden" name="id" value="<?= htmlspecialchars($code['id']) ?>">

            <label for="type">Couleur du Code</label>
            <select name="type" id="type" required>
                <option value="Orange" <?= $code['type'] === 'Orange' ? 'selected' : '' ?>>🟠 Orange</option>
                <option value="Rouge" <?= $code['type'] === 'Rouge' ? 'selected' : '' ?>>🔴 Rouge</option>
                <option value="Noir" <?= $code['type'] === 'Noir' ? 'selected' : '' ?>>⚫ Noir</option>
            </select>

            <label for="lieu">Lieu du Code</label>
            <input type="text" id="lieu" name="lieu" required value="<?= htmlspecialchars($code['lieu']) ?>">

            <label for="date_debut">Date de Commencement</label>
            <input type="datetime-local" id="date_debut" name="date_debut" required 
                   value="<?= date('Y-m-d\TH:i', strtotime($code['date_debut'])) ?>">

            <label for="date_fin">Date de fin (Facultatif)</label>
            <input type="datetime-local" id="date_fin" name="date_fin" 
                   value="<?= $code['date_fin'] ? date('Y-m-d\TH:i', strtotime($code['date_fin'])) : '' ?>">

            <label for="responsable">Responsable</label>
            <input type="text" id="responsable" name="responsable" required value="<?= htmlspecialchars($code['responsable']) ?>">

            <label for="raison">raison du Code</label>
            <input type="text" id="raison" name="raison" required value="<?= htmlspecialchars($code['raison']) ?>">

            <button type="submit" class="btn-update">Modifier</button>

            <?php if (isset($_SESSION['user']) && in_array($_SESSION['user']['role'], $roles_boss_doj)): ?>
                <button type="submit" formaction="/actions/delete_code.php" class="btn-delete">Supprimer</button>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>
