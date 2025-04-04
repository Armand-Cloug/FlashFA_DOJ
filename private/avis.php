<?php
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';
require_once __DIR__ . '/../includes/database.php';

// Vérifie si l'utilisateur appartient au DOJ
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_justice)) {
    header("Location: /views/accueil.php");
    exit();
}

// Récupération des aviss
$query = "SELECT * FROM avis ORDER BY date_creation DESC";
$stmt = $pdo->query($query);
$avis = $stmt->fetchAll();
?>

<body class="avis-body">

    <div class="main-content">
        <h1>📜 Liste des avis</h1>
        <p><?= count($avis) ?> avis enregistrés</p>

        <!-- ✅ Barre de recherche -->
        <input type="text" id="searchBar" placeholder="Rechercher un avis..." onkeyup="searchavis()">

        <?php if (in_array($_SESSION['user']['role'], $roles_boss_doj)): ?>
            <button class="btn-add" onclick="window.location.href='/private/ajouter_avis.php'">+ Ajouter un avis</button>
        <?php endif; ?>

            <!-- ✅ Liste des avis -->
        <table class="avis-table">
            <thead>
                <tr>
                    <th>Cible</th>
                    <th>Alias</th>
                    <th>Statut</th>
                    <th>Auteur</th>
                    <th>Date</th>
                    <th>Action</th> <!-- Nouvelle colonne pour voir le avis -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($avis as $avi): 
                    $avisLien = htmlspecialchars($avi['lien_unique']);
                    ?>
                    <tr>
                    <td><?= htmlspecialchars($avi['nom_cible']) ?></td>
                        <td><?= htmlspecialchars($avi['alias_cible']) ?></td>
                        <td>
                            <?php if (in_array($_SESSION['user']['role'], $roles_boss_doj_em)): ?>
                                <form method="POST" action="../actions/update_statut_avis.php">
                                    <input type="hidden" name="avis_id" value="<?= $avi['id'] ?>">
                                    <select name="nouveau_statut" onchange="this.form.submit()">
                                        <option value="Actif" <?= $avi['status'] === 'Actif' ? 'selected' : '' ?>>Actif</option>
                                        <option value="Expiré" <?= $avi['status'] === 'Expiré' ? 'selected' : '' ?>>Expiré</option>
                                        <option value="Exécuté" <?= $avi['status'] === 'Exécuté' ? 'selected' : '' ?>>Exécuté</option>
                                    </select>
                                </form>
                            <?php else: ?>
                                <span class="status <?= strtolower($avi['status']) ?>"><?= htmlspecialchars($avi['status']) ?></span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($avi['auteur']) ?></td>
                        <td><?= date('d-m-Y H:i', strtotime($avi['date_creation'])) ?></td>
                        <td>
                            <a class="btn-public" href="../views/view_avis.php?lien=<?= $avisLien ?>" target="_blank" class="btn-view">📜 Voir le lien public</a>
                            <a class="btn-public" href="#" onclick="copyToClipboard('<?= htmlspecialchars("dev-doj.cloug.fr/views/view_avis.php?lien=" . $avisLien) ?>'); return false;">📋 Copier le lien</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        function searchavis() {
            let input = document.getElementById("searchBar").value.toLowerCase();
            let rows = document.querySelectorAll(".avis-table tbody tr");

            rows.forEach(row => {
                let text = row.innerText.toLowerCase();
                row.style.display = text.includes(input) ? "" : "none";
            });
        }

        function copyToClipboard(text) {
            // Création d'un élément temporaire pour copier le texte
            let tempInput = document.createElement("textarea");
            tempInput.value = text;
            document.body.appendChild(tempInput);
            tempInput.select();
            tempInput.setSelectionRange(0, 99999); // Sélection du texte

            try {
                document.execCommand("copy"); // Copie le texte dans le presse-papiers
                alert("Lien copié dans le presse-papiers !");
            } catch (err) {
                console.error("Erreur lors de la copie : ", err);
            }

            document.body.removeChild(tempInput); // Suppression de l'élément temporaire
        }       
    </script>
</body>
</html>
