<?php

/* Log d'erreur */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


/* Chargement du fichier db.env pour la connexion à la base de données */

function loadEnv($file) {
    if (!file_exists($file)) {
        die("Fichier d'environnement introuvable.");
    }

    $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            putenv(trim($key) . "=" . trim($value));
        }
    }
}

// Charger les variables d’environnement
loadEnv(__DIR__ . '/16122003-8265.env');

// Connexion PDO avec les variables d’environnement
try {
    $pdo = new PDO(
        "mysql:host=" . getenv('DB_HOST') . ";dbname=" . getenv('DB_NAME') . ";charset=utf8",
        getenv('DB_USER'),
        getenv('DB_PASS'),
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

?>
