<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Boutique - Catégories</title>
    <link rel="stylesheet" href="category.css">
    <style>
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
        .product-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 10px;
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
        }
        .add-to-cart-btn:hover {
            background-color: #1fb3af;
        }
    </style>
</head>
<body>

<?php
    $data = include '../back/category.php';
    $categorie_recuperer = $data['categories'];
    $produits = $data['produits'];
    include 'navbar.php';
?>

<!-- BANNIÈRE -->
<div style="background-color: #222; color: white; text-align: center; padding: 100px 0; margin-bottom: 50px;">
    <h1 style="color: #29d9d5; font-size: 3rem;">Catégories</h1>
</div>

<!-- BOUTONS CATÉGORIES -->
<div style="max-width: 1000px; margin: 0 auto 50px;">
    <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 15px;">
        <?php foreach ($categorie_recuperer as $categorie): ?>
            <a href="?category=<?= urlencode($categorie['Id_category']) ?>" class="category-btn">
                <?= htmlspecialchars($categorie['name_category']) ?>
            </a>
        <?php endforeach; ?>
    </div>
</div>

<!-- AFFICHAGE DES PRODUITS -->
<?php if (!empty($produits)): ?>
    <div style="max-width: 1000px; margin: 0 auto; padding-bottom: 50px;">
        <h2 style="text-align: center; color: #29d9d5;">Produits de la catégorie sélectionnée</h2>
        <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 20px;">
            <?php foreach ($produits as $produit): ?>
                <div class="product-card">
                    <?php 
                        // Génération du nom de fichier image
                        $imageFile = $produit['Id_product'] . '.png';
                        $imagePath = 'uploads/' . $imageFile;
                        
                        // Vérification si l'image existe, sinon utiliser l'image par défaut
                        if (!file_exists($imagePath)) {
                            $imagePath = 'uploads/default.png';
                        }
                    ?>
                    <img src="<?= $imagePath ?>" class="product-image" alt="<?= htmlspecialchars($produit['name']) ?>">
                    <h3><?= htmlspecialchars($produit['name']) ?></h3>
                    <p><?= htmlspecialchars($produit['description']) ?></p>
                    <p><strong>Prix :</strong> <?= number_format($produit['price'], 2) ?> €</p>
                    <p>Stock : <?= $produit['stock_quantity'] ?></p>

                    <form action="panier.php" method="post">
                        <input type="hidden" name="id_product" value="<?= $produit['Id_product'] ?>">
                        <input type="submit" value="Ajouter au panier" class="add-to-cart-btn">
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php elseif (isset($_GET['category'])): ?>
    <p style="text-align: center; color: #888;">Aucun produit trouvé pour cette catégorie.</p>
<?php endif; ?>

</body>
</html>