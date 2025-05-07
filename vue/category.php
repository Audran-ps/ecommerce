<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Boutique</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body { font-family: Arial, sans-serif; }
        .hero-banner {
            position: relative;
            background: url('../assets/banner.jpg') center/cover no-repeat;
            height: 60vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .hero-banner h1 {
            color: white;
            font-size: 4rem;
            font-weight: bold;
            text-shadow: 2px 2px 5px #000;
        }
        .category-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 30px 0;
        }
        .category-links a {
            text-decoration: none;
            font-weight: bold;
            color: #000;
            border-bottom: 2px solid transparent;
        }
        .category-links a:hover {
            border-bottom: 2px solid #000;
        }
        .product-card img {
            height: 250px;
            object-fit: cover;
        }
    </style>
</head>
<body>

<?php
    include '../back/category.php';
    ?>
    
    <?php foreach ($categorie_recuperer as $categorie): ?>
        <a href=""><?= htmlspecialchars($categorie['name_category']) ?></a>
    <?php endforeach; ?>

<!-- BANNIÈRE HERO -->
<div class="hero-banner">
    <h1>out of core</h1>
</div>

<!-- CATEGORIES -->
<div class="category-links">
    <?php foreach ($categorie_recuperer as $categorie): ?>
        <a href="?category=<?= urlencode($categorie['Id_category']) ?>"></a>
            <?= htmlspecialchars($categorie['name_category']) ?>
        </a>
    <?php endforeach; ?>
</div>

<!-- AFFICHAGE DES PRODUITS -->
<div class="container">
    <div class="row">
        <?php
        // Connexion à la BDD
        $conn = new PDO("mysql:host=localhost;dbname=ecommerce;charset=utf8", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Récupération des produits selon la catégorie sélectionnée
        $categoryId = $_GET['categorie'] ?? null;

        $query = "SELECT * FROM products";
        if ($categoryId) {
            $query .= " WHERE category_id = ?";
            $stmt = $pdo->query($sql);
            $stmt->execute([$categoryId]);
        } else {
            $stmt = $conn->query($sql);
        }

        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($products as $product):
        ?>
            <div class="col-md-4 mb-4">
                <div class="card product-card">
                    

                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>
