<?php

// Connexion à la base de données
try {
    $conn = new PDO("mysql:host=localhost;dbname=ecommerce;charset=utf8", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("❌ Erreur de connexion : " . $e->getMessage());
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sécurisation des données
    $prenom = htmlspecialchars($_POST['firstname'] ?? '');
    $nom = htmlspecialchars($_POST['lastname'] ?? '');
    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $mdp = $_POST['password'] ?? '';
    $confirm = $_POST['confirmPassword'] ?? '';
    $birthdate = $_POST['birthdate'] ?? ''; // Ce champ n’est pas encore utilisé dans la requête

    // Vérification des champs obligatoires
    if (empty($prenom) || empty($nom) || empty($email) || empty($mdp) || empty($confirm)) {
        die("⚠️ Tous les champs sont obligatoires.");
    }

    // Vérification du mot de passe
    if ($mdp !== $confirm) {
        die("❌ Les mots de passe ne correspondent pas.");
    }

    // Hachage du mot de passe
    $hashedPassword = password_hash($mdp, PASSWORD_DEFAULT);
    $username = $prenom . ' ' . $nom;

    // Insertion en base de données
    try {
        $sql = $conn->prepare("INSERT INTO users (username, password, email, statue) VALUES (?, ?, ?, 'en ligne')");
        $sql->execute([$username, $hashedPassword, $email]);
            header("Location: ../vue/login.html");

        } else {
            echo "Une erreur est survenue lors de l'inscription.";
        }
    } catch (PDOException $e) {
        die("Erreur lors de l'enregistrement : " . $e->getMessage());
    }

?>
