<?php
require_once __DIR__ . '/../includes/actions.php'; // ✅ Inclusion des systèmes d'actions

// Vérification des droits
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_boss_doj_em)) {
    header("Location: /private/mandat.php");
    exit();
}

// Vérifie si les données ont été envoyées
if (isset($_POST['mandat_id'], $_POST['nouveau_statut'])) {
    $mandat_id = intval($_POST['mandat_id']);
    $nouveau_statut = trim($_POST['nouveau_statut']);

    // Vérifie si le statut est valide
    $statuts_valides = ['Actif', 'Expiré', 'Exécuté'];
    if (!in_array($nouveau_statut, $statuts_valides)) {
        die("⛔ Statut invalide !");
    }

    try {
        // ✅ Récupérer l'ancien statut avant mise à jour
        $stmt = $pdo->prepare("SELECT status FROM mandats WHERE id = :id");
        $stmt->execute([':id' => $mandat_id]);
        $old_data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$old_data) {
            header("Location: ../private/mandat.php?error=not_found");
            exit();
        }

        // Met à jour le statut dans la base de données
        $query = "UPDATE mandats SET status = :status WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['status' => $nouveau_statut, 'id' => $mandat_id]);

        // 📝 Enregistrer l'action dans les logs (Modification du statut du mandat)
        log_action($_SESSION['user']['id'], 'UPDATE_STATUS', 'mandats', $mandat_id, [
            'old_status' => $old_data['status'],
            'new_status' => $nouveau_statut
        ]);

        // ✅ Redirection après mise à jour
        header("Location: ../private/mandat.php?success=updated");
        exit();
    } catch (PDOException $e) {
        error_log("Erreur SQL : " . $e->getMessage());
        header("Location: ../private/mandat.php?error=server_error");
        exit();
    }
} else {
    header("Location: ../private/mandat.php?error=missing_fields");
    exit();
}
?>
