<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notre Sélection</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <header>
        <img src="logo.png" alt="Logo" class="logo">
        <nav>
            <ul>
                <li><a href="#">Accueil</a></li>
                <li><a href="#">Produits</a></li>
                <li><a href="#">Signup</a></li>
                <li><a href="#">Login</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
        <input type="text" placeholder="Hinted search text" class="search-bar">
        <div class="cart-icon">
            <img src="cart-icon.png" alt="Cart">
        </div>
    </header>

    <main>
        <h1>Notre sélection</h1>
        <div class="card-container">
            <div class="card">
            <a href="view_product.php"><img src="./assets/img/mangakaiju.jpg" alt="Manga Kaiju n°8" class="card-image-book"></a>
            <h2>Kaiju n°8 tome 1</h2>
                <p class="price">14.99€</p>
                <a href="#" class="buy-button">Buy</a>
            </div>

            <div class="card">
            <a href="view_product.php"><img src="./assets/img/dvdbluegiant.png" alt="DVD de Blue Giant" class="card-image-dvd"></a>
            <h2>DVD Blue Giant</h2>
                <p class="price">14.99€</p>
                <a href="#" class="buy-button">Buy</a>
            </div>

            <div class="card">
                <a href="view_product.php"><img src="./assets/img/figurinenaruto.png" alt="Figurine de Naruto" class="card-image-figure"></a>
                <h2>TITRE ARTICLE 3</h2>
                <p class="price">14.99€</p>
                <a href="#" class="buy-button">Buy</a>
            </div>
        </div>

        <a href="products.php" class="more-articles">Voir plus d'articles</a>
    </main>

</body>
</html>
