<?php
require_once __DIR__ . '/../includes/actions.php'; // ✅ Inclusion des systèmes d'actions

// Vérification des droits
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_boss_doj_em)) {
    header("Location: /private/prison.php");
    exit();
}

// ✅ Vérification de la requête et des données envoyées
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']) && is_numeric($_POST['id'])) {
    $id = intval($_POST['id']);

    try {
        // ✅ Récupérer les informations du prisonnier avant suppression
        $stmt = $pdo->prepare("SELECT * FROM prison WHERE id = ?");
        $stmt->execute([$id]);
        $prisonnier = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$prisonnier) {
            header("Location: ../private/prison.php?error=not_found");
            exit();
        }

        // 📝 Enregistrer l'action dans les logs avant suppression
        log_action($_SESSION['user']['id'], 'DELETE', 'prison', $id, [
            'prisonier' => $prisonnier['prisonier'],
            'responsable' => $prisonnier['responsable'],
            'date_incarceration' => $prisonnier['date_incarceration'],
            'duree' => $prisonnier['duree'],
            'motif' => $prisonnier['motif'],
            'numero_ra' => $prisonnier['numero_ra'],
            'dac' => $prisonnier['dac']
        ]);

        // ✅ Suppression du prisonnier
        $stmt = $pdo->prepare("DELETE FROM prison WHERE id = ?");
        $stmt->execute([$id]);

        // ✅ Redirection après suppression avec message de succès
        header("Location: ../private/prison.php?success=Prisonnier supprimé avec succès");
        exit();
    } catch (PDOException $e) {
        error_log("Erreur lors de la suppression du prisonnier : " . $e->getMessage());
        header("Location: ../private/prison.php?error=server_error");
        exit();
    }
} else {
    header("Location: ../private/prison.php?error=invalid_request");
    exit();
}
?>
