async function handleLogin(event) {
    event.preventDefault(); // Empêche le rechargement de la page

    // Récupérer les données du formulaire
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    // Envoyer une requête POST asynchrone vers le script PHP
    try {
        const response = await fetch('process_login.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({
                'email': email,
                'password': password
            })
        });

        const result = await response.json(); // On attend le résultat en format JSON

        if (result.success) {
            // Rediriger vers index.php en cas de succès
            window.location.href = 'index.php';
        } else {
            // Afficher un message d'erreur
            document.getElementById('error-message').textContent = result.message;
        }
    } catch (error) {
        console.error('Erreur lors de la requête:', error);
    }
}z