<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "boutique_en_ligne";

try {
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

} catch (PDOException $e) {
    echo "Erreur de connexion: " . $e->getMessage();
}

?>
