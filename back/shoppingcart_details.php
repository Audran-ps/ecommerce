<?php
// Connexion DB (déjà existante)
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

// Vérification et sécurisation du paramètre ID
if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
    header("HTTP/1.0 404 Not Found");
    die("<div class='alert alert-danger'>Produit non spécifié ou ID invalide.</div>");
}

$productId = (int)$_GET['id'];

// Requête sécurisée avec jointure pour la catégorie
try {
    $stmt = $conn->prepare("
        SELECT p.*, c.nom_category 
        FROM product p
        LEFT JOIN category_product c ON p.category_id = c.category_id
        WHERE p.product_id = ?
    ");
    $stmt->execute([$productId]);
    $product = $stmt->fetch();

    if (!$product) {
        header("HTTP/1.0 404 Not Found");
        die("<div class='alert alert-warning'>Ce produit n'existe pas.</div>");
    }
} catch (PDOException $e) {
    die("Erreur de base de données : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($product['name']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <!-- Affichage du produit principal -->
    <div class="row">
        <div class="col-md-6">
            <img src="<?= htmlspecialchars($product['image_url']) ?>"
                 class="img-fluid rounded"
                 alt="<?= htmlspecialchars($product['name']) ?>">
        </div>
        <div class="col-md-6">
            <h1><?= htmlspecialchars($product['name']) ?></h1>
            <p class="text-muted">Catégorie : <?= htmlspecialchars($product['nom_category']) ?></p>
            <h3 class="text-danger"><?= number_format($product['price'], 2) ?> €</h3>
            <p><?= nl2br(htmlspecialchars($product['description'])) ?></p>
            <button class="btn btn-primary btn-lg">Ajouter au panier</button>
        </div>
    </div>

    <!-- Section Produits similaires -->
    <?php
    $similarStmt = $conn->prepare("
        SELECT * FROM product 
        WHERE category_id = ? 
        AND product_id != ?
        LIMIT 4
    ");
    $similarStmt->execute([$product['category_id'], $productId]);
    $similarProducts = $similarStmt->fetchAll();

    if (count($similarProducts) > 0):
    ?>
        <hr class="my-5">
        <h3 class="mb-4">Produits similaires</h3>
        <div class="row">
            <?php foreach ($similarProducts as $similar): ?>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="product_detail.php?id=<?= $similar['product_id'] ?>">
                            <img src="<?= htmlspecialchars($similar['image_url']) ?>"
                                 class="card-img-top"
                                 style="height: 180px; object-fit: contain;"
                                 alt="<?= htmlspecialchars($similar['name']) ?>">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($similar['name']) ?></h5>
                            <p class="text-danger fw-bold"><?= number_format($similar['price'], 2) ?> €</p>
                            <a href="product_detail.php?id=<?= $similar['product_id'] ?>"
                               class="btn btn-sm btn-outline-primary">
                                Voir détails
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
