<?php
require_once __DIR__ . '/../includes/actions.php'; // ✅ Inclusion des systèmes d'actions

/* ✅ Définition des rôles autorisés */
$roles_autorises = ['Admin'];
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_autorises)) {
    header("Location: /private/admin_code.php?error=⛔ Accès refusé.");
    exit;
}

// Vérifier que l'ID est bien envoyé
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    try {
        // ✅ Récupérer les informations du dossier avant suppression
        $stmt = $pdo->prepare("SELECT * FROM codes_etat WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $dac = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$dac) {
            http_response_code(404);
            exit('Dossier introuvable.');
        }

        // 📝 Enregistrer l'action dans les logs avant suppression
        log_action($_SESSION['user']['id'], 'DELETE', 'codes_etat', $id, [
            'type' => $type,
            'lieu' => $lieu,
            'date_debut' => $date_debut,
            'date_fin' => $date_fin,
            'responsable' => $responsable,
            'raison' => $raison,
            'id' => $id
        ]);

        // ✅ Suppression du dossier
        $query = "DELETE FROM codes_etat WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // ✅ Redirection après suppression avec message de succès
        header('Location: ../private/admin_code.php?success=Dossier supprimé avec succès');
        exit();
    } catch (PDOException $e) {
        error_log("Erreur lors de la suppression du dossier : " . $e->getMessage());
        http_response_code(500);
        exit('Erreur interne du serveur.');
    }
} else {
    http_response_code(400);
    exit('Requête invalide.');
}
