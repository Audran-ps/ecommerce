<?php
session_start(); // Toujours en tout premier

include 'navbar.php';

// Régénérer le CAPTCHA si demandé
if (isset($_GET['refresh_captcha'])) {
    unset($_SESSION['captcha_code']);
}

// Générer un nouveau CAPTCHA si nécessaire
if (!isset($_SESSION['captcha_code'])) {
    $_SESSION['captcha_code'] = rand(1000, 9999);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'Inscription</title>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;200;400;500&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #0f0f0f;
            font-family: 'Raleway', sans-serif;
            color: white;
        }

        .signup-container {
            max-width: 400px;
            margin: 100px auto;
            background-color: #1c1c1c;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px #00e6e6;
            text-align: center;
        }

        .signup-container h2 {
            color: #00e6e6;
            font-size: 32px;
            margin-bottom: 20px;
        }

        .signup-container label {
            display: block;
            margin-top: 15px;
            text-align: left;
            font-weight: bold;
        }

        .signup-container input[type="text"],
        .signup-container input[type="email"],
        .signup-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            background-color: #e6f0ff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
        }

        .signup-container input[type="submit"] {
            width: 100%;
            margin-top: 20px;
            background-color: #00e6e6;
            color: black;
            font-weight: bold;
            border: none;
            padding: 10px;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .signup-container input[type="submit"]:hover {
            background-color: #00cccc;
        }

        .login-link {
            margin-top: 15px;
            font-size: 14px;
        }

        .login-link a {
            color: #00e6e6;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        /* CAPTCHA */
        .captcha-container {
            margin-top: 20px;
            text-align: left;
        }

        .captcha-box {
            display: inline-block;
            background-color: white;
            color: black;
            padding: 5px 10px;
            font-weight: bold;
            font-size: 18px;
            border-radius: 5px;
            margin-top: 5px;
        }

        .refresh-btn {
            margin-left: 10px;
            background: none;
            border: none;
            color: #00e6e6;
            cursor: pointer;
            font-size: 16px;
        }

        .refresh-btn:hover {
            color: #00cccc;
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

            <!-- Section CAPTCHA -->
            <div class="captcha-container">
                <label for="captcha">Code de vérification :</label><br>
                <div>
                    <span class="captcha-box"><?php echo $_SESSION['captcha_code']; ?></span>
                    <button type="button" class="refresh-btn" onclick="refreshCaptcha()">🔄 Regénérer</button>
                </div>
                <input type="text" name="captcha" id="captcha" placeholder="Entrez le code ci-dessus" required>
            </div>

            <input type="submit" value="S'inscrire">
            
            <p class="login-link">Déjà inscrit ? <a href="conection.php">Connectez-vous ici</a>.</p>
        </form>
    </div>

    <script>
        function refreshCaptcha() {
            window.location.href = window.location.pathname + '?refresh_captcha=true';
        }
    </script>
</body>
</html>
