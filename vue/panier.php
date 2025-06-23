<?php
session_start();

// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=ecommerce;charset=utf8', 'root', '');

// Ajout au panier
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['category_id'])) {
    $product_id = intval($_POST['category_id']);

    // Récupérer les infos du category
    $stmt = $pdo->prepare("SELECT * FROM  WHERE id = ?");
    $stmt->execute([$product_id]);
    $category = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($category) {
        // Ajouter ou incrémenter le category dans la session
        if (!isset($_SESSION['panier'][$product_id])) {
            $_SESSION['panier'][$product_id] = [
                'id' => $category['id'],
                'name' => $category['name'],
                'price' => $category['price'],
                'image' => $category['image'],
                'quantity' => 1
            ];
        } else {
            $_SESSION['panier'][$product_id]['quantity']++;
        }

        header("Location: panier.php");
        exit;
    }
}

// Récupérer les éléments du panier
$panier = $_SESSION['panier'] ?? [];

$total = 0;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Panier</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'navbar.php'; ?>

<div style="max-width: 900px; margin: 50px auto;">
    <h1 style="color: #29d9d5; text-align: center;">🛒 Mon Panier</h1>

    <?php if (empty($panier)): ?>
        <p style="text-align: center; color: #aaa;">Votre panier est vide.</p>
    <?php else: ?>
        <table style="width: 100%; border-collapse: collapse; margin-top: 30px;">
            <thead>
                <tr style="background-color: #29d9d5; color: white;">
                    <th style="padding: 10px;">Image</th>
                    <th>Nom</th>
                    <th>Quantité</th>
                    <th>Prix</th>
                    <th>Sous-total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($panier as $item): 
                    $sous_total = $item['price'] * $item['quantity'];
                    $total += $sous_total;
                ?>
                <tr style="text-align: center;">
                    <td><img src="../uploads/<?= htmlspecialchars($item['image']) ?>" style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px;"></td>
                    <td><?= htmlspecialchars($item['name']) ?></td>
                    <td><?= $item['quantity'] ?></td>
                    <td><?= number_format($item['price'], 2) ?> €</td>
                    <td><?= number_format($sous_total, 2) ?> €</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div style="text-align: right; margin-top: 20px;">
            <h3>Total : <?= number_format($total, 2) ?> €</h3>
            <button style="margin-top: 10px; background-color: #29d9d5; border: none; padding: 12px 20px; font-size: 16px; font-weight: bold; color: black; border-radius: 8px; cursor: pointer;">
                Procéder au paiement
            </button>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
