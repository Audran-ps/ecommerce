<?php
// Inclusion des données du panier et de la navigation
include 'shoppingcart_details.php';
include 'navbar.php';

// Connexion à la base de données
$server_name = "localhost";
$user = "root";
$password = "";
$db_name = "ecommerce";

try {
    $conn = new PDO("mysql:host=$server_name;dbname=$db_name", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Récupération des produits d'une catégorie spécifique (via GET ou fixe ici ?)
$categoryId = isset($_GET['cat']) && ctype_digit($_GET['cat']) ? (int)$_GET['cat'] : 0;

if ($categoryId === 0) {
    die("<div class='alert alert-danger text-center m-4'>Catégorie non spécifiée ou invalide.</div>");
}

try {
    $stmt = $conn->prepare("SELECT * FROM product WHERE category_id = ?");
    $stmt->execute([$categoryId]);
    $produits = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Erreur lors du chargement des produits : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Produits</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
  <h1 class="text-center mb-4">Produits de la Catégorie</h1>
  <div class="row g-4">
    <?php if (count($produits) > 0): ?>
      <?php foreach ($produits as $produit): ?>
        <div class="col-md-6 col-lg-4">
          <a href="product_detail.php?id=<?= $produit['product_id']; ?>" class="text-decoration-none text-dark">
            <div class="card shadow-sm h-100">
              <img src="<?= htmlspecialchars($produit['image_url']); ?>" class="card-img-top"
                   alt="<?= htmlspecialchars($produit['name']); ?>"
                   style="height: 300px; object-fit: cover;">
              <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($produit['name']); ?></h5>
                <p class="card-text"><?= htmlspecialchars($produit['description']); ?></p>
                <p class="card-text fw-bold"><?= number_format($produit['price'], 2); ?> €</p>
              </div>
            </div>
          </a>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="col-12">
        <div class="alert alert-warning text-center">Aucun produit trouvé dans cette catégorie.</div>
      </div>
    <?php endif; ?>
  </div>
</div>

</body>
</html>
