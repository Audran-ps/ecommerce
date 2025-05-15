<link rel="stylesheet" href="navbar.css">
<header>
    <div class="logo">
        <a href="category.php">N<span>anos</span></a>
    </div>
    <ul class="menu">
        <li><a href="category.php">Accueil</a></li>
        <li><a href="inscription.php">Inscription</a></li>
        <li><a href="conection.php">Connection</a></li>
        <li><a href="product.php">Produit</a></li>
        <li><a href="shoppingcart.php">🛒 Panier (<?= isset($_SESSION['panier']) ? array_sum($_SESSION['panier']) : 0 ?>)</a></li>

    </ul>
    <a href="reservation.php" class="btn-reservation">Réserver</a>

    <!-- Menu responsive burger -->
    <div class="responsive-menu" onclick="toggleMenu(this)"></div>
</header>

