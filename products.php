<?php 
include('./includes/db.php');
?>

<?php 
    include('./includes/head.php'); 
    include('./includes/header.php'); 
?>

<?php
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

// Vérification s'il y a des résultats
if ($result->num_rows > 0) {
    echo "<div class='card-container'>";
    // Boucle pour afficher chaque produit
    while($row = $result->fetch_assoc()) {
        echo "<div class='card'>";
        echo "<a href='view_product.php?id=" . $row["id"] . "'><img src='" . $row["image_url"] . "' alt='" . $row["name"] . "' class='card-image-book'></a>";
        echo "<h2>" . $row["name"] . "</h2>";
        echo "<p class='price'>" . $row["price"] . "€</p>";
        echo "<a href='#' class='buy-button'>Buy</a>";
        echo "</div>";
    }
    echo "</div>";
} else {
    echo "Aucun produit trouvé.";
}
include('./includes/footer.php');
?>

