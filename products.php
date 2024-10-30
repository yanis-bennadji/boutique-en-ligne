<?php

include 'includes/header.php'; // Inclure le header dynamique
include 'includes/db.php'; // Inclure la connexion à la base de données

// Vérifier si l'utilisateur est connecté
$isConnected = isset($_SESSION['user_id']);

// Requête pour récupérer tous les produits depuis la base de données
$stmt = $conn->query("SELECT product_id, product_name, description, product_price FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos produits</title>
    <style>
        /* Style des cartes produits */
        .product-container {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            justify-content: space-around;
        }
        .product-card {
            border: 1px solid #ddd;
            padding: 16px;
            width: 300px;
            box-shadow: 0px 2px 5px rgba(0,0,0,0.1);
            text-align: center;
        }
        .product-card h3 {
            margin: 0;
            font-size: 1.5em;
        }
        .product-card p {
            margin: 10px 0;
        }
        .product-card button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        .product-card button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<h1>Nos Produits</h1>

<div class="product-container">
    <?php foreach ($products as $product): ?>
        <div class="product-card">
            <h3><?= htmlspecialchars($product['product_name']); ?></h3>
            <p><?= htmlspecialchars($product['description']); ?></p>
            <p><strong><?= number_format($product['product_price'], 2); ?> €</strong></p>

            <?php if ($isConnected): ?>
                <!-- Formulaire pour ajouter le produit au panier -->
                <form action="cart.php" method="POST">
                    <input type="hidden" name="product_id" value="<?= $product['product_id']; ?>">
                    <button type="submit" name="add_to_cart">Ajouter au panier</button>
                </form>
            <?php else: ?>
                <!-- Si l'utilisateur n'est pas connecté, on redirige vers la page de connexion -->
                <p><a href="login.php">Connectez-vous pour ajouter au panier</a></p>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>
