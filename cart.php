<!DOCTYPE html>
<html lang="fr">

<?php 
include('./includes/head.php'); 
include('./includes/header.php'); 
include('./includes/db.php'); // Inclure la connexion à la base de données

// Récupérer les articles du panier pour l'utilisateur connecté
$userId = $_SESSION['user_id']; // Assurez-vous que l'utilisateur est connecté et que l'ID est en session
$query = "SELECT p.image, p.name, p.price, c.quantity 
          FROM cart c 
          JOIN products p ON c.product_id = p.id 
          WHERE c.user_id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$userId]);
$cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="cart-container">
    <div class="cart-items">
        <?php if (!empty($cartItems)) : ?>
            <?php foreach ($cartItems as $item) : ?>
                <div class="cart-item">
                    <img src="<?= htmlspecialchars($item['image']); ?>" alt="Image du produit" class="product-image">
                    <div class="product-details">
                        <p class="product-name"><?= htmlspecialchars($item['name']); ?></p>
                        <span class="product-status"><?= $item['quantity'] > 0 ? 'En stock' : 'Épuisé'; ?></span>
                        <div class="quantity-selector">
                            <select name="quantity">
                                <?php for ($i = 1; $i <= 10; $i++) : ?>
                                    <option value="<?= $i; ?>" <?= $i == $item['quantity'] ? 'selected' : ''; ?>><?= $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <button class="delete-button">Supprimer</button>
                        <span class="product-price"><?= number_format($item['price'], 2, ',', ''); ?>€</span>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>Votre panier est vide.</p>
        <?php endif; ?>
    </div>

    <div class="cart-summary">
        <?php 
        // Calcul du total HT, TVA et total TTC
        $totalHT = array_sum(array_map(function($item) {
            return $item['price'] * $item['quantity'];
        }, $cartItems));
        $tva = $totalHT * 0.2; // Par exemple, TVA de 20%
        $totalTTC = $totalHT + $tva;
        ?>

        <h2>Prix HT: <span class="price-ht"><?= number_format($totalHT, 2, ',', ''); ?>€</span></h2>
        <h2>TVA: <span class="tva">20%</span></h2>
        <h2>RÉCAPITULATIF: <span class="total-price"><?= number_format($totalTTC, 2, ',', ''); ?>€</span></h2>
        <p class="login-prompt">Vous avez besoin d'un compte pour procéder au paiement.</p>
        <button class="login-button">S'inscrire ou se connecter</button>
    </div>
</div>

<?php include('./includes/footer.php'); ?>

</html>
