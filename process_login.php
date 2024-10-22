<?php
// Vérification si la session n'est pas déjà démarrée pour éviter des erreurs
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Démarrer la session si elle n'est pas déjà démarrée
}

include 'includes/functions.php';

// Définir le type de réponse en JSON
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES);
    $password = $_POST['password'];

    // Appeler la fonction login pour vérifier les informations d'identification
    $user = login($email, $password);

    if ($user) {
        // Connexion réussie, régénérer l'ID de session pour la sécurité
        session_regenerate_id(true); 
        
        // Stocker le prénom et l'ID de l'utilisateur dans la session
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['user_id'] = $user['id']; // Stocker également l'ID utilisateur

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
    