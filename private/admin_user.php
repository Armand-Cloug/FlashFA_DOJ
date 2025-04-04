<?php
require_once __DIR__ . '/../includes/header_admin.php';
require_once __DIR__ . '/../includes/navbar_admin.php';
require_once __DIR__ . '/../includes/database.php';

/* ✅ Vérification du rôle de l'utilisateur */
$roles_autorises = ['Admin'];
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_autorises)) {
    die("⛔ Accès refusé.");
}

// Récupérer tous les utilisateurs
$stmt = $pdo->prepare("SELECT id, nom, prenom, email, grade, discord_id FROM users ORDER BY nom ASC");
$stmt->execute();
$users = $stmt->fetchAll();

// Liste des grades possibles
$grades = ['Citoyen', 'SASP', 'Etat Major', 'Etudiant', 'Avocat', 'Avocat du BAP', 'Substitut du Procureur', 
           'Procureur', 'Procureur de District', 'Procureur Général', 'Juge Adjoint', 'Juge', 
           'Juge de District', 'Admin'];
?>

<body class="user-body">
    <div class="main-content">
        <h1>👥 Gestion des Utilisateurs</h1>
        <p><?= count($users) ?> users enregistrés</p>

         <!-- ✅ Barre de recherche -->
         <input type="text" id="searchBar" placeholder="Rechercher un Utilisateur ..." onkeyup="searchUsers()">

        <div class="table-container">
            <table class="user-table">
                <thead class="user-thead">
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>ID Discord</th>
                        <th>Grade</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <form method="POST" action="../actions/update_user.php">
                                <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                <td><?= htmlspecialchars($user['id']); ?></td>
                                <td><input type="text" name="nom" value="<?= htmlspecialchars($user['nom']); ?>"></td>
                                <td><input type="text" name="prenom" value="<?= htmlspecialchars($user['prenom']); ?>"></td>
                                <td><input type="email" name="email" value="<?= htmlspecialchars($user['email']); ?>"></td>
                                <td><input type="text" name="discord_id" value="<?=$user['discord_id']; ?>"></td>
                                <td>
                                    <select name="grade">
                                        <?php foreach ($grades as $grade): ?>
                                            <option value="<?= $grade; ?>" <?= ($user['grade'] === $grade) ? 'selected' : ''; ?>>
                                                <?= $grade; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td>
                                    <button type="submit" class="btn-edit">💾 Sauvegarder</button>
                                    <a href="../actions/delete_user.php?id=<?= $user['id'] ?>" class="btn-del" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">🗑️ Supprimer</a>
                                </td>
                            </form>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function searchUsers() {
            let input = document.getElementById("searchBar").value.toLowerCase();
            let rows = document.querySelectorAll(".user-table tbody tr");

            rows.forEach(row => {
                let text = row.innerText.toLowerCase();
                row.style.display = text.includes(input) ? "" : "none";
            });
        }
    </script>

    <script src="/public/assets/js/user.js"></script>
    
</body>
</html>