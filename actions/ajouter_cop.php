<?php
require_once __DIR__ . '/../includes/actions.php'; // ✅ Inclusion des systèmes d'actions

/* ✅ Définition des rôles autorisés */
$roles_autorises = ['Admin'];
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_autorises)) {
    header("Location: /private/admin_cop.php?error=⛔ Accès refusé.");
    exit;
}

// ✅ Récupération et nettoyage des données du formulaire
$fait = trim($_POST['fait'] ?? '');
$type_de_peine = trim($_POST['type_de_peine'] ?? '');
$amende = isset($_POST['amende']) ? floatval($_POST['amende']) : null;
$gav = isset($_POST['gav']) ? $_POST['gav'] : '00:00:00';
$up = isset($_POST['up']) ? intval($_POST['up']) : 0;
$explications = trim($_POST['explications'] ?? '');
$commentaire = trim($_POST['commentaire'] ?? '');
$auteur = trim($_POST['auteur'] ?? '');

/* ✅ Vérification des champs obligatoires */
if (empty($fait) || empty($type_de_peine) || empty($explications) || empty($auteur)) {
    header("Location: /private/ajouter_cop.php?error=❌ Remplissez tous les champs obligatoires.");
    exit;
}

try {
    // ✅ Insertion en base de données
    $stmt = $pdo->prepare("INSERT INTO peines (fait, type_de_peine, amende, gav, up, explications, commentaire, date_creation) 
                           VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");

    $stmt->execute([$fait, $type_de_peine, $amende, $gav, $up, $explications, $commentaire]);

    // ✅ Récupérer l'ID de la peine ajoutée
    $record_id = $pdo->lastInsertId();

    // 📝 Enregistrer l'action dans les logs
    log_action($_SESSION['user']['id'], 'INSERT', 'peines', $record_id, [
        'fait' => $fait,
        'type_de_peine' => $type_de_peine,
        'amende' => $amende,
        'gav' => $gav,
        'up' => $up,
        'explications' => $explications,
        'commentaire' => $commentaire,
        'auteur' => $auteur
    ]);

    // ✅ Redirection après ajout
    header("Location: /private/admin_cop.php?success=✅ Peine ajoutée avec succès !");
    exit;
} catch (PDOException $e) {
    error_log("Erreur lors de l'ajout de la peine : " . $e->getMessage());
    header("Location: /private/ajouter_cop.php?error=⚠️ Erreur lors de l'ajout de la peine.");
    exit;
}
?>
