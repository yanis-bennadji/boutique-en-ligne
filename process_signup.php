<?php
include 'includes/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer et sécuriser les données du formulaire
    $first_name = htmlspecialchars($_POST['first_name'] ?? '', ENT_QUOTES);
    $last_name = htmlspecialchars($_POST['last_name'] ?? '', ENT_QUOTES);
    $address = htmlspecialchars($_POST['address'] ?? '', ENT_QUOTES);
    $email = htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hachage du mot de passe

    // Appeler la fonction signup pour enregistrer l'utilisateur dans la base de données
    signup($first_name, $last_name, $address, $email, $password);

    // Rediriger vers la page d'accueil après l'inscription réussie
    header("Location: index.php");
    exit();
} else {
    echo "Méthode invalide pour accéder à cette page.";
}
?>
