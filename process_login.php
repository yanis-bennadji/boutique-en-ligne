<?php 

include './includes/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES);
    $password = $_POST['password'];

    $user = login($email, $password);

    if ($user) {
        // L'utilisateur est connecté avec succès
        // Redirection vers une page de profil ou autre
        header("Location: profile.php");
        exit();
    } else {
        // L'utilisateur n'a pas pu être connecté
        // Redirection vers une page de connexion avec un message d'erreur
        header("Location: login.php?error=1");
        exit();
    }
} else {
    // Gestion de la requête invalide (éventuellement rediriger ou afficher un message d'erreur)
    echo "Méthode invalide pour accéder à cette page.";
}

?>