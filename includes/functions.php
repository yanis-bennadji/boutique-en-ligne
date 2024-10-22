<?php
include 'db.php'; // Connexion à la base de données

// Fonction pour inscrire un utilisateur
function signup($first_name, $last_name, $address, $email, $password) {
    global $conn;
    
    if (!$conn) {
        echo "Erreur de connexion à la base de données.";
        return;
    }

    // Insertion de l'utilisateur
    $sql = "INSERT INTO users (first_name, last_name, address, email, password) VALUES (:first_name, :last_name, :address, :email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
}

// Fonction pour vérifier la connexion de l'utilisateur
function login($email, $password) {
    global $conn;
    
    if (!$conn) {
        echo "Erreur de connexion à la base de données.";
        return null;
    }

    // Rechercher l'utilisateur par email
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        return $user; // Connexion réussie
    } else {
        return false; // Échec de la connexion
    }
}

// Fonction pour récupérer les données de l'utilisateur connecté
function getUserData($user_id) {
    global $conn;
    
    $sql = "SELECT * FROM users WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $user_id);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC); // Retourner les informations de l'utilisateur
}

// Fonction pour mettre à jour les données de l'utilisateur
function updateUser($user_id, $first_name, $last_name, $email, $address, $phone) {
    global $conn;

    $sql = "UPDATE users SET first_name = :first_name, last_name = :last_name, email = :email, address = :address, phone = :phone WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':id', $user_id);
    $stmt->execute();
}
?>
