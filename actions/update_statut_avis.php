<?php
require_once __DIR__ . '/../includes/actions.php'; // ✅ Inclusion des systèmes d'actions

// Vérification des droits
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_boss_doj_em)) {
    header("Location: /private/avis.php");
    exit();
}

// Vérifie si les données ont été envoyées
if (isset($_POST['avis_id'], $_POST['nouveau_statut'])) {
    $avis_id = intval($_POST['avis_id']);
    $nouveau_statut = trim($_POST['nouveau_statut']);

    // Vérifie si le statut est valide
    $statuts_valides = ['Actif', 'Expiré', 'Exécuté'];
    if (!in_array($nouveau_statut, $statuts_valides)) {
        die("⛔ Statut invalide !");
    }

    try {
        // ✅ Récupérer l'ancien statut avant mise à jour
        $stmt = $pdo->prepare("SELECT status FROM avis WHERE id = :id");
        $stmt->execute([':id' => $avis_id]);
        $old_data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$old_data) {
            header("Location: ../private/avis.php?error=not_found");
            exit();
        }

        // Met à jour le statut dans la base de données
        $query = "UPDATE avis SET status = :status WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['status' => $nouveau_statut, 'id' => $avis_id]);

        // 📝 Enregistrer l'action dans les logs (Modification du statut du avis)
        log_action($_SESSION['user']['id'], 'UPDATE_STATUS', 'avis', $avis_id, [
            'old_status' => $old_data['status'],
            'new_status' => $nouveau_statut
        ]);

        // ✅ Redirection après mise à jour
        header("Location: ../private/avis.php?success=updated");
        exit();
    } catch (PDOException $e) {
        error_log("Erreur SQL : " . $e->getMessage());
        header("Location: ../private/avis.php?error=server_error");
        exit();
    }
} else {
    header("Location: ../private/avis.php?error=missing_fields");
    exit();
}
?>
