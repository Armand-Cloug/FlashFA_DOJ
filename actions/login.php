<?php
require_once __DIR__ . '/../includes/actions.php'; // ✅ Inclusion des systèmes d'actions

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Nettoyer et sécuriser les entrées utilisateur
    $email = filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL);
    $password = trim($_POST["password"]);

    if ($email && !empty($password)) {
        try {
            // Vérifier si l'utilisateur existe en base de données
            $stmt = $pdo->prepare("SELECT id, nom, prenom, email, password, grade FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user["password"])) {
                // Sécurité : régénération de l'ID de session
                session_regenerate_id(true);

                // Stocker l'utilisateur en session avec toutes ses infos
                $_SESSION["user"] = [
                    "id" => $user["id"],
                    "nom" => $user["nom"],
                    "prenom" => $user["prenom"],
                    "email" => $user["email"],
                    "role" => $user["grade"],
                    "discord" => $user["discord_id"],
                ];

                // 📝 Enregistrer l'action dans les logs (Connexion réussie)
                log_action($user["id"], 'LOGIN_SUCCESS', 'users', $user["id"], [
                    'email' => $user["email"],
                    'ip' => $_SERVER['REMOTE_ADDR'],
                    'user_agent' => $_SERVER['HTTP_USER_AGENT']
                ]);

                // ✅ Redirection après connexion réussie
                header("Location: /views/accueil.php");
                exit;
            } else {
                // 📝 Enregistrer l'action dans les logs (Connexion échouée)
                log_action(null, 'LOGIN_FAILED', 'users', null, [
                    'email' => $email,
                    'ip' => $_SERVER['REMOTE_ADDR'],
                    'user_agent' => $_SERVER['HTTP_USER_AGENT']
                ]);

                // ✅ Enregistrement du message d'erreur en session
                $_SESSION["error"] = "Email ou mot de passe incorrect.";
                header("Location: /views/login.php");
                exit;
            }
        } catch (PDOException $e) {
            error_log("Erreur SQL : " . $e->getMessage());
            $_SESSION["error"] = "Erreur interne, veuillez réessayer plus tard.";
            header("Location: /views/login.php");
            exit;
        }
    } else {
        $_SESSION["error"] = "Veuillez entrer un email valide et un mot de passe.";
        header("Location: /views/plogin.php");
        exit;
    }
}
?>
