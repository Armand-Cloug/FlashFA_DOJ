<?php
require_once __DIR__ . '/../includes/actions.php'; // ✅ Inclusion des systèmes d'actions

// Vérification de l'authentification
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_proc)) {
    header("Location: /private/dossier.php?error=⛔ Accès refusé.");
    exit;
}

// Vérifier que l'ID est bien envoyé
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    try {
        // ✅ Récupérer les informations du dossier avant suppression
        $stmt = $pdo->prepare("SELECT * FROM dac WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $dac = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$dac) {
            http_response_code(404);
            exit('Dossier introuvable.');
        }

        // 📝 Enregistrer l'action dans les logs avant suppression
        log_action($_SESSION['user']['id'], 'DELETE', 'dac', $id, [
            'nom_affaire' => $dac['nom_affaire'],
            'responsable' => $dac['responsable'],
            'statut' => $dac['statut'],
            'lien_dac' => $dac['lien_dac'],
            'lien_dc' => $dac['lien_dc']
        ]);

        // ✅ Suppression du dossier
        $query = "DELETE FROM dac WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // ✅ Redirection après suppression avec message de succès
        header('Location: ../private/dossier.php?success=Dossier supprimé avec succès');
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
