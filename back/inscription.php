<?php
session_start();

// Vérification CAPTCHA en premier
if (!isset($_POST['captcha']) || $_POST['captcha'] != $_SESSION['captcha_code']) {
    die('❌ Erreur : Le code CAPTCHA est incorrect.');
}

// Réinitialiser le CAPTCHA après vérification
unset($_SESSION['captcha_code']);

// Connexion DB et traitement du formulaire
$host = 'localhost';
$dbname = 'ecommerce';
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
} catch (PDOException $e) {
    die("❌ Erreur de connexion : " . $e->getMessage());
}

// Récupération et validation des données
$name = $_POST['username'] ?? '';
$username = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$confirm_password = $_POST['confirm-password'] ?? '';

// Vérification mot de passe
if ($password !== $confirm_password) {
    die('❌ Les mots de passe ne correspondent pas');
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

try {
    $sql = "INSERT INTO users (name, username, email, password) VALUES (:nom, :prenom, :email, :hashedPassword)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nom' => $name,
        ':prenom' => $username,
        ':email' => $email,
        ':hashedPassword' => $hashedPassword,
    ]);
    echo "✅ Inscription réussie !";
} catch (PDOException $e) {
    echo "❌ Erreur : " . $e->getMessage();
}