<?php
session_start(); // Démarrer la session

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: login.php");
    exit();
}

// Récupérer l'ID de l'utilisateur connecté depuis la session
$user_id = $_SESSION['user_id'];

// Inclure les fonctions nécessaires
include 'includes/functions.php';

// Récupérer les données actuelles de l'utilisateur
$user = getUserData($user_id);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Si le formulaire est soumis, mettre à jour les données utilisateur
    $first_name = htmlspecialchars($_POST['first_name'], ENT_QUOTES);
    $last_name = htmlspecialchars($_POST['last_name'], ENT_QUOTES);
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES);
    $address = htmlspecialchars($_POST['address'], ENT_QUOTES);
    $phone = htmlspecialchars($_POST['phone'], ENT_QUOTES);

    // Appel de la fonction pour mettre à jour les données utilisateur
    updateUser($user_id, $first_name, $last_name, $email, $address, $phone);

    // Redirection après la mise à jour
    header("Location: dashboard.php?update=success");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Modifier les données utilisateur</title>
</head>
<body>

    <h1>Modifier vos informations</h1>

    <?php if (isset($_GET['update']) && $_GET['update'] == 'success'): ?>
        <p style="color: green;">Vos informations ont été mises à jour avec succès !</p>
    <?php endif; ?>

    <form action="dashboard.php" method="POST">
        <label for="first_name">Prénom :</label>
        <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($user['first_name'], ENT_QUOTES); ?>" required><br><br>

        <label for="last_name">Nom :</label>
        <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($user['last_name'], ENT_QUOTES); ?>" required><br><br>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email'], ENT_QUOTES); ?>" required><br><br>

        <label for="address">Adresse :</label>
        <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($user['address'], ENT_QUOTES); ?>" required><br><br>

        <label for="phone">Téléphone :</label>
        <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone'], ENT_QUOTES); ?>"><br><br>

        <input type="submit" value="Mettre à jour">
    </form>

</body>
</html>
