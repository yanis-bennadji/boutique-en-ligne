<?php
// voir_produit.php

// Connexion à la base de données (à adapter selon votre configuration)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "boutique-en-ligne";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Récupération de l'ID du produit depuis l'URL
$id_produit = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id_produit > 0) {
    // Requête pour obtenir les détails du produit
    $sql = "SELECT * FROM produits WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_produit);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $produit = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($produit['nom']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/style.css">
    
</head>
<body>
    <div class="produit-details">
        <h1><?php echo htmlspecialchars($produit['nom']); ?></h1>
        
        <div class="produit-image">
            <img src="<?php echo htmlspecialchars($produit['image_url']); ?>" alt="<?php echo htmlspecialchars($produit['nom']); ?>">
        </div>
        
        <div class="produit-info">
            <p class="prix"><?php echo number_format($produit['prix'], 2, ',', ' '); ?> €</p>
            <p class="description"><?php echo nl2br(htmlspecialchars($produit['description'])); ?></p>
            
            <form action="ajouter_au_panier.php" method="post">
                <input type="hidden" name="id_produit" value="<?php echo $produit['id']; ?>">
                <input type="number" name="quantite" value="1" min="1">
                <button type="submit">Ajouter au panier</button>
            </form>
        </div>
        
        <div class="details-supplementaires">
            <h2>Caractéristiques</h2>
            <ul>
                <?php
                // Supposons que vous ayez un champ 'description' dans votre base de données
                $description = explode("\n", $produit['description']);
                foreach ($description as $descriptions) {
                    echo "<li>" . htmlspecialchars($descriptions) . "</li>";
                }
                ?>
            </ul>
        </div>
    </div>
</body>
</html>
<?php
    } else {
        echo "Produit non trouvé.";
    }
    $stmt->close();
} else {
    echo "ID de produit non valide.";
}

$conn->close();
?>