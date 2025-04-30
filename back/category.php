<?php
// Paramètres de connexion
$servername = "localhost";
$username = "root"; // Modifier si nécessaire
$password = ""; // Modifier selon ton installation
$dbname = "ecommerce"; // Nom de la base de données

// Connexion à MySQL
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Vérifier la connexion
if (!$conn) {
    die("Connexion échouée: " . mysqli_connect_error());
}

// Données à insérer (exemple)
$name_category = "Électronique";
$description = "Tous les produits électroniques et gadgets.";

// Requête d'insertion
$sql = "INSERT INTO category (name_category, description)
        VALUES ('$name_category', '$description')";

if (mysqli_query($conn, $sql)) {
    echo "Catégorie ajoutée avec succès.";
} else {
    echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
}

// Fermer la connexion
mysqli_close($conn);
?>