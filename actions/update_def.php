<?php
require_once __DIR__ . '/../includes/actions.php'; // ✅ Inclusion des systèmes d'actions

/* ✅ Définition des rôles autorisés */
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_avocats)) {
    header("Location: /private/def.php?error=⛔ Accès refusé.");
    exit;
}

// Vérification que les données sont bien envoyées
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['nom_affaire'], $_POST['lien_def'], $_POST['statut'])) {
    $id = $_POST['id'];
    $nom_affaire = trim($_POST['nom_affaire']);
    $responsable = !empty($_POST['responsable']) ? trim($_POST['responsable']) : null;
    $lien_def = trim($_POST['lien_def']);
    $statut = $_POST['statut'];

    try {
        // ✅ Récupérer les anciennes valeurs avant mise à jour
        $stmt = $pdo->prepare("SELECT * FROM def WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $old_data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$old_data) {
            header("Location: ../private/dossier.php?error=not_found");
            exit();
        }

        // Mise à jour du dossier (`def`)
        $query = "UPDATE def SET nom_affaire = :nom_affaire, responsable = :responsable, statut = :statut, 
                  lien_def = :lien_def WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            ':nom_affaire' => $nom_affaire,
            ':responsable' => $responsable,
            ':statut' => $statut,
            ':lien_def' => $lien_def,
            ':id' => $id
        ]);

        // 📝 Enregistrer l'action dans les logs (Modification d'un dossier)
        log_action($_SESSION['user']['id'], 'UPDATE', 'def', $id, [
            'old_data' => $old_data,
            'new_data' => [
                'nom_affaire' => $nom_affaire,
                'responsable' => $responsable,
                'statut' => $statut,
                'lien_def' => $lien_def
            ]
        ]);

        // ✅ Redirection après mise à jour
        header("Location: ../private/def.php?success=Dossier modifié avec succès");
        exit();
    } catch (PDOException $e) {
        error_log("Erreur lors de la mise à jour du dossier : " . $e->getMessage());
        header('Location: ../private/update_def.php?id=' . $id . '&error=server_error');
        exit();
    }
} else {
    header("Location: ../private/update_def.php?id=" . $_POST['id'] . "&error=missing_fields");
    exit();
}
?>
