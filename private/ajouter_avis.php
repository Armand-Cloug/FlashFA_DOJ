<?php
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';
require_once __DIR__ . '/../includes/session.php';

/* ✅ Vérification du rôle de l'utilisateur */
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_boss_doj_em)) {
    header("Location: /private/avis.php");
    exit;
}
?>

<body class="avis-body">
    <div class="main-content">
        <h1>📜 Ajouter un avis</h1>

        <?php if (isset($_GET["error"])): ?>
            <p class="error-message">
                <?= htmlspecialchars($_GET["error"]); ?>
            </p>
        <?php endif; ?>

        <form action="/actions/ajouter_avis.php" method="POST" class="special-form">
            <!-- ✅ Nom de la cible -->
            <label for="nom_cible">Nom de l'individu recherché :</label>
            <input type="text" name="nom_cible" id="nom_cible" placeholder="Nom complet" required>

            <!-- ✅ Date de naissance de la cible -->
            <label for="naissance_cible">Date de Naissance de l'individu recherché :</label>
            <input type="text" name="naissance_cible" id="naissance_cible" placeholder="Date de Naissance" required>

            <!-- ✅ Alias -->
            <label for="alias_cible">Alias connu :</label>
            <input type="text" name="alias_cible" id="alias_cible" placeholder="Surnom ou pseudonyme" required>

            <!-- ✅ Prime -->
            <label for="prime">Récompense :</label>
            <input type="number" name="prime" id="prime" placeholder="Montant en $" min="0" step="0.01">

            <!-- ✅ Motif -->
            <label for="motif">Motif de l'avis :</label>
            <textarea name="motif" id="motif" rows="4" required></textarea>

            <!-- ✅ Taille -->
            <label for="taille_cible">Taille :</label>
            <input type="text" name="taille_cible" id="taille_cible" placeholder="Ex: 180 cm" required>

            <!-- ✅ Poids -->
            <label for="poids_cible">Poids :</label>
            <input type="text" name="poids_cible" id="poids_cible" placeholder="Ex: 75 kg" required>

            <!-- ✅ Couleur des yeux -->
            <label for="yeux_cible">Couleur des yeux :</label>
            <input type="text" name="yeux_cible" id="yeux_cible" placeholder="Ex: Marron, Bleu" required>

            <!-- ✅ Auteur (pré-rempli avec l'admin connecté) -->
            <label for="auteur">Auteur :</label>
            <input type="text" name="auteur" id="auteur" value="<?= htmlspecialchars($_SESSION['user']['nom'] . ' ' . $_SESSION['user']['prenom']); ?>" readonly>

            <!-- ✅ Bouton Soumettre -->
            <button type="submit" class="btn-submit">Créer l'avis</button>
        </form>
    </div>
</body>
</html>