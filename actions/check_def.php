<?php
require_once __DIR__ . '/../includes/actions.php'; // ✅ Inclusion des systèmes d'actions

// Vérification de l'authentification
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_avocats)) {
    header("Location: /private/def.php?error=⛔ Accès refusé.");
    exit;
}

// Vérification que les données sont bien envoyées
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['statut'])) {
    $id = $_POST['id'];
    $statut = $_POST['statut'];

    // Sécurité : Vérifier que le statut est valide
    $statuts_valides = ['A Rédiger', 'En cours de rédaction', 'Transmis au Juge', 'Affaire close'];
    if (!in_array($statut, $statuts_valides)) {
        http_response_code(400);
        exit('Statut invalide.');
    }

    try {
        // ✅ Récupérer l'ancien statut avant modification
        $stmt = $pdo->prepare("SELECT statut FROM def WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $ancien_statut = $stmt->fetchColumn();

        if (!$ancien_statut) {
            http_response_code(404);
            exit('def introuvable.');
        }

        // ✅ Mise à jour du statut du def
        $query = "UPDATE def SET statut = :statut WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':statut', $statut, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // 📝 Enregistrer l'action dans les logs
        log_action($_SESSION['user']['id'], 'UPDATE', 'def', $id, [
            'ancien_statut' => $ancien_statut,
            'nouveau_statut' => $statut
        ]);

        // ✅ Redirection après la mise à jour
        header('Location: ../private/def.php?success=Statut mis à jour');
        exit();
    } catch (PDOException $e) {
        error_log("Erreur lors de la mise à jour du def : " . $e->getMessage());
        http_response_code(500);
        exit('Erreur interne du serveur.');
    }
} else {
    http_response_code(400);
    exit('Requête invalide.');
}
