<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Boutique - Catégories</title>
    <link rel="stylesheet" href="category.css">
    <style>
        /* Styles améliorés */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        
        .banner {
            background-color: #222;
            color: white;
            text-align: center;
            padding: 100px 0;
            margin-bottom: 50px;
        }
        
        .banner h1 {
            color: #29d9d5;
            font-size: 3rem;
            margin: 0;
        }
        
        .categories-container {
            max-width: 1000px;
            margin: 0 auto 50px;
        }
        
        .categories-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
        }
        
        .category-btn {
            display: inline-block;
            border: 1px solid #29d9d5;
            padding: 10px 20px;
            color: #29d9d5;
            text-decoration: none;
            font-weight: bold;
            border-radius: 30px;
            box-shadow: 2px 2px 10px rgba(0, 255, 255, 0.2);
            transition: all 0.3s ease;
        }
        
        .category-btn:hover {
            background-color: #29d9d5;
            color: #fff;
        }
        
        .products-container {
            max-width: 1000px;
            margin: 0 auto;
            padding-bottom: 50px;
        }
        
        .products-title {
            text-align: center;
            color: #29d9d5;
            margin-bottom: 30px;
        }
        
        .products-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }
        
        .product-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding: 20px;
            width: 250px;
            text-align: center;
            transition: transform 0.3s ease;
        }
        
        .product-card:hover {
            transform: translateY(-5px);
        }
        
        .product-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 10px;
        }
        
        .product-name {
            color: #222;
            margin: 10px 0;
        }
        
        .product-description {
            color: #555;
            font-size: 0.9rem;
            min-height: 40px;
        }
        
        .product-price {
            font-weight: bold;
            color: #29d9d5;
            margin: 10px 0;
        }
        
        .product-stock {
            color: #666;
            font-size: 0.8rem;
        }
        
        .add-to-cart-btn {
            margin-top: 10px;
            background-color: #29d9d5;
            border: none;
            padding: 10px;
            color: black;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
        }
        
        .add-to-cart-btn:hover {
            background-color: #1fb3af;
        }
        
        .no-products {
            text-align: center;
            color: #888;
            padding: 50px 0;
        }
    </style>
</head>
<body>

<?php
    // Inclure les données et la navbar
    $data = include '../back/category.php';
    $categorie_recuperer = $data['categories'];
    $produits = $data['produits'];

    include 'navbar.php';
?>

<!-- Bannière -->
<div class="banner">
    <h1>Catégories</h1>
</div>

<!-- Boutons Catégories -->
<div class="categories-container">
    <div class="categories-list">
        <?php foreach ($categorie_recuperer as $categorie): ?>
            <div>
                <a href="?category=<?= urlencode($categorie['Id_category']) ?>" class="category-btn">
                    <?= htmlspecialchars($categorie['name_category']) ?>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Affichage des Produits -->
<?php if (!empty($produits)): ?>
    <div class="products-container">
        <h2 class="products-title">Produits de la catégorie sélectionnée</h2>
        <div class="products-grid">
            <?php foreach ($produits as $produit): ?>
                <div class="product-card">
                    <?php
                    // Gestion sécurisée des images
                    $imageFilename = basename($produit['image']);
                    $imagePath = 'uploads/' . $imageFilename;
                    $absolutePath = $_SERVER['DOCUMENT_ROOT'] . '/' . $imagePath;
                    $altText = htmlspecialchars($produit['name']);
                    
                    // Vérification de l'existence du fichier
                    if (file_exists($absolutePath) && is_file($absolutePath)):
                    ?>
                        <img src="<?= htmlspecialchars($imagePath) ?>" alt="<?= $altText ?>" class="product-image">
                    <?php else: ?>
                        <img src="uploads/default.png" alt="Image par défaut - <?= $altText ?>" class="product-image">
                        <?php error_log("Image manquante: " . $absolutePath); ?>
                    <?php endif; ?>

                    <h3 class="product-name"><?= htmlspecialchars($produit['name']) ?></h3>
                    <p class="product-description"><?= htmlspecialchars($produit['description']) ?></p>
                    <p class="product-price">Prix : <?= number_format($produit['price'], 2) ?> €</p>
                    <p class="product-stock">Stock : <?= intval($produit['stock_quantity']) ?></p>

                    <form action="panier.php" method="post">
                        <input type="hidden" name="product_id" value="<?= intval($produit['id']) ?>">
                        <input type="submit" value="Ajouter au panier" class="add-to-cart-btn">
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php elseif (isset($_GET['category'])): ?>
    <p class="no-products">Aucun produit trouvé pour cette catégorie.</p>
<?php endif; ?>

</body>
</html>