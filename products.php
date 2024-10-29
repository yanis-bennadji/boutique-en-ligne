<?php

include './includes/header.php'; // Inclure le header dynamique
include 'includes/db.php'; // Inclure la connexion à la base de données

// Requête pour récupérer tous les produits depuis la base de données
$stmt = $conn->query("SELECT id, name, description, price FROM products");
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
            <h3><?= htmlspecialchars($product['name']); ?></h3>
            <p><?= htmlspecialchars($product['description']); ?></p>
            <p><strong><?= number_format($product['price'], 2); ?> €</strong></p>

            <!-- Formulaire pour ajouter le produit au panier -->
            <form action="cart.php" method="POST">
                <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                <input type="hidden" name="product_name" value="<?= htmlspecialchars($product['name']); ?>">
                <input type="hidden" name="product_price" value="<?= $product['price']; ?>">
                <button type="submit" name="add_to_cart">Ajouter au panier</button>
            </form>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>
