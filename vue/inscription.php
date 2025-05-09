<?php
include 'navbar.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'Inscription</title>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;200;400;500&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Raleway', sans-serif;
        }

        body {
            background-color: #111;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
            min-height: 100vh;
        }

        .signup-container {
            background-color: #222;
            padding: 30px;
            border-radius: 10px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 0 10px #29d9d5;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #29d9d5;
        }

        form label {
            display: block;
            margin: 15px 0 5px;
            font-weight: 500;
        }

        form input[type="text"],
        form input[type="email"],
        form input[type="password"] {
            width: 100%;
            padding: 10px;
            background-color: transparent;
            border: 1px solid #29d9d5;
            color: #fff;
            border-radius: 5px;
            font-size: 1rem;
        }

        form input[type="submit"] {
            margin-top: 25px;
            width: 100%;
            padding: 12px;
            background-color: #29d9d5;
            border: none;
            color: #111;
            font-weight: bold;
            font-size: 1rem;
            cursor: pointer;
            transition: 0.3s;
            border-radius: 5px;
        }

        form input[type="submit"]:hover {
            background-color: #1fb3b0;
        }

        ::placeholder {
            color: #ccc;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }

        .login-link a {
            color: #29d9d5;
            text-decoration: none;
            font-weight: bold;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="signup-container">
        <h2>Inscription</h2>
        <form action="../back/inscription.php" method="post">
            <label for="username">Nom :</label>
            <input type="text" id="username" name="username" placeholder="Votre nom" required>

            <label for="name">Prénom :</label>
            <input type="text" id="name" name="name" placeholder="Votre prénom" required>

            <label for="email">Email :</label>
            <input type="email" id="email" name="email" placeholder="Votre email" required>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" placeholder="Mot de passe" required>

            <label for="confirm-password">Confirmer le mot de passe :</label>
            <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirmer" required>

            <input type="submit" value="S'inscrire">

            <p class="login-link">Déjà inscrit ? <a href="conection.php">Connectez-vous ici</a>.</p>
        </form>
    </div>
</body>
</html>
