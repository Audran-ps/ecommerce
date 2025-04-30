<?php
$servername = "localhost";
$username = "root"; // à adapter si différent
$password = ""; // à adapter selon ton installation
$dbname = "ecommerce"; // nom de ta base de données

$id_product = 3;
$price = 49.99;
$payment_method = 'Carte bancaire';
$order_date = '2025-04-30';

// Requête SQL avec paramètres nommés
$sql = "INSERT INTO orders_items (id_product, price, payment_method, order_date)
        VALUES (:id_product, :price, :payment_method, :order_date)";

$stmt = $pdo->prepare($sql);
$stmt->execute([

    ':id_product' => $id_product,
    ':price' => $price,
    ':payment_method' => $payment_method,
    ':order_date' => $order_date
]);

echo "Ligne ajoutée à la table orders_items.";
?>
