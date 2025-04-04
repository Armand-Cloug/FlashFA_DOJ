<?php
require_once __DIR__ . '/../includes/actions.php'; // ✅ Inclusion des systèmes d'actions

/* ✅ Définition des rôles autorisés */
$roles_autorises = ['Admin'];
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_autorises)) {
    header("Location: /private/admin_mandat.php?error=⛔ Accès refusé.");
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // ✅ Récupérer les informations du mandat avant suppression
        $stmt = $pdo->prepare("SELECT * FROM mandats WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $mandat = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$mandat) {
            die("Erreur : Mandat introuvable !");
        }

        // 📝 Enregistrer l'action dans les logs avant suppression
        log_action($_SESSION['user']['id'], 'DELETE', 'mandats', $id, [
            'type' => $mandat['type'],
            'cible' => $mandat['cible'],
            'adresse' => $mandat['adresse'],
            'biens' => $mandat['biens'],
            'motif' => $mandat['motif'],
            'auteur' => $mandat['auteur'],
            'status' => $mandat['status'],
            'lien_unique' => $mandat['lien_unique']
        ]);

        // ✅ Suppression du mandat
        $query = "DELETE FROM mandats WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute([':id' => $id]);

        header("Location: ../private/admin_mandat.php");
        exit();
    } catch (PDOException $e) {
        error_log("Erreur lors de la suppression du mandat : " . $e->getMessage());
        die("Erreur interne du serveur.");
    }
} else {
    die("Requête invalide !");
}
