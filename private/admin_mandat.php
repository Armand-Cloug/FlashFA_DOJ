<?php
require_once __DIR__ . '/../includes/header_admin.php';
require_once __DIR__ . '/../includes/navbar_admin.php';
require_once __DIR__ . '/../includes/database.php';

/* ✅ Vérification du rôle de l'utilisateur */
$roles_autorises = ['Admin'];
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_autorises)) {
    die("⛔ Accès refusé.");
}

// Récupération des mandats
$query = "SELECT * FROM mandats ORDER BY date_creation DESC";
$stmt = $pdo->query($query);
$mandats = $stmt->fetchAll();
?>

<body class="mandat-body">

    <div class="main-content">
        <h1>📜 Gestion des Mandats</h1>
        <p><?= count($mandats) ?> mandats enregistrés</p>

         <!-- ✅ Barre de recherche -->
         <input type="text" id="searchBar" placeholder="Rechercher un mandat..." onkeyup="searchMandats()">

        <div class="table-container">
            <!-- ✅ Liste des mandats avec formulaire de modification -->
            <table class="mandat-table">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Cible</th>
                        <th>Statut</th>
                        <th>Auteur</th>
                        <th>Date</th>
                        <th>Actions</th> <!-- Bouton supprimer -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($mandats as $mandat): ?>
                        <tr>
                            <form method="POST" action="../actions/update_mandat.php">
                                <input type="hidden" name="mandat_id" value="<?= $mandat['id'] ?>">
                                <td>
                                    <select name="type">
                                        <option value="arrestation"          <?= $mandat['type'] === 'arrestation' ? 'selected' : '' ?>>Arrestation</option>
                                        <option value="perquisition"         <?= $mandat['type'] === 'perquisition' ? 'selected' : '' ?>>Perquisition</option>
                                        <option value="amener"               <?= $mandat['type'] === 'amener' ? 'selected' : '' ?>>Amener</option>
                                        <option value="fermeture_definitive" <?= $mandat['type'] === 'fermeture_definitive' ? 'selected' : '' ?>>Fermeture Definitive</option>
                                        <option value="fermeture_temporaire" <?= $mandat['type'] === 'fermeture_temporaire' ? 'selected' : '' ?>>Fermeture Temporaire</option>
                                    </select>
                                </td>
                                <td><input type="text" name="cible" value="<?= htmlspecialchars($mandat['cible']) ?>"></td>
                                <td>
                                    <select name="status">
                                        <option value="Actif" <?= $mandat['status'] === 'Actif' ? 'selected' : '' ?>>Actif</option>
                                        <option value="Expiré" <?= $mandat['status'] === 'Expiré' ? 'selected' : '' ?>>Expiré</option>
                                        <option value="Exécuté" <?= $mandat['status'] === 'Exécuté' ? 'selected' : '' ?>>Exécuté</option>
                                    </select>
                                </td>
                                <td><input type="text" name="auteur" value="<?= htmlspecialchars($mandat['auteur']) ?>"></td>
                                <td><input type="datetime-local" name="date_creation" value="<?= date('Y-m-d\TH:i', strtotime($mandat['date_creation'])) ?>"></td>
                                <td>
                                    <button type="submit" class="btn-edit">💾 Sauvegarder</button>
                                    <a href="../actions/delete_mandat.php?id=<?= $mandat['id'] ?>" class="btn-del" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce mandat ?');">🗑️ Supprimer</a>
                                </td>
                            </form>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function searchMandats() {
            let input = document.getElementById("searchBar").value.toLowerCase();
            let rows = document.querySelectorAll(".mandat-table tbody tr");

            rows.forEach(row => {
                let text = row.innerText.toLowerCase();
                row.style.display = text.includes(input) ? "" : "none";
            });
        }
    </script>
</body>
</html>