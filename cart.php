<?php
print_r($_POST);
include './includes/header.php';

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
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon panier</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        button {
            padding: 8px 16px;
            background-color: red;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<h1>Mon panier</h1>

<?php if (!empty($_SESSION['cart'])): ?>
    <table>
        <thead>
            <tr>
                <th>Produit</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($_SESSION['cart'] as $product_id => $product): ?>
                <tr>
                    <td><?= htmlspecialchars($product['name'] ?? 'Nom inconnu'); ?></td>
                    <td><?= number_format($product['price'] ?? 0, 2); ?> €</td>
                    <td><?= $product['quantity'] ?? 1; ?></td>
                    <td><?= number_format(($product['price'] ?? 0) * ($product['quantity'] ?? 1), 2); ?> €</td>
                    <td>
                        <a href="cart.php?remove=<?= $product_id; ?>"><button>Retirer</button></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <p><strong>Total du panier : 
        <?php
        $total = 0;
        foreach ($_SESSION['cart'] as $product) {
            $total += ($product['price'] ?? 0) * ($product['quantity'] ?? 1);
        }
        echo number_format($total, 2) . ' €';
        ?>
    </strong></p>

    <a href="cart.php?clear=true"><button>Vider le panier</button></a>
<?php else: ?>
    <p>Votre panier est vide.</p>
<?php endif; ?>

</body>
</html>
