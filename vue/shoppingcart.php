<?php
session_start();
include '../back/connection.php'; // ou ton fichier de connexion DB

// Initialiser le panier s'il n'existe pas
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

// Récupération des IDs produits dans le panier
$ids = array_keys($_SESSION['panier']);

$produits = [];
$total = 0;

if (!empty($ids)) {
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $stmt = $db->prepare("SELECT * FROM products WHERE id_product IN ($placeholders)");
    $stmt->execute($ids);
    $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Votre panier</title>
    <link rel="stylesheet" href="category.css">
    <style>
        table {
            width: 80%;
            margin: 40px auto;
            border-collapse: collapse;
            background-color: #fff;
        }
        th, td {
            padding: 15px;
            border-bottom: 1px solid #ccc;
            text-align: center;
        }
        th {
            background-color: #29d9d5;
            color: white;
        }
        .total {
            font-weight: bold;
            color: #29d9d5;
            font-size: 1.2em;
        }
        .btn {
            padding: 10px 20px;
            margin: 20px 10px;
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
        .empty {
            text-align: center;
            margin: 100px auto;
            color: #888;
            font-size: 1.4em;
        }
    </style>
</head>
<body>

<?php include 'navbar.php'; ?>

<h1 style="text-align:center; margin-top: 40px; color:#29d9d5;">Votre panier</h1>

<?php if (!empty($produits)): ?>
    <form method="post" action="vider_panier.php" style="text-align:center;">
        <button type="submit" class="btn">Vider le panier</button>
    </form>

    <table>
        <tr>
            <th>Produit</th>
            <th>Prix unitaire</th>
            <th>Quantité</th>
            <th>Sous-total</th>
        </tr>
        <?php foreach ($produits as $produit): 
            $quantite = $_SESSION['panier'][$produit['id_product']];
            $sous_total = $quantite * $produit['price'];
            $total += $sous_total;
        ?>
            <tr>
                <td><?= htmlspecialchars($produit['name']) ?></td>
                <td><?= number_format($produit['price'], 2) ?> €</td>
                <td><?= $quantite ?></td>
                <td><?= number_format($sous_total, 2) ?> €</td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="3" class="total">Total</td>
            <td class="total"><?= number_format($total, 2) ?> €</td>
        </tr>
    </table>

    <div style="text-align:center;">
        <button class="btn">Passer la commande</button>
    </div>
<?php else: ?>
    <div class="empty">Votre panier est vide.</div>
<?php endif; ?>

</body>
</html>
