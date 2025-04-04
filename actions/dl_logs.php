<?php
require_once __DIR__ . '/../includes/actions.php'; // ✅ Inclusion des systèmes d'actions

/* ✅ Définition des rôles autorisés */
$roles_autorises = ['Admin'];
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_autorises)) {
    header("Location: /private/admin_logs.php?error=⛔ Accès refusé.");
    exit;
}

// Récupération de tous les logs
$query = "SELECT logs.timestamp, users.nom, users.prenom, logs.action, logs.table_name, logs.record_id, logs.changes
          FROM logs
          JOIN users ON logs.user_id = users.id
          ORDER BY logs.timestamp DESC";

$stmt = $pdo->query($query);
$logs = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Définition du nom du fichier
$filename = "logs_" . date("Y-m-d_H-i-s") . ".csv";

// Définition des headers pour le téléchargement
header('Content-Type: text/csv; charset=UTF-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');

// Ouverture d'un flux en mode écriture
$output = fopen('php://output', 'w');

// Écriture de l'en-tête du CSV
fputcsv($output, ['Date', 'Utilisateur', 'Action', 'Table', 'ID', 'Détails'], ';');

// Écriture des données des logs
foreach ($logs as $log) {
    fputcsv($output, [
        $log['timestamp'],
        $log['nom'] . ' ' . $log['prenom'],
        $log['action'],
        $log['table_name'],
        $log['record_id'],
        $log['changes']
    ], ';');
}

// Fermeture du fichier CSV
fclose($output);
exit();
