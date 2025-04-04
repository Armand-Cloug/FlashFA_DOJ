<?php
require_once __DIR__ . '/../includes/actions.php'; // ✅ Inclusion des systèmes d'actions

/* ✅ Définition des rôles autorisés */
$roles_autorises = ['Admin'];
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_autorises)) {
    header("Location: /private/admin_mandat.php?error=⛔ Accès refusé.");
    exit;
}

// Vérifie si toutes les valeurs sont envoyées
if (isset($_POST['mandat_id'], $_POST['type'], $_POST['cible'], $_POST['status'], $_POST['auteur'], $_POST['date_creation'])) {
    $id = $_POST['mandat_id'];
    $type = $_POST['type'];
    $cible = $_POST['cible'];
    $status = $_POST['status'];
    $auteur = $_POST['auteur'];
    $date_creation = $_POST['date_creation'];

    try {
        // ✅ Récupérer les anciennes valeurs avant mise à jour
        $stmt = $pdo->prepare("SELECT * FROM mandats WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $old_data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$old_data) {
            header("Location: ../private/mandat_admin.php?error=not_found");
            exit();
        }

        // Mise à jour dans la base de données
        $query = "UPDATE mandats SET type = :type, cible = :cible, status = :status, auteur = :auteur, date_creation = :date_creation WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            'type' => $type,
            'cible' => $cible,
            'status' => $status,
            'auteur' => $auteur,
            'date_creation' => $date_creation,
            'id' => $id
        ]);

        // 📝 Enregistrer l'action dans les logs (Modification d'un mandat)
        log_action($_SESSION['user']['id'], 'UPDATE', 'mandats', $id, [
            'old_data' => $old_data,
            'new_data' => [
                'type' => $type,
                'cible' => $cible,
                'status' => $status,
                'auteur' => $auteur,
                'date_creation' => $date_creation
            ]
        ]);

        // ✅ Redirection après mise à jour
        header("Location: ../private/mandat_admin.php?success=updated");
        exit();
    } catch (PDOException $e) {
        error_log("Erreur lors de la mise à jour du mandat : " . $e->getMessage());
        header("Location: ../private/mandat_admin.php?error=server_error");
        exit();
    }
} else {
    header("Location: ../private/mandat_admin.php?error=missing_fields");
    exit();
}
?>
