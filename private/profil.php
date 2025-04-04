<?php
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';
require_once __DIR__ . '/../includes/database.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    header("Location: /views/page_login.php");
    exit();
}

$user = $_SESSION['user'];
$nom_complet = $user['nom'] . ' ' . $user['prenom']; // ⚠️ Concatène nom et prénom

// ✅ Récupérer les jugements où l'utilisateur est soit Procureur, soit Avocat
$stmt = $pdo->prepare("SELECT id, nom_affaire, lien_dac, lien_def, date_creation 
                       FROM jugement
                       WHERE proc = ? OR avocat = ?
                       ORDER BY date_creation DESC");
$stmt->execute([$nom_complet, $nom_complet]);
$jugements = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<body class="profil-body">
    <div class="main-content">
        <div class="section-container">

            <h2>👤 Mon Profil</h2>
            <ul class="special-ul">
                <strong>Nom :</strong> <?= htmlspecialchars($user['nom']); ?> <br>
                <strong>Prénom :</strong> <?= htmlspecialchars($user['prenom']); ?><br>
                <strong>Email :</strong> <?= htmlspecialchars($user['email']); ?><br>
                <strong>Grade :</strong> <?= htmlspecialchars($user['role']); ?><br>
                <strong>ID Discord :</strong> <?= $user['discord']; ?><br>
            </ul>

            <h2>🔑 Modifier mon mot de passe</h2>
            <form action="/actions/update_password.php" method="POST" class="special-form">
                <label for="ancien_mdp">Mot de passe actuel :</label>
                <input type="password" name="ancien_mdp" id="ancien_mdp" required>
                <label for="nouveau_mdp">Nouveau mot de passe :</label>
                <input type="password" name="nouveau_mdp" id="nouveau_mdp" required>
                <label for="confirmer_mdp">Confirmer le nouveau mot de passe :</label>
                <input type="password" name="confirmer_mdp" id="confirmer_mdp" required>
                <button type="submit" class="btn-submit">Modifier</button>
            </form>


            <h2>⚖️ Mes Jugements</h2>
            <?php if (count($jugements) > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Nom de l'affaire</th>
                            <th>Lien DAC</th>
                            <th>Lien DEF</th>
                            <th>Date de Création</th>
                            <th> Date de Jugement</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($jugements as $jugement): ?>
                            <tr>
                                <td><?= htmlspecialchars($jugement['nom_affaire']); ?></td>
                                <td><a href="<?= htmlspecialchars($jugement['lien_dac']); ?>" target="_blank" class="btn-public">📄 DAC</a></td>
                                <td><a href="<?= htmlspecialchars($jugement['lien_def']); ?>" target="_blank" class="btn-public">📄 DEF</a></td>
                                <td><?= htmlspecialchars(date('d/m/Y', strtotime($jugement['date_creation']))); ?></td>
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
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Aucun jugement assigné.</p>
            <?php endif; ?>

        </div>        
    </div>
</body>
</html>
