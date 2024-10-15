<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>

    <h1>S'inscrire</h1>
    
    <form action="process_signup.php" method="post">
        <label for="first_name">Prénom:</label>
        <input type="text" id="first_name" name="first_name" required><br><br>
        
        <label for="last_name">Nom:</label>
        <input type="text" id="last_name" name="last_name" required><br><br>
        
        <label for="address">Adresse:</label>
        <input type="text" id="address" name="address" required><br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <input type="submit" value="S'inscrire">
    </form>

</body>
</html>
