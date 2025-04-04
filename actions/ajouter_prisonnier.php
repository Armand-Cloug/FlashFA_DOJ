<?php
require_once __DIR__ . '/../includes/actions.php'; // ✅ Inclusion des systèmes d'actions

// Vérifier si l'utilisateur a les droits
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_boss_doj_em)) {
    header("Location: /private/prison.php");
    exit;
}

// Vérifier que toutes les données requises sont présentes
if (isset($_POST['prisonier'], $_POST['responsable'], $_POST['date_incarceration'], $_POST['duree'], $_POST['motif'])) {
    $prisonier = htmlspecialchars($_POST['prisonier']);
    $responsable = htmlspecialchars($_POST['responsable']);
    $date_incarceration = htmlspecialchars($_POST['date_incarceration']);
    $duree = htmlspecialchars($_POST['duree']);
    $motif = htmlspecialchars($_POST['motif']);
    $numero_ra = !empty($_POST['numero_ra']) ? htmlspecialchars($_POST['numero_ra']) : NULL;
    $dac = !empty($_POST['dac']) ? htmlspecialchars($_POST['dac']) : NULL;

    try {
        // ✅ Requête SQL pour insérer un nouveau prisonnier
        $sql = "INSERT INTO prison (prisonier, responsable, date_incarceration, duree, motif, numero_ra, dac)
                VALUES (:prisonier, :responsable, :date_incarceration, :duree, :motif, :numero_ra, :dac)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':prisonier' => $prisonier,
            ':responsable' => $responsable,
            ':date_incarceration' => $date_incarceration,
            ':duree' => $duree,
            ':motif' => $motif,
            ':numero_ra' => $numero_ra,
            ':dac' => $dac
        ]);

        // ✅ Récupérer l'ID du prisonnier ajouté
        $record_id = $pdo->lastInsertId();

        // 📝 Enregistrer l'action dans les logs
        log_action($_SESSION['user']['id'], 'INSERT', 'prison', $record_id, [
            'prisonier' => $prisonier,
            'responsable' => $responsable,
            'date_incarceration' => $date_incarceration,
            'duree' => $duree,
            'motif' => $motif,
            'numero_ra' => $numero_ra,
            'dac' => $dac
        ]);

        // ✅ Redirection vers la page des prisonniers après succès
        header("Location: /private/prison.php?success=1");
        exit;
    } catch (PDOException $e) {
        die("Erreur lors de l'ajout du prisonnier : " . $e->getMessage());
    }
} else {
    // ❌ Redirection si des champs sont manquants
    header("Location: /private/ajouter_prisonnier.php?error=missing_fields");
    exit;
}
