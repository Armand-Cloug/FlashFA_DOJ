<?php
require_once __DIR__ . '/../includes/actions.php'; // ✅ Inclusion des systèmes d'actions

/* ✅ Définition des rôles autorisés */
$roles_autorises = ['Admin'];
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_autorises)) {
    header("Location: /private/admin_cop.php?error=⛔ Accès refusé.");
    exit;
}

// ✅ Vérification de l'ID de la peine à supprimer
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: /private/admin_cop.php?error=❌ ID de peine invalide.");
    exit;
}

$peine_id = intval($_GET['id']);

try {
    // ✅ Vérification si la peine existe
    $stmt = $pdo->prepare("SELECT * FROM peines WHERE id = ?");
    $stmt->execute([$peine_id]);
    $peine = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$peine) {
        header("Location: /private/peines.php?error=⚠️ Peine introuvable.");
        exit;
    }

    // ✅ Suppression de la peine
    $stmt = $pdo->prepare("DELETE FROM peines WHERE id = ?");
    $stmt->execute([$peine_id]);

    // 📝 Enregistrer l'action dans les logs
    log_action($_SESSION['user']['id'], 'DELETE', 'peines', $peine_id, [
        'fait' => $peine['fait'],
        'type_de_peine' => $peine['type_de_peine'],
        'amende' => $peine['amende'],
        'gav' => $peine['gav'],
        'up' => $peine['up'],
        'explications' => $peine['explications'],
        'commentaire' => $peine['commentaire']
    ]);

    // ✅ Redirection après suppression
    header("Location: /private/admin_cop.php?success=✅ Peine supprimée avec succès !");
    exit;
} catch (PDOException $e) {
    error_log("Erreur lors de la suppression de la peine : " . $e->getMessage());
    header("Location: /private/admin_cop.php?error=⚠️ Erreur lors de la suppression de la peine.");
    exit;
}
?>
