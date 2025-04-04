<?php
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';
require_once __DIR__ . '/../includes/database.php';

// Vérification que l'utilisateur a les droits
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_justice)) {
    header("Location: /views/accueil.php");
    exit;
}

// Récupérer les entrées de la table jugement
$query = "SELECT * FROM jugement ORDER BY date_creation DESC";
$result = $pdo->query($query);
$jugements = $result->fetchAll();
?>

<body class="jugement-body">
    <div class="main-content">
    <h1>⚖️ Gestion des Jugements</h1>
    <p><?= count($jugements) ?> jugements enregistrés</p>

        <!-- ✅ Barre de recherche -->
        <input type="text" id="searchBar" placeholder="Rechercher un jugement..." onkeyup="searchJuge()">

        <?php if (in_array($_SESSION['user']['role'], $roles_boss_doj)): ?>
            <button class="btn-add" onclick="window.location.href='/private/ajouter_jugement.php'">+ Ajouter un jugement</button>
        <?php endif; ?>

        <table class="jugement-table">
            <thead>
                <tr>
                    <th>Nom de l'Affaire</th>
                    <th>Procureur</th>
                    <th>Avocat</th>
                    <th>Délais</th>
                    <?php if (in_array($_SESSION['user']['role'], $roles_proc)): ?>
                        <th>Dossier d'Accusation</th>
                    <?php endif; ?>
                    <?php if (in_array($_SESSION['user']['role'], $roles_avocats)): ?>
                        <th>Dossier de Défense</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($jugements as $jugement): ?>
                    <tr>
                        <td><?= htmlspecialchars($jugement['nom_affaire']); ?></td>
                        <td><?= htmlspecialchars($jugement['proc'] ?? 'Non attribué'); ?></td>
                        <td><?= htmlspecialchars($jugement['avocat'] ?? 'Non attribué'); ?></td>
                        <td>
                            <?php
                                $dateCreation = $jugement['date_creation'] ?? null;

                                if ($dateCreation) {
                                    $dateJugement = new DateTime($dateCreation);
                                    $dateJugement->modify('+5 days'); // Fixe la date du jugement à +5 jours
                                    $dateJugement->setTime(21, 45); // Fixe l'heure à 21h45
                                
                                    echo "<span style='color: red; font-weight: bold;'>Jugement le : " . $dateJugement->format('d/m/Y à H:i') . "</span>";
                                } else {
                                    echo "Date inconnue";
                                }
                            ?>
                        </td>
                        <?php if (in_array($_SESSION['user']['role'], $roles_proc)): ?>
                            <td><a href="<?= htmlspecialchars($jugement['lien_dac']); ?>" target="_blank" class="btn-public">Dossier Accusation</a></td>
                        <?php endif; ?>
                        <?php if (in_array($_SESSION['user']['role'], $roles_avocats)): ?>
                            <td><a href="<?= htmlspecialchars($jugement['lien_def']); ?>" target="_blank" class="btn-public">Dossier Défense</a></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- ✅ Script de la barre de recherche -->
    <script>
        function searchJuge() {
            let input = document.getElementById("searchBar").value.toLowerCase();
            let jugements = document.querySelectorAll(".jugement-table tbody tr");

            jugements.forEach(jugement => {
                let text = jugement.innerText.toLowerCase();
                jugement.style.display = text.includes(input) ? "" : "none";
            });
        }
    </script>
</body>
</html>
