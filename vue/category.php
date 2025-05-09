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

</body>
</html>
