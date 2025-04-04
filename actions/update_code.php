<?php
require_once __DIR__ . '/../includes/actions.php'; // ✅ Inclusion des systèmes d'actions

// Vérification des droits
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_boss_doj_em)) {
    header("Location: /private/code_etat.php");
    exit();
}

// Vérifier si toutes les données sont envoyées
if (
    isset($_POST['id'], $_POST['type'], $_POST['lieu'], $_POST['date_debut'], $_POST['responsable'], $_POST['raison']) 
    && !empty($_POST['id'])
    && !empty($_POST['type'])
    && !empty($_POST['lieu'])
    && !empty($_POST['date_debut'])
    && !empty($_POST['responsable'])
    && !empty($_POST['raison'])
) {
    $id = $_POST['id'];
    $type = $_POST['type'];
    $lieu = trim($_POST['lieu']);
    $date_debut = $_POST['date_debut'];
    $date_fin = !empty($_POST['date_fin']) ? $_POST['date_fin'] : NULL;
    $responsable = trim($_POST['responsable']);
    $raison = trim($_POST['raison']);

    try {
        // ✅ Récupérer les anciennes valeurs avant mise à jour
        $stmt = $pdo->prepare("SELECT * FROM codes_etat WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $old_data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$old_data) {
            header("Location: /private/code_etat.php?error=not_found");
            exit();
        }

        // Mise à jour des informations du code d’état
        $query = "UPDATE codes_etat 
                  SET type = :type, lieu = :lieu, date_debut = :date_debut, date_fin = :date_fin, responsable = :responsable, raison = :raison 
                  WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            ':type' => $type,
            ':lieu' => $lieu,
            ':date_debut' => $date_debut,
            ':date_fin' => $date_fin,
            ':responsable' => $responsable,
            ':raison' => $raison,
            ':id' => $id
        ]);

        // 📝 Enregistrer l'action dans les logs (Modification d'un code d’état)
        log_action($_SESSION['user']['id'], 'UPDATE', 'codes_etat', $id, [
            'old_data' => $old_data,
            'new_data' => [
                'type' => $type,
                'lieu' => $lieu,
                'date_debut' => $date_debut,
                'date_fin' => $date_fin,
                'responsable' => $responsable,
                'raison' => $raison
            ]
        ]);

        // ✅ Redirection après mise à jour
        header("Location: /private/code_etat.php?success=updated");
        exit();
    } catch (PDOException $e) {
        error_log("Erreur lors de la mise à jour du code d’état : " . $e->getMessage());
        header("Location: /private/code_etat.php?error=server_error");
        exit();
    }
} else {
    // Redirection en cas de champ manquant
    header("Location: /private/update_code.php?id=" . $_POST['id'] . "&error=missing_fields");
    exit();
}
?>
