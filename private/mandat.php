<?php
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';
require_once __DIR__ . '/../includes/database.php';

// Vérification que l'utilisateur a les droits
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_justice)) {
    header("Location: /views/accueil.php");
    exit;
}

// Récupération des mandats
$query = "SELECT * FROM mandats ORDER BY date_creation DESC";
$stmt = $pdo->query($query);
$mandats = $stmt->fetchAll();
?>

<body class="mandat-body">

    <div class="main-content">
        <h1>📜 Liste des Mandats</h1>
        <p><?= count($mandats) ?> mandats enregistrés</p>

        <!-- ✅ Barre de recherche -->
        <input type="text" id="searchBar" placeholder="Rechercher un mandat..." onkeyup="searchMandats()">

        <?php if (in_array($_SESSION['user']['role'], $roles_boss_doj)): ?>
            <button class="btn-add" onclick="window.location.href='/private/ajouter_mandat.php'">+ Ajouter un mandat</button>
        <?php endif; ?>
        <div class="table-container">
            <!-- ✅ Liste des mandats -->
            <table class="mandat-table">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Cible</th>
                        <th>Statut</th>
                        <th>Auteur</th>
                        <th>Date</th>
                        <th>Action</th> <!-- Nouvelle colonne pour voir le mandat -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($mandats as $mandat): ?>
                        <?php
                        // Déterminer la page correcte en fonction du type de mandat
                        $mandatType = $mandat['type'];
                        $mandatLien = htmlspecialchars($mandat['lien_unique']);

                        if ($mandatType === 'arrestation') {
                            $page = "view_arrestation.php";
                        } elseif ($mandatType === 'perquisition') {
                            $page = "view_perquisition.php";
                        } elseif ($mandatType === 'amener') {
                            $page = "view_amener.php";
                        } elseif ($mandatType === 'fermeture_temporaire') {
                            $page = "view_fermeture_temporaire.php";
                        } elseif ($mandatType === 'fermeture_definitive') {
                            $page = "view_fermeture_definitive.php";
                        } else {
                            $page = "view_mandat.php"; // Fallback
                        }
                        ?>
                        <tr>
                            <td><?= ucfirst(str_replace('_', ' ', $mandat['type'])) ?></td>
                            <td><?= htmlspecialchars($mandat['cible']) ?></td>
                            <td>
                                <?php if (in_array($_SESSION['user']['role'], $roles_boss_doj_em)): ?>
                                    <form method="POST" action="../actions/update_statut.php">
                                        <input type="hidden" name="mandat_id" value="<?= $mandat['id'] ?>">
                                        <select name="nouveau_statut" onchange="this.form.submit()">
                                            <option value="Actif" <?= $mandat['status'] === 'Actif' ? 'selected' : '' ?>>Actif</option>
                                            <option value="Expiré" <?= $mandat['status'] === 'Expiré' ? 'selected' : '' ?>>Expiré</option>
                                            <option value="Exécuté" <?= $mandat['status'] === 'Exécuté' ? 'selected' : '' ?>>Exécuté</option>
                                        </select>
                                    </form>
                                <?php else: ?>
                                    <span class="status <?= strtolower($mandat['status']) ?>"><?= htmlspecialchars($mandat['status']) ?></span>
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($mandat['auteur']) ?></td>
                            <td><?= date('d-m-Y H:i', strtotime($mandat['date_creation'])) ?></td>
                            <td>
                                <a class="btn-public" href="../views/<?= $page ?>?lien=<?= $mandatLien ?>" target="_blank" class="btn-view">📜 Voir le lien public</a>
                                <a class="btn-public" href="#" onclick="copyToClipboard('<?= htmlspecialchars("dev-doj.cloug.fr/views/" . $page . "?lien=" . $mandatLien) ?>'); return false;">📋 Copier le lien</a>
                            </td>
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
