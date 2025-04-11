<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Voyages</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

    <div id="container">

        <h1 class="text-center my-4">Gestion des Voyages</h1>

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