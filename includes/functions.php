<?php
include 'db.php';

function signup($first_name, $last_name, $address, $email, $password) {
    global $conn;
    
    if (!$conn) {
        echo "Erreur de connexion à la base de données.";
        return;
    }

    // Requête ajustée pour correspondre aux colonnes de la table
    $sql = "INSERT INTO users (first_name, last_name, address, email, password) VALUES (:first_name, :last_name, :address, :email, :password)";
    
    $stmt = $conn->prepare($sql);
    
    // Liaison des paramètres avec les colonnes correctes
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    
    $stmt->execute();
}

function login($email, $password) {
    global $conn;
    
    if (!$conn) {
        echo "Erreur de connexion à la base de données.";
        return null; // Ou une gestion d'erreur appropriée
    }

    // Sélection de l'utilisateur par email
    $sql = "SELECT * FROM users WHERE email = :email";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    
    // Récupération des informations de l'utilisateur
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Vérification du mot de passe haché
        if (password_verify($password, $user['password'])) {
            return $user; // Authentification réussie
        } else {
            return false; // Mot de passe incorrect
        }
    } else {
        return false; // Utilisateur non trouvé
    }
}
?>
