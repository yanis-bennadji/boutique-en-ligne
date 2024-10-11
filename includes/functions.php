<?php
include 'db.php';

function signup($first_name, $last_name, $address, $email, $password) {
    global $conn;
    
    if (!$conn) {
        echo "Erreur de connexion à la base de données.";
        return;
    }

    $sql = "INSERT INTO users (first_name, last_name, address, email, password) VALUES (:first_name, :last_name, :address, :email, :password)";
    
    $stmt = $conn->prepare($sql);
    
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

    $sql = "SELECT * FROM users WHERE email = :email AND password = :password";
    
    $stmt = $conn->prepare($sql);
    
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    
    $stmt->execute();
    
    return $stmt->fetch();
}
?>
