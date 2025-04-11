<?php
// Connexion
try {
    $conn = new PDO("mysql:host=localhost;dbname=e_commerce", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prenom = htmlspecialchars($_POST['firstname'] ?? '');
    $nom = htmlspecialchars($_POST['lastname'] ?? '');
    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $mdp = $_POST['password'] ?? '';
    $confirm = $_POST['confirmPassword'] ?? '';
    $birthdate = $_POST['birthdate'] ?? '';

    if ($mdp !== $confirm) {
        die("Les mots de passe ne correspondent pas.");
    }

    $hashedPassword = password_hash($mdp, PASSWORD_DEFAULT);
    $username = $prenom . ' ' . $nom;

    try {
        $sql = $conn->prepare("INSERT INTO users (username, password, email, statue) VALUES (?, ?, ?, 'en ligne')");
        $sql->execute([$username, $hashedPassword, $email]);

        if ($sql->rowCount()) {
            // Redirection affirmée  vers la page de connexion
            header("Location: ../vue/login.html");
            exit();
        } else {
            echo "Erreur lors de l'inscription.";
        }
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
}
$hashedPassword = password_hash($mdp, PASSWORD_DEFAULT);
    $username = $prenom . ' ' . $nom;

    try {
        $sql = $conn->prepare("INSERT INTO users (username, password, email, statue) VALUES (?, ?, ?, 'en ligne')");
        $sql->execute([$username, $hashedPassword, $email]);