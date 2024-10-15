<?php
include 'includes/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES);
    $password = $_POST['password'];

    // Appel de la fonction login pour vérifier les informations d'identification
    $user = login($email, $password);

    if ($user) {
        // Connexion réussie, redirection vers index.php
        header("Location: index.php");
        exit();
    } else {
        // Connexion échouée, redirection vers login.php avec un message d'erreur
        header("Location: login.php?error=1");
        exit();
    }
} else {
    echo "Méthode invalide pour accéder à cette page.";
}
?>
