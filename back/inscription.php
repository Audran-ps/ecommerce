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
    }
//         echo "✅ Données enregistrées avec succès !";
    catch (PDOException $e) {
        echo "❌ Erreur lors de l'enregistrement : " . $e->getMessage();
    }


?>
