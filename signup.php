<!-- fill -->
<?php 
// auth.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];     

    // This is where you'd handle signup/signin logic:
    // E.g., check if the user exists, create a new account, validate credentials, etc.

    if (isset($_POST['signup'])) {
        // Handle Sign Up logic
        echo "Sign Up logic for user: $email, $nom, $prenom";
        // Save the user data into a database here
    } elseif (isset($_POST['signin'])) {
        // Handle Sign In logic
        echo "Sign In logic for user: $email";
        // Authenticate user credentials here
    }
}  
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="./style.css?t=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/1c55cc9337.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="form-box">
            <h1 id="title">INSCRIPTION</h1>
            <form action="auth.php" method="POST">
                <div class="input-group">
                    <div class="input-field">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email" name="email" id="email" placeholder="EMAIL" required />
                    </div>
                    <div class="input-field">
                        <i class="fa-solid fa-key"></i>
                        <input type="password" name="password" id="password" placeholder="MOT DE PASSE" required />
                    </div>
                    <div class="input-field" id="firstnameField">
                        <i class="fa-regular fa-user"></i>
                        <input type="text" name="nom" id="nom" placeholder="NOM" required />
                    </div>
                    <div class="input-field" id="lastnameField">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" name="prenom" id="prenom" placeholder="PRÉNOM" required />
                    </div>
                </div>

                <div class="btn-field">
                    <button type="submit" name="signup" id="signupBtn">Créer un compte</button>
                </div>
            </form>
        </div>
    </div>

    <script type="text/javascript" src="script.js"></script>
</body>

</html>