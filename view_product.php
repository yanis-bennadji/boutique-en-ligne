<?php
// Connexion à la base de données
include('config/db.php');

// Vérifier si un ID de produit est passé dans l'URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Requête pour obtenir les informations du produit
    $query = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if (!$product) {
        echo "Produit non trouvé!";
        exit;
    }
} else {
    echo "Aucun produit sélectionné!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

    <?php 
        // Include du fichier head pour la section meta et les liens CSS
        include('./includes/head.php'); 
    ?>

<body>

    <?php 
        // Include du header (Navbar)
        include('./includes/header.php'); 
    ?>

    <!-- Main Product Section -->
    <main>
        <section class="product-section">
            <div class="product-info">
                <h1>Nom du Produit</h1>
                <img src="placeholder.png" alt="Image du produit" class="product-image">
                <p><strong>Éditeur :</strong> <span>Nom de l'éditeur</span></p>
                <p><strong>Catégorie :</strong> <span>Nom de la catégorie</span></p>
                <p><strong>Date de parution :</strong> <span>Date</span></p>
                <p><strong>Résumé :</strong> <span>Description du produit ici</span></p>
                <button class="buy-button">Ajouter au panier</button>
                <input type="number" value="1" min="1" class="product-quantity">
            </div>
        </section>

        <!-- Section des suggestions de produits -->
        <section class="suggested-products">
            <h2>Les clients ont aussi apprécié ...</h2>
            <div class="card-container">
                <div class="card">
                    <h3>Titre Article</h3>
                    <img src="article1.png" alt="Article 1" class="card-image">
                    <button class="buy-button">Buy</button>
                </div>
                <div class="card">
                    <h3>Titre Article</h3>
                    <img src="article2.png" alt="Article 2" class="card-image">
                    <button class="buy-button">Buy</button>
                </div>
                <div class="card">
                    <h3>Titre Article</h3>
                    <img src="article3.png" alt="Article 3" class="card-image">
                    <button class="buy-button">Buy</button>
                </div>
            </div>
        </section>
    </main>

    <?php 
        // Include du footer
        include('./includes/footer.php'); 
    ?>

</body>
</html>
