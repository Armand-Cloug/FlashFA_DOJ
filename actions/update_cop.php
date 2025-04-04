<?php
require_once __DIR__ . '/../includes/actions.php'; // ✅ Inclusion des systèmes d'actions

/* ✅ Définition des rôles autorisés */
$roles_autorises = ['Admin'];
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_autorises)) {
    header("Location: /private/admin_cop.php?error=⛔ Accès refusé.");
    exit;
}

// ✅ Vérification des champs obligatoires
if (!isset($_POST['id']) || empty($_POST['id'])) {
    header("Location: /private/peines.php?error=❌ ID de la peine manquant.");
    exit;
}

$peine_id = intval($_POST['id']);
$fait = trim($_POST['fait'] ?? '');
$type_de_peine = trim($_POST['type_de_peine'] ?? '');
$amende = isset($_POST['amende']) ? floatval($_POST['amende']) : null;
$gav = isset($_POST['gav']) ? $_POST['gav'] : '00:00:00';
$up = isset($_POST['up']) ? intval($_POST['up']) : 0;
$explications = trim($_POST['explications'] ?? '');
$commentaire = trim($_POST['commentaire'] ?? '');

/* ✅ Vérification des champs requis */
if (empty($fait) || empty($type_de_peine) || empty($explications)) {
    header("Location: /private/peines.php?error=❌ Remplissez tous les champs obligatoires.");
    exit;
}

try {
    // ✅ Vérification si la peine existe
    $stmt = $pdo->prepare("SELECT * FROM peines WHERE id = ?");
    $stmt->execute([$peine_id]);
    $peine = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$peine) {
        header("Location: /private/peines.php?error=⚠️ Peine introuvable.");
        exit;
    }

    // ✅ Mise à jour des données en base
    $stmt = $pdo->prepare("UPDATE peines 
                           SET fait = ?, type_de_peine = ?, amende = ?, gav = ?, up = ?, explications = ?, commentaire = ? 
                           WHERE id = ?");

    $stmt->execute([$fait, $type_de_peine, $amende, $gav, $up, $explications, $commentaire, $peine_id]);

    // 📝 Enregistrer l'action dans les logs
    log_action($_SESSION['user']['id'], 'UPDATE', 'peines', $peine_id, [
        'fait' => $fait,
        'type_de_peine' => $type_de_peine,
        'amende' => $amende,
        'gav' => $gav,
        'up' => $up,
        'explications' => $explications,
        'commentaire' => $commentaire
    ]);

    // ✅ Redirection après modification
    header("Location: /private/admin_cop.php?success=✅ Peine mise à jour avec succès !");
    exit;
} catch (PDOException $e) {
    error_log("Erreur lors de la mise à jour de la peine : " . $e->getMessage());
    header("Location: /private/admin_cop.php?error=⚠️ Erreur lors de la mise à jour de la peine.");
    exit;
}
?>
