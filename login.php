<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Asynchrone</title>

    <script src="./assets/js/auth.js"></script>
</head>
<body>

    <h1>Connexion</h1>

    <form id="login-form" onsubmit="handleLogin(event)">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <input type="submit" value="Se connecter">
    </form>

    <p id="error-message" style="color: red;"></p>

</body>
</html>
