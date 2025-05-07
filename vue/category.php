<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Boutique</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    
</head>
<body>

<?php
    include '../back/category.php';
    ?>
 <!-- BANNIÈRE HERO -->
<div class="bg-dark text-white text-center py-5 mb-4">
    <h1 class="display-4">categorie</h1>
</div>

<!-- CATÉGORIES -->
<div class="container mb-5">
    <div class="row justify-content-center">
        <?php foreach ($categorie_recuperer as $categorie): ?>
            <div class="col-auto mb-2">
                <a href="?category=<?= urlencode($categorie['Id_category']) ?>" class="btn btn-outline-primary">
                    <?= htmlspecialchars($categorie['name_category']) ?>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>


</body>
</html>
