<?php
require_once __DIR__ . '/../includes/header_admin.php';
require_once __DIR__ . '/../includes/navbar_admin.php';
require_once __DIR__ . '/../includes/database.php';

/* ✅ Vérification du rôle de l'utilisateur */
$roles_autorises = ['Admin'];
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_autorises)) {
    die("⛔ Accès refusé.");
}

// Récupération des logs
$query = "SELECT logs.*, users.nom, users.prenom FROM logs 
          JOIN users ON logs.user_id = users.id 
          ORDER BY logs.timestamp DESC LIMIT 100"; // On limite à 100 logs pour éviter une surcharge
$stmt = $pdo->query($query);
$logs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<body class="logs-body">
    <div class="main-content">
        <h1>📜 Journal des modifications</h1>

        <!-- ✅ Bouton pour télécharger les logs -->
        <form action="/actions/dl_logs.php" method="POST">
            <button type="submit" class="btn-add">📥 Télécharger les logs</button>
        </form>

        <!-- ✅ Ajout d'une barre de recherche -->
        <input type="text" id="searchBar" placeholder="Rechercher une action..." onkeyup="searchLogs()">

        <div class="table-container">
            <table class="logs-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Utilisateur</th>
                        <th>Action</th>
                        <th>Table</th>
                        <th>ID</th>
                        <th>Détails</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($logs as $log): ?>
                        <tr>
                            <td><?= htmlspecialchars($log['timestamp']) ?></td>
                            <td><?= htmlspecialchars($log['nom'] . " " . $log['prenom'] . " > User_ID : " . $log['user_id']) ?></td>
                            <td><?= htmlspecialchars($log['action']) ?></td>
                            <td><?= htmlspecialchars($log['table_name']) ?></td>
                            <td><?= htmlspecialchars($log['record_id']) ?></td>
                            <td class="details"><?= htmlspecialchars($log['changes']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function searchLogs() {
            let input = document.getElementById("searchBar").value.toLowerCase();
            let rows = document.querySelectorAll(".logs-table tbody tr");

            rows.forEach(row => {
                let text = row.innerText.toLowerCase();
                row.style.display = text.includes(input) ? "" : "none";
            });
        }
    </script>
</body>
</html>
