<?php
$host = 'localhost';        // Adresse du serveur MySQL
$dbname = 'ecommerce'; // Nom de ta base de données
$user = 'root';      // Ton identifiant MySQL
$password = ''; // Ton mot de passe MySQL

try {
    // Connexion à la base de données avec PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);

    
} catch (PDOException $e) {
    // En cas d’erreur, afficher le message
    echo "❌ Erreur de connexion : " . $e->getMessage();
}



// Récupération des données du formulaire
$name = $_POST['username'] ?? '';
$username= $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$password= $_POST['password'] ?? '';
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Requête d'insertion sécurisée
        $sql = "INSERT INTO users (name, username, email, password ) VALUES (:nom, :prenom, :email, :hashedPassword)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nom' => $name,
            ':prenom' => $username,
            ':email' => $email,
            ':hashedPassword' => $hashedPassword,
        ]);
        echo "✅ Données enregistrées avec succès !";
    }

    catch (PDOException $e) {
        echo "❌ Erreur lors de l'enregistrement : " . $e->getMessage();
    }
    // Vérification des champs obligatoires
if (isset($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['password'], $_POST['confirmPassword'], $_POST['captcha'])) {

    $firstname = htmlspecialchars(trim($_POST['firstname']));
    $lastname = htmlspecialchars(trim($_POST['lastname']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirmPassword']);
    $captchaInput = trim($_POST['captcha']);

    // Vérification du captcha
    if ($captchaInput !== $_SESSION['captcha']) {
        $_SESSION['register_error'] = "Captcha incorrect. Veuillez réessayer.";
        header('Location: ../vue/inscription.php');
        exit();
    }
}