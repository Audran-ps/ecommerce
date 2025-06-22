<?php
$host = 'localhost';
$dbname = 'ecommerce';
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
} catch (PDOException $e) {
    echo "❌ Erreur de connexion : " . $e->getMessage();
    exit;
}

// Récupération des catégories
$sql = "SELECT * FROM category";
$stmt = $pdo->query($sql);
$categorie_recuperer = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Si une catégorie est sélectionnée, on récupère les produits associés
$produits = [];

if (isset($_GET['category'])) {
    $id_category = intval($_GET['category']);

    $stmt = $pdo->prepare("SELECT * FROM product WHERE id_category = :id_category");
    $stmt->bindParam(':id_category', $id_category, PDO::PARAM_INT);
    $stmt->execute();
    $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Ces variables seront disponibles dans la vue
return [
    'categories' => $categorie_recuperer,
    'produits' => $produits
];
