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

include('connection.php');

// Ajout de produit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ajouter'])) {
    $nom = $_POST['nom'];
    $prix = $_POST['prix'];
    $image_url = $_POST['image_url'];
    $category_id = $_POST['category_id'];

    $stmt = $pdo->prepare("INSERT INTO products (nom, prix, image_url, category_id) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nom, $prix, $image_url, $category_id]);
    header("Location: product.php");
    exit;
}

// Suppression
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: product.php");
    exit;
}

// Récupération des catégories
$categories = $pdo->query("SELECT * FROM category")->fetchAll();
?>

</body>
</html>
