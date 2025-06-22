<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Boutique - Catégories</title>
    <link rel="stylesheet" href="category.css">
</head>
<body>

<?php
    $data = include '../back/category.php';
    $categorie_recuperer = $data['categories'];
    $produits = $data['produits'];

    include 'navbar.php'; // si tu as une barre de navigation
?>

<!-- BANNIÈRE -->
<div class="bg-dark text-white text-center py-5 mb-4" style="background-color: #222; padding: 100px 0; margin-bottom: 50px;">
    <h1 style="color: #29d9d5; font-size: 3rem;">Catégories</h1>
</div>

<!-- BOUTONS CATÉGORIES -->
<div style="max-width: 1000px; margin: 0 auto 50px;">
    <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 15px;">
        <?php foreach ($categorie_recuperer as $categorie): ?>
            <div>
                <a href="?category=<?= urlencode($categorie['Id_category']) ?>" class="category-btn"
                   style="display: inline-block; border: 1px solid #29d9d5; padding: 10px 20px; color: #29d9d5; text-decoration: none; font-weight: bold; border-radius: 30px; box-shadow: 2px 2px 10px rgba(0, 255, 255, 0.2);">
                    <?= htmlspecialchars($categorie['name_category']) ?>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- AFFICHAGE DES PRODUITS -->
<?php if (!empty($produits)): ?>
    <div style="max-width: 1000px; margin: 0 auto; padding-bottom: 50px;">
        <h2 style="text-align: center; color: #29d9d5; margin-bottom: 30px;">Produits de la catégorie sélectionnée</h2>
        <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 20px;">
            <?php foreach ($produits as $produit): ?>
                <div style="background: #fff; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); padding: 20px; width: 250px;">
                    <h3 style="color: #222;"><?= htmlspecialchars($produit['name']) ?></h3>
                    <p style="color: #555;"><?= htmlspecialchars($produit['description']) ?></p>
                    <p style="font-weight: bold;">Prix : <?= number_format($produit['price'], 2) ?> €</p>
                    <p>Stock : <?= intval($produit['stock_quantity']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php elseif (isset($_GET['category'])): ?>
    <p style="text-align: center; color: #888;">Aucun produit trouvé pour cette catégorie.</p>
<?php endif; ?>

</body>
</html>
