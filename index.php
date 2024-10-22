<?php
session_start(); // Démarrer la session

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['first_name'])) {
    // L'utilisateur est connecté, afficher son prénom
    $greeting = "Hi " . htmlspecialchars($_SESSION['first_name']);
    $is_logged_in = true; // Indique que l'utilisateur est connecté
} else {
    // Aucun utilisateur n'est connecté
    $greeting = "Hi, you are not logged in";
    $is_logged_in = false; // Indique que personne n'est connecté
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
</head>
<body>

    <h1><?php echo $greeting; ?></h1>

    <?php if ($is_logged_in): ?>
        <!-- Afficher le bouton de déconnexion si l'utilisateur est connecté -->
        <form action="logout.php" method="post">
            <button type="submit">Logout</button>
        </form>
    <?php endif; ?>

    <a href="./dashboard.php">Dashboard</a>

</body>
</html>
