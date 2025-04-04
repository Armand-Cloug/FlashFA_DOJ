<?php
require_once __DIR__ . '/../includes/actions.php'; // ✅ Inclusion des systèmes d'actions

// Vérification de l'authentification
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_avocats)) {
    header("Location: /private/def.php?error=⛔ Accès refusé.");
    exit;
}

// Vérification que les données sont bien envoyées
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nom_affaire'], $_POST['lien_def'])) {
    $nom_affaire = trim($_POST['nom_affaire']);
    $responsable = isset($_POST['responsable']) ? trim($_POST['responsable']) : null;
    $lien_def = trim($_POST['lien_def']);

    try {
        // Requête pour insérer le DEF
        $query = "INSERT INTO def (nom_affaire, responsable, statut, lien_def) 
                  VALUES (:nom_affaire, :responsable, 'A Rédiger', :lien_def)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':nom_affaire', $nom_affaire, PDO::PARAM_STR);
        $stmt->bindParam(':responsable', $responsable, PDO::PARAM_STR);
        $stmt->bindParam(':lien_def', $lien_def, PDO::PARAM_STR);
        $stmt->execute();

        // Récupérer l'ID du DEF ajouté
        $record_id = $pdo->lastInsertId();

        // 📝 Enregistrer l'action dans les logs
        log_action($_SESSION['user']['id'], 'INSERT', 'def', $record_id, [
            'nom_affaire' => $nom_affaire,
            'responsable' => $responsable,
            'statut' => 'A Rédiger',
            'lien_def' => $lien_def,
        ]);

        // Redirection après l'ajout
        header('Location: ../private/def.php?success=Dossier ajouté avec succès');
        exit();
    } catch (PDOException $e) {
        error_log("Erreur lors de l'ajout du DEF : " . $e->getMessage());
        http_response_code(500);
        exit('Erreur interne du serveur.');
    }
} else {
    http_response_code(400);
    exit('Requête invalide.');
}
