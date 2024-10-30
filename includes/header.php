<?php
session_start(); // Start the session to check if the user is logged in

// Default settings, no one is logged in
$isConnected = false;
$isAdmin = false;

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $isConnected = true;

    // Retrieve user role (assuming you store user ID in $_SESSION['user_id'])
    include 'includes/db.php'; // Include database connection

    // Prepare a query to fetch the user's role from the DB
    $stmt = $conn->prepare("SELECT role FROM users WHERE id = :user_id");
    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $user['role'] === 'admin') {
        $isAdmin = true; // If the user is admin, change the state
    }
}
?>

<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-orange">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand" href="#">
                <img src="./assets/img/mangatsuki.png" alt="Logo" class="logo">
            </a>

            <!-- Search Bar -->
            <form class="d-flex search-form">
                <input class="form-control me-2" type="search" placeholder="Hinted search text" aria-label="Search">
                <button type="submit" class="btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                        <path d="M21 21l-6 -6" />
                    </svg>
                </button>
            </form>

            <!-- Toggler button for mobile menu -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Collapsible menu for mobile -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- Link always visible -->
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Accueil</a>
                    </li>

                    <?php if ($isConnected): ?>
                        <!-- The user is connected -->
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Se déconnecter</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php">Panier</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="products.php">Produits</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php">Profil</a>
                        </li>

                        <!-- Show Admin link if the user is admin -->
                        <?php if ($isAdmin): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="./admin/admin.php">Admin Products</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./admin/admin2.php">Admin Users</a>
                            </li>
                        <?php endif; ?>

                    <?php else: ?>
                        <!-- The user is not connected -->
                        <li class="nav-item">
                            <a class="nav-link" href="signup.php">S'inscrire</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Se connecter</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="products.php">Produits</a>
                        </li>
                    <?php endif; ?>
                    
                    <!-- Contact link -->
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
