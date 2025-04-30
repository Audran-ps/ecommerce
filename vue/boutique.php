<?php
global $produit;
include 'shoppingcart.php';
include 'navbar.html';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Boutique de Figurines</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .promo-banner {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            border-left: 5px solid #ffc107;
        }
        .price-highlight {
            color: #dc3545;
            font-weight: bold;
        }
        .card {
            transition: transform 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body class="bg-light">
<div class="container py-5">
    <!-- Bannière de promotion -->
    <div class="promo-banner">
        <h4>Livraison gratuite</h4>
        <p class="mb-1"><strong>Maintenant avec chaque commande</strong></p>
        <p class="mb-0"><strong>Promotion : 1x2 pour la première commande, 20€ ensuite. Peut être combiné...</strong></p>
    </div>

    <!-- Section Télécharger l'application -->
    <div class="row mb-4">
        <div class="col-12">
            <h4>Télécharger notre application</h4>
            <p>Comment ? Mise en ligne de mission à réussir...</p>
        </div>
    </div>

    <!-- Filtres -->
    <div class="row mb-4">
        <div class="col-md-3">
            <select class="form-select">
                <option>Février</option>
                <option>Avril</option>
            </select>
        </div>
        <div class="col-md-3">
            <select class="form-select">
                <option>Best seller</option>
                <option>Nouveautés</option>
            </select>
        </div>
        <div class="col-md-3">
            <select class="form-select">
                <option>5 étoiles</option>
                <option>Toutes notes</option>
            </select>
        </div>
        <div class="col-md-3">
            <select class="form-select">
                <option>Catégorie ▼</option>
                <option>Figurines</option>
                <option>Accessoires</option>
            </select>
        </div>
    </div>

    <!-- Résultats de recherche -->
    <h3 class="mb-3">Résultats pour "site de figurine"</h3>

    <div class="row g-4">
        <?php if (!empty($produit)): ?>
            <?php foreach ($produit as $row): ?>
                <div class="col-md-6 col-lg-3">
                    <div class="card shadow-sm h-100">
                        <?php
                        // Chemin vers les images
                        $imagePath = "../manga/" . $row['product_id'] . ".jpeg";
                        ?>

                        <img src="<?= htmlspecialchars($imagePath) ?>"
                             class="card-img-top"
                             alt="<?= htmlspecialchars($row['name']) ?>"
                             style="height: 200px; object-fit: cover;">

                        <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title"><?= htmlspecialchars($row['name']) ?></h5>
                            <p class="card-text text-muted small">
                                <?= substr(htmlspecialchars($row['description']), 0, 50) ?>...
                            </p>
                            <p class="price-highlight"><?= number_format($row['price'], 2) ?> €</p>
                            <div class="d-flex justify-content-between">
                                <a href="product_detail.php?id=<?= $row['product_id'] ?>" class="btn btn-outline-primary btn-sm">Voir</a>
                                <form method="post" action="add_to_cart.php">
                                    <input type="hidden" name="product_id" value="<?= $row['product_id'] ?>">
                                    <button type="submit" class="btn btn-success btn-sm">Ajouter</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-warning text-center">Aucun produit trouvé.</div>
            </div>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
