<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Boutique</title>
    <link rel="stylesheet" href="category.css">
</head>
<body>

<?php
    include '../back/category.php';
    include 'navbar.php';
?>

<!-- BANNIÈRE HERO -->
<div class="bg-dark text-white text-center py-5 mb-4" style="background-color: #222; text-align:center; padding: 50px 0; margin-bottom: 30px;">
    <h1 style="color: #29d9d5; font-size: 3rem;">Catégories</h1>
</div>

<!-- CATÉGORIES -->
<div style="max-width: 1000px; margin: 0 auto 50px;">
    <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 15px;">
        <?php foreach ($categorie_recuperer as $categorie): ?>
            <div style="margin: 5px;">
                <a href="?category=<?= urlencode($categorie['Id_category']) ?>" class="category-btn"
                   style="display: inline-block; border: 1px solid #29d9d5; padding: 10px 20px; color: #29d9d5; text-decoration: none; font-weight: bold; transition: 0.3s;">
                    <?= htmlspecialchars($categorie['name_category']) ?>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- PRODUITS PAR CATÉGORIE -->
<form method="post" action="shoppingcart.php"></form>
<?php if (!empty($produits)): ?>
    <div style="max-width: 1200px; margin: 0 auto;">
        <h2 style="text-align:center; color:#29d9d5; margin-bottom: 30px;">Produits de la catégorie sélectionnée</h2>
        <div style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: center;">
            <?php foreach ($produits as $produit): ?>
                <div class="product-card">
                    <!-- Image du produit -->
                    <?php if (!empty($produit['image_url'])): ?>
                        <img src="<?= htmlspecialchars($produit['image_url']) ?>" alt="<?= htmlspecialchars($produit['name']) ?>" class="product-image">
                    <?php else: ?>
                        <img src="default.jpg" alt="Image non disponible" class="product-image">
                    <?php endif; ?>

                    <div class="product-card-body">
                        <h3><?= htmlspecialchars($produit['name']) ?></h3>
                        <p><?= htmlspecialchars($produit['description']) ?></p>
                        <p class="price"><?= htmlspecialchars($produit['price']) ?> €</p>
                        <p class="stock">Stock : <?= htmlspecialchars($produit['stock_quantity']) ?></p>

                        <!-- Formulaire d'ajout au panier -->

                            <input type="hidden" name="id_product" value="<?= $produit['id_product'] ?>">
                            <button type="submit" class="add-to-cart-btn">Ajouter au panier</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>

</body>
</html>

