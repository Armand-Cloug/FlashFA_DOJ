<?php
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';
require_once __DIR__ . '/../includes/database.php';

// Vérification que l'utilisateur a les droits
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_avocats)) {
    header("Location: /views/accueil.php");
    exit;
}

// Récupérer les entrées de la table dac
$query = "SELECT * FROM def";
$result = $pdo->query($query);
?>

<body class="dossier-body">
    <div class="main-content">
        <h1>📂 Gestion des dossiers de défense</h1>

        <!-- ✅ Barre de recherche -->
        <input type="text" id="searchBar" placeholder="Rechercher une affaire..." onkeyup="searchDossier()">
        <button class="btn-add" onclick="window.location.href='/private/ajouter_def.php'">+ Ajouter un dossier</button>
        
        <table class="dossier-table">
            <thead>
                <tr>
                    <th>Nom de l'Affaire</th>
                    <th>Responsable</th>
                    <th>Statut</th>
                    <th>Délais</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td>
                            <a href="<?= htmlspecialchars($row['lien_def']); ?>" target="_blank" class="affaire-link">
                                <?= htmlspecialchars($row['nom_affaire']); ?>
                            </a>
                        </td>
                        <td><?= htmlspecialchars($row['responsable'] ?? 'Non attribué'); ?></td>
                        <td>
                            <form method="POST" action="/actions/check_def.php">
                                <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                <select name="statut" class="statut-select">
                                    <option value="A Rédiger" <?= $row['statut'] === 'A Rédiger' ? 'selected' : ''; ?>>A Rédiger</option>
                                    <option value="En cours de rédaction" <?= $row['statut'] === 'En cours de rédaction' ? 'selected' : ''; ?>>En cours de rédaction</option>
                                    <option value="Transmis au Juge" <?= $row['statut'] === 'Transmis au Juge' ? 'selected' : ''; ?>>Transmis au Juge</option>
                                    <option value="Affaire close" <?= $row['statut'] === 'Affaire close' ? 'selected' : ''; ?>>Affaire close</option>
                                </select>
                                <button type="submit" class="btn-update">✓</button>
                            </form>
                        </td>
                        <td>
                            <?php
                            $dateCreation = $row['date_creation'] ?? null;
                            $statut = $row['statut'] ?? '';
                                        
                            // Vérifier si le dossier est terminé
                            if ($statut === 'Transmis au Juge' || $statut === 'Affaire close') {
                                echo "<span style='color: green; font-weight: bold;'>Fini</span>";
                            } else {
                                if ($dateCreation) {
                                    $dateFin = new DateTime($dateCreation);
                                    $dateFin->modify('+5 days'); // Ajoute 3 jours à la date de création
                                    $now = new DateTime();
                                
                                    if ($now > $dateFin) {
                                        echo "<span style='color: red; font-weight: bold;'>Expiré</span>";
                                    } else {
                                        $diff = $now->diff($dateFin);
                                        echo "Temps restant : " . $diff->d . " jours, " . $diff->h . " heures, " . $diff->i . " minutes";
                                    }
                                } else {
                                    echo "Date inconnue";
                                }
                            }
                            ?>
                        </td>


                        <td>
                            <a href="/private/update_def.php?id=<?= $row['id']; ?>" class="btn-edit">Modifier</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- ✅ Script de la barre de recherche -->
    <script>
        function searchDossier() {
            let input = document.getElementById("searchBar").value.toLowerCase();
            let rows = document.querySelectorAll(".dossier-table tbody tr");

            rows.forEach(row => {
                let text = row.innerText.toLowerCase();
                row.style.display = text.includes(input) ? "" : "none";
            });
        }
    </script>
</body>
</html>
