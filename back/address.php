<?php
// Paramètres de connexion
$servername = "localhost";
$username = "root"; // à adapter si différent
$password = ""; // à adapter selon ton installation
$dbname = "ecommerce"; // nom de ta base de données

// Connexion à la base de données
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Vérifie la connexion
if (!$conn) {
    die("Connexion échouée: " . mysqli_connect_error());
}

// Données à insérer (exemple)
$id_user = 1;
$city = "Paris";
$postal_code = "75000";
$country = "France";

// Requête d'insertion
$sql = "INSERT INTO adress (id_user, city, postal_code, country) 
        VALUES ('$id_user', '$city', '$postal_code', '$country')";

if (mysqli_query($conn, $sql)) {
    echo "Nouvelle adresse ajoutée avec succès.";
} else {
    echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
}

// Fermer la connexion
mysqli_close($conn);
?>