<?php
require_once __DIR__ . '/../includes/actions.php'; // ✅ Inclusion des systèmes d'actions

/* ✅ Définition des rôles autorisés */
$roles_autorises = ['Admin'];
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_autorises)) {
    header("Location: /private/admin_user.php?error=⛔ Accès refusé.");
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // ✅ Récupérer les informations de l'utilisateur avant suppression
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            die("Erreur : Utilisateur introuvable !");
        }

        // 📝 Enregistrer l'action dans les logs avant suppression
        log_action($_SESSION['user']['id'], 'DELETE', 'users', $id, [
            'nom' => $user['nom'],
            'prenom' => $user['prenom'],
            'email' => $user['email'],
            'grade' => $user['grade']
        ]);

        // ✅ Suppression de l'utilisateur
        $query = "DELETE FROM users WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute([':id' => $id]);

        header("Location: ../private/admin_user.php"); // ✅ Redirection vers la gestion des utilisateurs
        exit();
    } catch (PDOException $e) {
        error_log("Erreur lors de la suppression de l'utilisateur : " . $e->getMessage());
        die("Erreur interne du serveur.");
    }
} else {
    die("Requête invalide !");
}
