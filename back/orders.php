<?php
$servername = "localhost";
$username = "root"; // à adapter si différent
$password = ""; // à adapter selon ton installation
$dbname = "ecommerce"; // nom de ta base de données

// Exemple de données
$id_orders = 1;
$id_users = 5;
$id_orders_item = 10;

$sql = "INSERT INTO orders (Id_orders, Id_users, Id_orders_item) VALUES (?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id_orders, $id_users, $id_orders_item]);

echo "Commande ajoutée avec succès.";
?>