<?php
session_start();
include('./includes/head.php'); 
include('./includes/header.php'); 
include('./includes/db.php'); // Inclure la connexion à la base de données

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Initialiser le panier si ce n'est pas déjà fait
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Ajouter un produit au panier
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'] ?? 'Nom inconnu';
    $product_price = $_POST['product_price'] ?? 0;

    // Vérifier si le produit existe déjà dans le panier
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity']++;
    } else {
        $_SESSION['cart'][$product_id] = [
            'name' => $product_name,
            'price' => $product_price,
            'quantity' => 1
        ];
    }

    header("Location: cart.php");
    exit();
}

// Supprimer un produit du panier
if (isset($_GET['remove'])) {
    $product_id = $_GET['remove'];
    unset($_SESSION['cart'][$product_id]);
}

// Vider le panier
if (isset($_GET['clear'])) {
    unset($_SESSION['cart']);
}

// Calcul du total du panier
$total = array_reduce($_SESSION['cart'], function ($carry, $product) {
    return $carry + ($product['price'] * $product['quantity']);
}, 0);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon panier</title>
</head>
<body>
<div class="cart-container">
    <div class="cart-items">
        <?php if (!empty($_SESSION['cart'])): ?>
            <?php foreach ($_SESSION['cart'] as $product_id => $product): ?>
                <div class="cart-item">
                    <img src="path/to/product-image.jpg" alt="Image du produit" class="product-image">
                    <div class="product-details">
                        <p class="product-name"><?= htmlspecialchars($product['name'] ?? 'Nom inconnu'); ?></p>
                        <span class="product-status"><?= $product['quantity'] > 0 ? 'En stock' : 'Épuisé'; ?></span>
                        <div class="quantity-selector">
                            <select name="quantity">
                                <?php for ($i = 1; $i <= 10; $i++) : ?>
                                    <option value="<?= $i; ?>" <?= $i == $product['quantity'] ? 'selected' : ''; ?>><?= $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <span class="product-price"><?= number_format($product['price'], 2, ',', ''); ?>€</span>
                        <a href="cart.php?remove=<?= $product_id; ?>" class="delete-button">Supprimer</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Votre panier est vide.</p>
        <?php endif; ?>
    </div>

    <div class="cart-summary">
        <h2>Total du panier : <span class="total-price"><?= number_format($total, 2, ',', ''); ?>€</span></h2>
        <a href="cart.php?clear=true"><button class="clear-button">Vider le panier</button></a>
    </div>
</div>

<?php include('./includes/footer.php'); ?>

</body>
</html>
