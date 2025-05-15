<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_product = $_POST['id_product'];
    $quantity = $_POST['quantity'];

    // Initialisation du panier s'il n'existe pas
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = [];
    }

    // Ajout ou mise à jour du produit
    if (isset($_SESSION['panier'][$id_product])) {
        $_SESSION['panier'][$id_product] += $quantity;
    } else {
        $_SESSION['panier'][$id_product] = $quantity;
    }

    // Redirection vers le panier
    header('Location: panier.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($produit['name']) ?></title>
    <link rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .product-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            align-items: center;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .product-container img {
            width: 300px;
            height: 300px;
            object-fit: cover;
            border-radius: 10px;
        }
        .product-details {
            flex: 1;
        }
        .product-details h1 {
            font-size: 2rem;
            color: #29d9d5;
            margin-bottom: 10px;
        }
        .product-details p {
            margin: 8px 0;
            color: #555;
        }
        .product-details .price {
            font-weight: bold;
            font-size: 1.3rem;
            color: #29d9d5;
        }
        .product-details .stock {
            font-size: 0.95rem;
            color: #777;
        }
        .btn {
            margin-top: 20px;
            padding: 12px 25px;
            background-color: #29d9d5;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
        }
        .btn:hover {
            background-color: #1bc4c0;
        }
        .back-link {
            text-align: center;
            margin: 20px 0;
        }
        .back-link a {
            color: #29d9d5;
            text-decoration: none;
        }
        .navbar {
    background-color: #222;
    padding: 15px 30px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.navbar ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    gap: 30px;
}

.navbar ul li {
    display: inline;
}

.navbar ul li a {
    color: #29d9d5;
    text-decoration: none;
    font-weight: bold;
    font-size: 1.1rem;
    transition: color 0.3s ease;
}

.navbar ul li a:hover {
    color: #1bc4c0;
    text-decoration: underline;
}

    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <ul>
            <li><a href="category.php">Accueil</a></li>
            <li><a href="shoppingcart.php">Pannier</a></li>
        </ul>
    </nav>

    <div id="container">

        <h1 class="text-center my-4">Produit</h1>

        <!-- Section des produits -->
        <h2>Liste des Voyages</h2>
        <div id="voyages" class="row">
            <!-- Les voyages seront affichés ici -->
        </div>

        <!-- Formulaire d'ajout d'un voyage -->
        <h2>Ajouter un Voyage</h2>
        <form id="ajoutVoyageForm">
            <input type="text" id="nomVoyage" placeholder="Nom du voyage" required class="form-control mb-2">
            <input type="number" id="prixVoyage" placeholder="Prix (€)" required class="form-control mb-2">
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>

        <!-- Section Panier -->
        <h2 class="mt-4">Panier</h2>
        <ul id="panier" class="list-group">
            <!-- Les éléments du panier seront affichés ici -->
        </ul>
        <button id="viderPanier" class="btn btn-danger mt-2">Vider le panier</button>
    </div>

    <script src="script.js"></script>

</body>
</html>
