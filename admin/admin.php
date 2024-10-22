<?php
// Inclure la connexion à la base de données
include '../includes/db.php'; // Assurez-vous que 'db.php' configure correctement la connexion PDO

// Gestion de l'ajout d'une nouvelle catégorie
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_category'])) {
    $category_name = $_POST['category_name'];

    // Préparation de la requête pour ajouter une nouvelle catégorie
    $stmt = $conn->prepare("INSERT INTO categories (name) VALUES (:name)");
    $stmt->bindValue(':name', $category_name);

    if ($stmt->execute()) {
        echo "Category added successfully!";
    } else {
        echo "Error adding category: " . print_r($stmt->errorInfo(), true);
    }
}

// Gestion de la modification d'une catégorie
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_category'])) {
    $category_id = $_POST['category_id'];
    $category_name = $_POST['category_name'];

    // Préparation de la requête pour modifier une catégorie
    $stmt = $conn->prepare("UPDATE categories SET name = :name WHERE id = :id");
    $stmt->bindValue(':name', $category_name);
    $stmt->bindValue(':id', $category_id);

    if ($stmt->execute()) {
        echo "Category updated successfully!";
    } else {
        echo "Error updating category: " . print_r($stmt->errorInfo(), true);
    }
}

// Gestion de la suppression d'une catégorie
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_category'])) {
    $category_id = $_POST['category_id'];

    // Préparation de la requête pour supprimer une catégorie
    $stmt = $conn->prepare("DELETE FROM categories WHERE id = :id");
    $stmt->bindValue(':id', $category_id);

    if ($stmt->execute()) {
        echo "Category deleted successfully!";
    } else {
        echo "Error deleting category: " . print_r($stmt->errorInfo(), true);
    }
}

// Gestion de la suppression d'un produit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_product'])) {
    $product_id = $_POST['product_id'];

    // Préparation de la requête pour supprimer un produit
    $stmt = $conn->prepare("DELETE FROM products WHERE id = :id");
    $stmt->bindValue(':id', $product_id);

    if ($stmt->execute()) {
        echo "Product deleted successfully!";
        header("Location: " . $_SERVER['PHP_SELF']); // Redirection après suppression
        exit();
    } else {
        echo "Error deleting product: " . print_r($stmt->errorInfo(), true);
    }
}

// Gestion de la modification d'un produit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_product'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];

    // Préparation de la requête pour modifier un produit
    $stmt = $conn->prepare("UPDATE products SET name = :name, description = :description, price = :price, category_id = :category_id WHERE id = :id");
    $stmt->bindValue(':name', $product_name);
    $stmt->bindValue(':description', $description);
    $stmt->bindValue(':price', $price);
    $stmt->bindValue(':category_id', $category_id);
    $stmt->bindValue(':id', $product_id);

    if ($stmt->execute()) {
        echo "Product updated successfully!";
        header("Location: " . $_SERVER['PHP_SELF']); // Redirection après modification
        exit();
    } else {
        echo "Error updating product: " . print_r($stmt->errorInfo(), true);
    }
}

// Requête pour récupérer les catégories existantes
$categories = $conn->query("SELECT id, name FROM categories");
if ($categories === false) {
    die('Query failed: ' . print_r($conn->errorInfo(), true));
}

