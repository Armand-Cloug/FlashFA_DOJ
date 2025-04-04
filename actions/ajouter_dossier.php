<?php
require_once __DIR__ . '/../includes/actions.php'; // ✅ Inclusion des systèmes d'actions

// Vérification de l'authentification
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_proc)) {
    header("Location: /private/dossier.php?error=⛔ Accès refusé.");
    exit;
}

// Vérification que les données sont bien envoyées
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nom_affaire'], $_POST['lien_dac'], $_POST['lien_dc'])) {
    $nom_affaire = trim($_POST['nom_affaire']);
    $responsable = isset($_POST['responsable']) ? trim($_POST['responsable']) : null;
    $lien_dac = trim($_POST['lien_dac']);
    $lien_dc = trim($_POST['lien_dc']);

    try {
        // Requête pour insérer le DAC
        $query = "INSERT INTO dac (nom_affaire, responsable, statut, lien_dac, lien_dc) 
                  VALUES (:nom_affaire, :responsable, 'A Rédiger', :lien_dac, :lien_dc)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':nom_affaire', $nom_affaire, PDO::PARAM_STR);
        $stmt->bindParam(':responsable', $responsable, PDO::PARAM_STR);
        $stmt->bindParam(':lien_dac', $lien_dac, PDO::PARAM_STR);
        $stmt->bindParam(':lien_dc', $lien_dc, PDO::PARAM_STR);
        $stmt->execute();

        // Récupérer l'ID du DAC ajouté
        $record_id = $pdo->lastInsertId();

        // 📝 Enregistrer l'action dans les logs
        log_action($_SESSION['user']['id'], 'INSERT', 'dac', $record_id, [
            'nom_affaire' => $nom_affaire,
            'responsable' => $responsable,
            'statut' => 'A Rédiger',
            'lien_dac' => $lien_dac,
            'lien_dc' => $lien_dc
        ]);

        // Redirection après l'ajout
        header('Location: ../private/dossier.php?success=Dossier ajouté avec succès');
        exit();
    } catch (PDOException $e) {
        error_log("Erreur lors de l'ajout du DAC : " . $e->getMessage());
        http_response_code(500);
        exit('Erreur interne du serveur.');
    }
} else {
    http_response_code(400);
    exit('Requête invalide.');
}
