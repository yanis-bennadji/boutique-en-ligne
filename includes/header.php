<?php
session_start(); // Démarre la session pour vérifier si l'utilisateur est connecté

// Par défaut, personne n'est connecté
$isConnected = false;
$isAdmin = false;

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['user_id'])) {
    $isConnected = true;

    // Récupérer le rôle de l'utilisateur (assumons que vous stockez l'ID de l'utilisateur dans $_SESSION['user_id'])
    include 'includes/db.php'; // Inclure la connexion à la base de données

    // Préparer une requête pour récupérer le rôle de l'utilisateur depuis la BDD
    $stmt = $conn->prepare("SELECT role FROM users WHERE id = :user_id");
    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $user['role'] === 'admin') {
        $isAdmin = true; // Si l'utilisateur est admin, changer l'état
    }
}
?>

<header>
    <nav>
        <ul>
            <!-- Lien toujours visible -->
            <li><a href=" index.php">Accueil</a></li>

            <?php if ($isConnected): ?>
                <!-- L'utilisateur est connecté -->
                <li><a href="logout.php">Se déconnecter</a></li>
                <li><a href="cart.php">Panier</a></li>
                <li><a href="products.php">Produits</a></li>
                <li><a href="dashboard.php">Profil</a></li>

                <!-- Afficher le lien Admin si l'utilisateur est admin -->
                <?php if ($isAdmin): ?>
                    <li><a href="./admin/admin.php">Admin Products</a></li>
                    <li><a href="./admin/admin2.php">Admin Users</a></li>
                <?php endif; ?>

            <?php else: ?>
                <!-- L'utilisateur n'est pas connecté -->
                <li><a href="signup.php">S'inscrire</a></li>
                <li><a href="login.php">Se connecter</a></li>
                <li><a href="products.php">Produits</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