// Requête pour récupérer les produits existants avec les catégories associées
$products = $conn->query("
    SELECT products.id, products.name, products.description, products.price, categories.name AS category_name 
    FROM products 
    JOIN categories ON products.category_id = categories.id
");
if ($products === false) {
    die('Query failed: ' . print_r($conn->errorInfo(), true));
}

// Gestion de l'ajout d'un nouveau produit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];

    // Préparation de la requête pour ajouter un produit
    $stmt = $conn->prepare("INSERT INTO products (name, description, price, category_id) VALUES (:name, :description, :price, :category_id)");
    $stmt->bindValue(':name', $product_name);
    $stmt->bindValue(':description', $description);
    $stmt->bindValue(':price', $price);
    $stmt->bindValue(':category_id', $category_id);

    if ($stmt->execute()) {
        echo "Product added successfully!";
        header("Location: " . $_SERVER['PHP_SELF']); // Redirection après l'ajout d'un produit
        exit();
    } else {
        echo "Error adding product: " . print_r($stmt->errorInfo(), true);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Gestion des produits et catégories</title>
    <script>
        // Fonction pour afficher le formulaire de modification et pré-remplir les champs avec les informations du produit
        function openEditForm(productId, productName, description, price, categoryId) {
            document.getElementById('edit_product_id').value = productId;
            document.getElementById('edit_product_name').value = productName;
            document.getElementById('edit_description').value = description;
            document.getElementById('edit_price').value = price;
            document.getElementById('edit_category_id').value = categoryId;

            // Afficher le formulaire de modification
            document.getElementById('editForm').style.display = 'block';
        }
    </script>
</head>
<body>

    <!-- Formulaire pour ajouter une catégorie -->
    <h2>Ajouter une catégorie</h2>
    <form method="POST" action="">
        <label for="category_name">Nom de la catégorie :</label>
        <input type="text" id="category_name" name="category_name" required>
        <button type="submit" name="add_category">Ajouter la catégorie</button>
    </form>

    <!-- Formulaire pour modifier une catégorie -->
    <h2>Modifier une catégorie</h2>
    <form method="POST" action="">
        <label for="category_id">Catégorie :</label>
        <select id="category_id" name="category_id" required>
            <?php while ($row = $categories->fetch(PDO::FETCH_ASSOC)): ?>
                <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
            <?php endwhile; ?>
        </select>
        <label for="category_name">Nouveau nom de la catégorie :</label>
        <input type="text" id="category_name" name="category_name" required>
        <button type="submit" name="edit_category">Modifier la catégorie</button>
    </form>

    <!-- Formulaire pour supprimer une catégorie -->
    <h2>Supprimer une catégorie</h2>
    <form method="POST" action="">
        <label for="category_id">Catégorie :</label>
        <select id="category_id" name="category_id" required>
            <?php foreach ($conn->query("SELECT id, name FROM categories") as $row): ?>
                <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit" name="delete_category">Supprimer la catégorie</button>
    </form>

    <hr>

    <!-- Formulaire pour ajouter un produit -->
    <h2>Ajouter un nouveau produit</h2>
    <form method="POST" action="">
        <label for="product_name">Nom du produit :</label>
        <input type="text" id="product_name" name="product_name" required><br><br>

        <label for="description">Description :</label>
        <textarea id="description" name="description" required></textarea><br><br>

        <label for="price">Prix :</label>
        <input type="number" step="0.01" id="price" name="price" required><br><br>

        <label for="category_id">Catégorie :</label>
        <select id="category_id" name="category_id" required>
            <?php foreach ($conn->query("SELECT id, name FROM categories") as $row): ?>
                <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <button type="submit" name="add_product">Ajouter le produit</button>
    </form>

    <hr>

    <!-- Liste des produits -->
    <h2>Liste des produits</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Catégorie</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($product = $products->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?= htmlspecialchars($product['name'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($product['description'] ?? 'N/A') ?></td>
                    <td><?= number_format($product['price'] ?? 0, 2) ?> €</td>
                    <td><?= htmlspecialchars($product['category_name'] ?? 'Sans catégorie') ?></td>
                    <td>
                        <!-- Bouton pour ouvrir le formulaire de modification -->
                        <button type="button" 
                            onclick="openEditForm(
                                '<?= htmlspecialchars($product['id'] ?? '', ENT_QUOTES) ?>', 
                                '<?= htmlspecialchars($product['name'] ?? '', ENT_QUOTES) ?>', 
                                '<?= htmlspecialchars($product['description'] ?? '', ENT_QUOTES) ?>', 
                                '<?= htmlspecialchars($product['price'] ?? '', ENT_QUOTES) ?>', 
                                '<?= htmlspecialchars($product['category_id'] ?? '', ENT_QUOTES) ?>'
                            )">
                            Modifier
                        </button>

                        <!-- Formulaire pour supprimer le produit -->
                        <form method="POST" action="" style="display:inline;">
                            <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['id'] ?? '') ?>">
                            <button type="submit" name="delete_product" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>


    <!-- Formulaire pour modifier un produit (caché par défaut) -->
    <div id="editForm" style="display:none;">
        <h2>Modifier le produit</h2>
        <form method="POST" action="">
            <input type="hidden" id="edit_product_id" name="product_id">
            
            <label for="edit_product_name">Nom du produit :</label>
            <input type="text" id="edit_product_name" name="product_name" required><br><br>

            <label for="edit_description">Description :</label>
            <textarea id="edit_description" name="description" required></textarea><br><br>

            <label for="edit_price">Prix :</label>
            <input type="number" step="0.01" id="edit_price" name="price" required><br><br>

            <label for="edit_category_id">Catégorie :</label>
            <select id="edit_category_id" name="category_id" required>
                <?php foreach ($conn->query("SELECT id, name FROM categories") as $row): ?>
                    <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                <?php endforeach; ?>
            </select><br><br>

            <button type="submit" name="edit_product">Mettre à jour</button>
        </form>
    </div>

</body>
</html>
