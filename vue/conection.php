<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="conection.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
        
<?php
    // include '../back/connection.php';
    include 'navbar.php';
?>
        <!-- Formulaire de connexion -->
        <form action="conection.php" method="POST">
            <h1>Connexion</h1>
            
            <label for="username"><b>Nom d'utilisateur</b></label>
            <input type="text" id="username" name="username" placeholder="Entrer votre nom d'utilisateur" required>
            
            <label for="password"><b>Mot de passe</b></label>
            <input type="password" id="password" name="password" placeholder="Entrer votre mot de passe" required>
            
            <input type="submit" id="submit" value="LOGIN">
            <p class="signup-link">Pas encore inscrit ? <a href="inscription.php">Créez un compte ici</a>.</p>

           
        </form>
         <form action="../back/mdp_oublie.php" method="post">
            <input type="submit" value="mot de passe oublié">
            </form>
</body>
</html>