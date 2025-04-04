<?php
require_once __DIR__ . '/../includes/actions.php'; // ✅ Inclusion des systèmes d'actions

/* ✅ Définition des rôles autorisés */
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_proc)) {
    header("Location: /private/admin_mandat.php?error=⛔ Accès refusé.");
    exit;
}

// Vérification que les données sont bien envoyées
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['nom_affaire'], $_POST['lien_dac'], $_POST['lien_dc'], $_POST['statut'])) {
    $id = $_POST['id'];
    $nom_affaire = trim($_POST['nom_affaire']);
    $responsable = !empty($_POST['responsable']) ? trim($_POST['responsable']) : null;
    $lien_dac = trim($_POST['lien_dac']);
    $lien_dc = trim($_POST['lien_dc']);
    $statut = $_POST['statut'];

    try {
        // ✅ Récupérer les anciennes valeurs avant mise à jour
        $stmt = $pdo->prepare("SELECT * FROM dac WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $old_data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$old_data) {
            header("Location: ../private/dossier.php?error=not_found");
            exit();
        }

        // Mise à jour du dossier (`DAC`)
        $query = "UPDATE dac SET nom_affaire = :nom_affaire, responsable = :responsable, statut = :statut, 
                  lien_dac = :lien_dac, lien_dc = :lien_dc WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            ':nom_affaire' => $nom_affaire,
            ':responsable' => $responsable,
            ':statut' => $statut,
            ':lien_dac' => $lien_dac,
            ':lien_dc' => $lien_dc,
            ':id' => $id
        ]);

        // 📝 Enregistrer l'action dans les logs (Modification d'un dossier)
        log_action($_SESSION['user']['id'], 'UPDATE', 'dac', $id, [
            'old_data' => $old_data,
            'new_data' => [
                'nom_affaire' => $nom_affaire,
                'responsable' => $responsable,
                'statut' => $statut,
                'lien_dac' => $lien_dac,
                'lien_dc' => $lien_dc
            ]
        ]);

        // ✅ Redirection après mise à jour
        header("Location: ../private/dossier.php?success=Dossier modifié avec succès");
        exit();
    } catch (PDOException $e) {
        error_log("Erreur lors de la mise à jour du dossier : " . $e->getMessage());
        header('Location: ../private/update_dossier.php?id=' . $id . '&error=server_error');
        exit();
    }
} else {
    header("Location: ../private/update_dossier.php?id=" . $_POST['id'] . "&error=missing_fields");
    exit();
}
?>
