<?php
require_once __DIR__ . '/database.php';
require_once __DIR__ . '/perm.php';
require_once __DIR__ . '/../includes/session.php';

function log_action($user_id, $action, $table_name, $record_id, $changes) {
    global $pdo;

    try {
        $query = "INSERT INTO logs (user_id, action, table_name, record_id, changes) 
                  VALUES (:user_id, :action, :table_name, :record_id, :changes)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            ':user_id' => $user_id,
            ':action' => $action,
            ':table_name' => $table_name,
            ':record_id' => $record_id,
            ':changes' => json_encode($changes, JSON_UNESCAPED_UNICODE)
        ]);
    } catch (PDOException $e) {
        error_log("Erreur lors de l'ajout du log : " . $e->getMessage());
    }
}
?>