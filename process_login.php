<?php
session_start(); // Démarrer la session
include 'includes/functions.php';

// Définir le type de réponse en JSON
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES);
    $password = $_POST['password'];

    // Appeler la fonction login pour vérifier les informations d'identification
    $user = login($email, $password);

    if ($user) {
        // Connexion réussie, stocker le prénom de l'utilisateur dans la session
        $_SESSION['first_name'] = $user['first_name'];

        // Retourner une réponse JSON avec succès
        echo json_encode(['success' => true]);
        exit();
    } else {
        // Connexion échouée, retourner une réponse JSON avec un message d'erreur
        echo json_encode(['success' => false, 'message' => 'Email ou mot de passe incorrect']);
        exit();
    }
} else {
    // Requête non valide, retourner une erreur
    echo json_encode(['success' => false, 'message' => 'Méthode de requête invalide']);
    exit();
}
?>
