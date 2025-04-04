<?php
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';
require_once __DIR__ . '/../includes/database.php';

// Vérification que l'utilisateur a les droits
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_justice)) {
    header("Location: /views/accueil.php");
    exit;
}

// Récupérer les entrées de la table prison
$query = "SELECT * FROM prison";
$result = $pdo->query($query);
$prisons = $result->fetchAll();
?>

<body class="prison-body">
    <div class="main-content">
        <h1>🔒 Liste des Prisonniers</h1>
        <p><?= count($prisons) ?> peines de prisons enregistrées</p>

        <!-- ✅ Barre de recherche -->
        <input type="text" id="searchBar" placeholder="Rechercher un prisonier ..." onkeyup="searchPrison()">

        <?php if (in_array($_SESSION['user']['role'], $roles_boss_doj_em)): ?>
            <button class="btn-add" onclick="window.location.href='/private/ajouter_prisonnier.php'">+ Ajouter un prisonnier</button>
        <?php endif; ?>

        <table class="prison-table">
            <thead>
                <tr>
                    <th>Prisonnier</th>
                    <th>Responsable</th>
                    <th>Date</th>
                    <th>Durée de Peine</th>
                    <th>Motif</th>
                    <th>Numéro RA</th>
                    <?php if (in_array($_SESSION['user']['role'], $roles_boss_doj_em)): ?>
                        <th>Actions</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($prisons as $prison): ?>
                    <tr>
                        <td><?= htmlspecialchars($prison['prisonier']); ?></td>
                        <td><?= htmlspecialchars($prison['responsable']); ?></td>
                        <td><?= htmlspecialchars($prison['date_incarceration']); ?></td>
                        <td><?= htmlspecialchars($prison['duree']); ?></td>
                        <td><?= htmlspecialchars($prison['motif']); ?></td>
                        <td><?= htmlspecialchars($prison['numero_ra'] ?? ''); ?></td>
                        <?php if (in_array($_SESSION['user']['role'], $roles_boss_doj_em)): ?>
                            <td>
                                <a href="/private/update_prisonnier.php?id=<?= $prison['id']; ?>" class="btn-edit">Modifier</a>                           
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- ✅ Scripts de la barre de recherche -->
    <script>
        function searchPrison() {
            let input = document.getElementById("searchBar").value.toLowerCase();
            let prisons = document.querySelectorAll(".prison-table tbody tr");

            prisons.forEach(prison => {
                let text = prison.innerText.toLowerCase();
                prison.style.display = text.includes(input) ? "" : "none";
            });
        }
    </script>
</body>
</html>
