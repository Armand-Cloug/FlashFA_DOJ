<?php
require_once __DIR__ . '/../includes/actions.php'; // ✅ Inclusion des systèmes d'actions

// 🚀 VARIABLES DISCORD
$webhook_url_user = getenv('DISCORD_WEBHOOK_USER');

// ✅ Fonction pour envoyer un message sur Discord en Embed
function sendDiscordEmbed($title, $description, $fields, $color = 16711680) {
    global $webhook_url_user; // ✅ Utilisation de la variable globale

    $embed = [
        "title" => $title,
        "description" => $description,
        "color" => $color,
        "fields" => $fields,
        "footer" => [
            "text" => "Département de la Justice - San Andreas",
            "icon_url" => "https://dev-doj.cloug.fr/public/assets/images/logo.png"
        ],
        "timestamp" => date("c")
    ];

    $payload = json_encode(["embeds" => [$embed], "allowed_mentions" => ["parse" => ["roles"]]]);

    $ch = curl_init($webhook_url_user);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = trim($_POST["nom"]);
    $prenom = trim($_POST["prenom"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Vérifier si tous les champs sont remplis
    if (!empty($nom) && !empty($prenom) && !empty($email) && !empty($password)) {
        // Vérifier que l'email est valide et se termine par .us
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !str_ends_with($email, ".us")) {
            $error = "L'email doit être valide et se terminer par .us.";
        } else {
            try {
                // Vérifier si l'email existe déjà
                $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
                $stmt->execute([$email]);
                if ($stmt->fetch()) {
                    $error = "Cet email est déjà utilisé.";
                } else {
                    // Hash du mot de passe
                    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                    // Insérer l'utilisateur dans la base de données
                    $stmt = $pdo->prepare("INSERT INTO users (nom, prenom, email, password, grade) VALUES (?, ?, ?, ?, 'Citoyen')");
                    if ($stmt->execute([$nom, $prenom, $email, $hashedPassword])) {
                        // Récupérer l'ID du nouvel utilisateur
                        $user_id = $pdo->lastInsertId();

                        // 📝 Enregistrer l'action dans les logs (Inscription réussie)
                        log_action($user_id, 'REGISTER_SUCCESS', 'users', $user_id, [
                            'nom' => $nom,
                            'prenom' => $prenom,
                            'email' => $email,
                            'ip' => $_SERVER['REMOTE_ADDR'],
                            'user_agent' => $_SERVER['HTTP_USER_AGENT']
                        ]);

                        // ✅ **Création de l'Embed Discord**
                        $embedTitle = "👤 Nouvel Utilisateur Créé !";
                        $embedDescription = "Un nouvel utilisateur vient d'être ajouté à la base de données.";

                        $embedFields = [
                            ["name" => "🆔 ID", "value" => $user_id, "inline" => false],
                            ["name" => "👤 Nom", "value" => $nom, "inline" => true],
                            ["name" => "🗣️ Prénom", "value" => $prenom, "inline" => true],
                            ["name" => "📧 Email", "value" => $email, "inline" => false]
                        ];

                        // 🔹 Envoyer l'Embed à Discord
                        sendDiscordEmbed($embedTitle, $embedDescription, $embedFields);

                        header("Location: /views/login.php?success=Inscription réussie, connectez-vous.");
                        exit;
                    } else {
                        $error = "Une erreur est survenue lors de l'inscription.";
                    }
                }
            } catch (PDOException $e) {
                error_log("Erreur SQL : " . $e->getMessage());
                $error = "Erreur interne, veuillez réessayer plus tard.";
            }
        }
    } else {
        $error = "Veuillez remplir tous les champs.";
    }

    // ✅ Si une erreur est détectée, on redirige vers `page_register.php`
    if ($error) {
        $_SESSION["error"] = $error;
        header("Location: /views/register.php");
        exit;
    }
}
?>
