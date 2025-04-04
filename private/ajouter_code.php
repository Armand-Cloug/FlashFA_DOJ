<?php
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';

// Vérification que l'utilisateur a les droits
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_boss_doj_em)) {
    header("Location: /private/code_etat.php");
    exit;
}
?>

<body class="code-body">
    <div class="main-content">
        <h1>Ajouter un Prisonnier</h1>

        <form action="/actions/ajouter_code.php" method="POST" class="special-form">
            <!-- Type de Code -->
            <label for="type">Couleur du Code</label>
            <select name="type" id="type" required>
                <option value="orange">🟠 Orange</option>
                <option value="rouge">🔴 Rouge</option>
                <option value="noir">⚫ Noir</option>
            </select>

            <!-- Lieu -->
            <label for="lieu">Lieu du Code</label>
            <input type="text" id="lieu" name="lieu" required>

            <!-- Date de début -->
            <label for="date_debut">Date de Commencement</label>
            <input type="date" id="date_debut" name="date_debut" required>

            <!-- Date de fin (optionnelle) -->
            <label for="date_fin">Date de fin (Facultatif)</label>
            <input type="date" id="date_fin" name="date_fin">

            <!-- Responsable -->
            <label for="responsable">Responsable</label>
            <input type="text" id="responsable" name="responsable" required>

            <!-- Motif -->
            <label for="motif">Motif du Code</label>
            <input type="text" id="motif" name="motif" required>

            <!-- Bouton Ajouter -->
            <button type="submit" class="btn-add">Ajouter</button>
        </form>
    </div>
</body>
</html>

