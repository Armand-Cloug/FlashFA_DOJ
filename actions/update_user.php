<?php
require_once __DIR__ . '/../includes/actions.php'; // ✅ Inclusion des systèmes d'actions

/* ✅ Définition des rôles autorisés */
$roles_autorises = ['Admin'];
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_autorises)) {
    header("Location: /private/admin_user.php?error=⛔ Accès refusé.");
    exit;
}

// Vérifie si les données ont été envoyées via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
    $id     = $_POST['user_id'];
    $nom    = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $email  = trim($_POST['email']);
    $discord_id = trim($_POST['discord_id']);
    $grade  = $_POST['grade'];
    
    // Vérification des champs obligatoires
    if (empty($nom) || empty($prenom) || empty($email) || empty($grade)) {
        die("⛔ Tous les champs doivent être remplis !");
    }

    try {
        // ✅ Récupérer les informations de l'utilisateur avant modification
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $oldUser = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$oldUser) {
            die("⛔ Utilisateur introuvable !");
        }

        // ✅ Mise à jour des informations de l'utilisateur
        $query = "UPDATE users SET nom = :nom, prenom = :prenom, email = :email, discord_id = :discord_id, grade = :grade WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            ':id'     => $id,
            ':nom'    => $nom,
            ':prenom' => $prenom,
            ':email'  => $email,
            ':discord_id' => $discord_id,
            ':grade'  => $grade
        ]);

        // 📝 Enregistrement de l'action dans les logs
        log_action($_SESSION['user']['id'], 'UPDATE', 'users', $id, [
            'ancien_nom'    => $oldUser['nom'],
            'nouveau_nom'   => $nom,
            'ancien_prenom' => $oldUser['prenom'],
            'nouveau_prenom'=> $prenom,
            'ancien_email'  => $oldUser['email'],
            'nouveau_email' => $email,
            'ancien_grade'  => $oldUser['grade'],
            'nouveau_grade' => $grade
        ]);

        // ✅ Redirection après mise à jour
        header("Location: ../private/admin_user.php?success=1");
        exit();
    } catch (PDOException $e) {
        error_log("❌ Erreur lors de la mise à jour de l'utilisateur : " . $e->getMessage());
        die("❌ Erreur interne du serveur.");
    }
} else {
    die("⛔ Requête invalide !");
}
