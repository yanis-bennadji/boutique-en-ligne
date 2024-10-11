<?php

include './includes/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars($_POST['nom'] ?? '', ENT_QUOTES);
    $prenom = htmlspecialchars($_POST['prenom'] ?? '', ENT_QUOTES);
    $adresse = htmlspecialchars($_POST['adresse'] ?? '', ENT_QUOTES);
    $email = htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES);
    $password = $_POST['password']; // Le mot de passe n'a pas besoin d'être htmlspecialchars car il est stocké en tant que hash dans la base de données

    signup($nom, $prenom, $adresse, $email, password_hash($password, PASSWORD_DEFAULT)); // Utilisation de password_hash pour sécuriser le mot de passe

    header("Location: confirmation.php");
    exit();
} else {
    echo "Méthode invalide pour accéder à cette page.";
}
?>
