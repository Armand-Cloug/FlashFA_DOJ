<?php
require_once __DIR__ . '/../includes/actions.php'; // ✅ Inclusion des systèmes d'actions

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    header("Location: /views/page_login.php");
    exit();
}

// Récupération de l'ID utilisateur depuis la session
$user_id = $_SESSION['user']['id'];

// Vérification que le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $ancien_mdp = trim($_POST["ancien_mdp"]);
    $nouveau_mdp = trim($_POST["nouveau_mdp"]);
    $confirmer_mdp = trim($_POST["confirmer_mdp"]);

    // Vérifier que les champs sont remplis
    if (empty($ancien_mdp) || empty($nouveau_mdp) || empty($confirmer_mdp)) {
        header("Location: /private/profil.php?error=Veuillez remplir tous les champs.");
        exit();
    }

    // Vérifier que les nouveaux mots de passe correspondent
    if ($nouveau_mdp !== $confirmer_mdp) {
        header("Location: /private/profil.php?error=Les nouveaux mots de passe ne correspondent pas.");
        exit();
    }

    try {
        // Récupérer l'ancien mot de passe haché en base de données
        $stmt = $pdo->prepare("SELECT password FROM users WHERE id = ?");
        $stmt->execute([$user_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifier que l'ancien mot de passe est correct
        if (!$user || !password_verify($ancien_mdp, $user["password"])) {
            header("Location: /private/profil.php?error=Ancien mot de passe incorrect.");
            exit();
        }

        // Hachage du nouveau mot de passe
        $nouveau_mdp_hash = password_hash($nouveau_mdp, PASSWORD_DEFAULT);

        // Mise à jour du mot de passe en base de données
        $update_stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
        $update_stmt->execute([$nouveau_mdp_hash, $user_id]);

        // 📝 Enregistrer l'action dans les logs (Modification du mot de passe)
        log_action($user_id, 'UPDATE_PASSWORD', 'users', $user_id, [
            'message' => 'L\'utilisateur a changé son mot de passe.',
            'user_id' => $user_id
        ]);

        // Redirection avec message de succès
        header("Location: /private/profil.php?success=Mot de passe mis à jour avec succès.");
        exit();
    } catch (PDOException $e) {
        error_log("Erreur SQL : " . $e->getMessage());
        header("Location: /private/profil.php?error=Erreur interne, veuillez réessayer.");
        exit();
    }
} else {
    // Requête invalide
    header("Location: /private/profil.php");
    exit();
}
?>
