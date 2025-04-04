<?php
require_once __DIR__ . '/../includes/header_admin.php';
require_once __DIR__ . '/../includes/navbar_admin.php';
require_once __DIR__ . '/../includes/database.php';

/* ✅ Vérification du rôle de l'utilisateur */
$roles_autorises = ['Admin'];
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_autorises)) {
    die("⛔ Accès refusé.");
}

// Récupérer les entrées de la table prison
$query = "SELECT * FROM prison";
$result = $pdo->query($query);
$prisons = $result->fetchAll();
?>

<body class="prison-body">
    <div class="main-content">
        <h1>Gestion des Prisonniers</h1>
        <p><?= count($prisons) ?> prisoniers enregistrés</p>

        <!-- ✅ Barre de recherche -->
        <input type="text" id="searchBar" placeholder="Rechercher un Utilisateur ..." onkeyup="searchPrison()">

        <div class="table-container">
            <table class="prison-table">
                <thead>
                    <tr>
                        <th>Prisonnier</th>
                        <th>Responsable</th>
                        <th>Date</th>
                        <th>Motif</th>
                        <th>Numéro RA</th>
                        <th>DAC</th>
                        <th>Actions</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($prisons as $prison): ?>
                        <tr>
                            <form method="POST" action="../../actions/update_prison.php">
                                <td><input type="text" name="prisonier" value="<?= htmlspecialchars($prison['prisonier']); ?>"></td>
                                <td><input type="text" name="responsable" value="<?= htmlspecialchars($prison['responsable']); ?>"></td>
                                <td><input type="date" name="date_incarceration" value="<?= htmlspecialchars($prison['date_incarceration']); ?>"></td>
                                <td><input type="text" name="motif" value="<?= htmlspecialchars($prison['motif'] ?? ''); ?>"></td>
                                <td><input type="text" name="numero_ra" value="<?= htmlspecialchars($prison['numero_ra'] ?? ''); ?>"></td>
                                <td><input type="text" name="dac" value="<?= htmlspecialchars($prison['dac'] ?? ''); ?>"></td>
                                <td>
                                    <input type="hidden" name="id" value="<?= $prison['id']; ?>">
                                    <button type="submit" class="btn-update">Modifier</button>
                                </td>
                            </form>
                            <td>
                                <form method="POST" action="../../actions/delete_prison.php">
                                    <input type="hidden" name="id" value="<?= $prison['id']; ?>">
                                    <button type="submit" class="btn-delete">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

<script>
    function searchPrison() {
        let input = document.getElementById("searchBar").value.toLowerCase();
        let rows = document.querySelectorAll(".prison-table tbody tr");
        rows.forEach(row => {
            let text = row.innerText.toLowerCase();
            row.style.display = text.includes(input) ? "" : "none";
        });
    }
</script>
</body>
</html>
