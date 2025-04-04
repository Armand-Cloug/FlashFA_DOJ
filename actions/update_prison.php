<?php
require_once __DIR__ . '/../includes/actions.php'; // ✅ Inclusion des systèmes d'actions

/* ✅ Définition des rôles autorisés */
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_boss_doj_em)) {
    header("Location: /private/prison.php?error=⛔ Accès refusé.");
    exit;
}

// Vérifier si toutes les valeurs sont envoyées
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'], $_POST['prisonier'], $_POST['responsable'], $_POST['date_incarceration'], $_POST['motif'])) {
    $id = intval($_POST['id']);
    $prisonier = trim($_POST['prisonier']);
    $responsable = trim($_POST['responsable']);
    $date_incarceration = $_POST['date_incarceration'];
    $motif = trim($_POST['motif']);
    $numero_ra = !empty($_POST['numero_ra']) ? trim($_POST['numero_ra']) : null;
    $dac = !empty($_POST['dac']) ? trim($_POST['dac']) : null;

    try {
        // ✅ Récupérer les anciennes valeurs avant mise à jour
        $stmt = $pdo->prepare("SELECT * FROM prison WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $old_data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$old_data) {
            header("Location: ../private/prison.php?error=not_found");
            exit();
        }

        // Mise à jour du prisonnier
        $query = "UPDATE prison SET prisonier = ?, responsable = ?, date_incarceration = ?, motif = ?, numero_ra = ?, dac = ? WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$prisonier, $responsable, $date_incarceration, $motif, $numero_ra, $dac, $id]);

        // 📝 Enregistrer l'action dans les logs (Modification d'un prisonnier)
        log_action($_SESSION['user']['id'], 'UPDATE', 'prison', $id, [
            'old_data' => $old_data,
            'new_data' => [
                'prisonier' => $prisonier,
                'responsable' => $responsable,
                'date_incarceration' => $date_incarceration,
                'motif' => $motif,
                'numero_ra' => $numero_ra,
                'dac' => $dac
            ]
        ]);

        // ✅ Redirection après mise à jour
        header("Location: ../private/prison.php?success=updated");
        exit();
    } catch (PDOException $e) {
        error_log("Erreur SQL : " . $e->getMessage());
        header("Location: ../private/prison.php?error=server_error");
        exit();
    }
} else {
    header("Location: ../private/prison.php?error=missing_fields");
    exit();
}
?>
