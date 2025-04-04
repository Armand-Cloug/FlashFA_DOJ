<?php
require_once __DIR__ . '/../includes/header_admin.php';
require_once __DIR__ . '/../includes/navbar_admin.php';
require_once __DIR__ . '/../includes/database.php';

// Vérifier si l'utilisateur est autorisé à accéder à cette page (ex: uniquement Admin)
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Admin') {
    die("⛔ Accès refusé.");
}

// Récupérer toutes les peines depuis la base de données
$stmt = $pdo->prepare("SELECT * FROM peines ORDER BY id ASC");
$stmt->execute();
$peines = $stmt->fetchAll();
?>

<body class="cop-admin-body">
    <div class="main-content">
        <h1>📜 Administration des Peines</h1>

        <!-- ✅ Barre de recherche -->
        <input type="text" id="searchBar" placeholder="Rechercher une peine ..." onkeyup="searchCOP()">

        <button class="btn-add" onclick="window.location.href='/private/admin_ajouter_cop.php'">+ Ajouter une peine</button>

        <!-- ✅ Tableau des peines -->
        <div class="table-container">
            <table class="peines-table">
                <thead>
                    <tr>
                        <th>Fait</th>
                        <th>Type de Peine</th>
                        <th>Amende</th>
                        <th>GAV</th>
                        <th>UP</th>
                        <th>Explications</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($peines as $peine): ?>
                        <tr>
                            <td><?= htmlspecialchars($peine['fait']); ?></td>
                            <td><?= htmlspecialchars($peine['type_de_peine']); ?></td>
                            <td><?= htmlspecialchars($peine['amende']); ?>$</td>
                            <td><?= htmlspecialchars($peine['gav']); ?></td>
                            <td><?= htmlspecialchars($peine['up']); ?></td>
                            <td><?= htmlspecialchars($peine['explications']); ?></td>
                            <td>
                                <a href="../private/admin_update_cop.php?id=<?= $peine['id'] ?>" class="btn-edit" onclick="return"> Modifier</a>
                                <a href="../actions/delete_cop.php?id=<?= $peine['id'] ?>" class="btn-del" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette peine ?');">🗑️ Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ✅ Scripts de la barre de recherche -->
    <script>
        function searchCOP() {
            let input = document.getElementById("searchBar").value.toLowerCase();
            let rows = document.querySelectorAll(".peines-table tbody tr");

            rows.forEach(row => {
                let text = row.innerText.toLowerCase();
                row.style.display = text.includes(input) ? "" : "none";
            });
        }
    </script>
</body>
</html>
