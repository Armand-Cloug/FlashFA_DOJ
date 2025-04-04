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
$query = "SELECT * FROM codes_etat ORDER BY date_debut DESC";
$result = $pdo->query($query);
$codes = $result->fetchAll();
?>

<body class="code-body">
    <div class="main-content">
        <h1>🟢🟠🔴 Liste des Codes d'Etats</h1>
        <p><?= count($codes) ?> codes enregistrés</p>

        <!-- ✅ Barre de recherche -->
        <input type="text" id="searchBar" placeholder="Rechercher un code ..." onkeyup="searchCode()">

        <?php if (in_array($_SESSION['user']['role'], $roles_boss_doj_em)): ?>
            <button class="btn-add" onclick="window.location.href='ajouter_code.php'">+ Déclarer un nouveau code</button>
        <?php endif; ?>

        <table class="code-table">
            <thead>
                <tr>
                    <th>Couleur</th>
                    <th>Lieu</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    <th>Responsable</th>
                    <th>Motif</th>
                    <th>Lien Public</th>
                    <?php if (in_array($_SESSION['user']['role'], $roles_boss_doj_em)): ?>
                        <th>Actions</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($codes as $code): 
                    $codeLien = htmlspecialchars($code['lien_unique']);?>
                    <tr>
                        <td> <span class="status <?= strtolower($code['type']) ?>"> <?= htmlspecialchars($code['type']); ?> </span> </td>
                        <td><?= htmlspecialchars($code['lieu']); ?></td>
                        <td><?= date('d-m-Y', strtotime($code['date_debut'])); ?></td>
                        <td><?= !empty($code['date_fin']) ? date('d-m-Y', strtotime($code['date_fin'])) : 'Non défini'; ?></td>
                        <td><?= htmlspecialchars($code['responsable']); ?></td>
                        <td><?= htmlspecialchars($code['raison'] ?? ''); ?></td>
                        <td><a class="btn-public" href="../views/view_code.php?lien=<?= $codeLien ?>" target="_blank" class="btn-view">📜 Voir le lien public</a></td>
                        <?php if (in_array($_SESSION['user']['role'], $roles_boss_doj_em)): ?>
                            <td>
                                <a href="update_code.php?id=<?= $code['id']; ?>" class="btn-edit">Modifier</a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- ✅ Scripts de la barre de recherche -->
    <script>
        function searchCode() {
            let input = document.getElementById("searchBar").value.toLowerCase();
            let codes = document.querySelectorAll(".code-table tbody tr");

            codes.forEach(code => {
                let text = code.innerText.toLowerCase();
                code.style.display = text.includes(input) ? "" : "none";
            });
        }
    </script>
</body>
</html>