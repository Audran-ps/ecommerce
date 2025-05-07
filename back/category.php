<?php
$host = 'localhost';        // Adresse du serveur MySQL
$dbname = 'ecommerce'; // Nom de ta base de données
$user = 'root';      // Ton identifiant MySQL
$password = ''; // Ton mot de passe MySQL

try {
    // Connexion à la base de données avec PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);

    echo "✅ Connexion réussie à la base de données.";
} catch (PDOException $e) {
    // En cas d’erreur, afficher le message
    echo "❌ Erreur de connexion : " . $e->getMessage();
}

include 'connection.php';

$sql = "SELECT * FROM category";
$stmt = $pdo->query($sql);
$cateogie_recuperer = $stmt->fetchAll(PDO::FETCH_ASSOC);
