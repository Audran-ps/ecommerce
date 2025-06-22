<!-- navbar.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nanos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #222;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 60px;
            padding: 0 5%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        .logo a {
            font-size: 2.4rem;
            font-weight: bold;
            color: #29d9d5;
            text-decoration: none;
        }

        .logo a span {
            color: #fff;
        }

        .menu {
            display: flex;
            list-style: none;
            align-items: center;
        }

        .menu li {
            margin: 0 15px;
        }

        .menu li a {
            color: #fff;
            font-size: 1.4rem;
            text-decoration: none;
            position: relative;
            transition: color 0.3s ease;
        }

        .menu li a::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -5px;
            height: 2px;
            width: 0%;
            background-color: #29d9d5;
            transition: width 0.3s ease;
        }

        .menu li a:hover::after {
            width: 100%;
        }

        .btn-reservation {
            color: #29d9d5;
            font-size: 1.4rem;
            border: 2px solid #29d9d5;
            padding: 5px 20px;
            transition: 0.3s;
            font-weight: bold;
            text-decoration: none;
        }

        .btn-reservation:hover {
            background-color: #29d9d5;
            color: #fff;
        }

        .responsive-menu {
            display: none;
            width: 40px;
            height: 40px;
            position: relative;
            cursor: pointer;
        }

        .responsive-menu::before,
        .responsive-menu::after {
            content: "";
            position: absolute;
            width: 100%;
            height: 3px;
            background-color: #29d9d5;
            left: 0;
            transition: 0.4s;
        }

        .responsive-menu::before {
            top: 10px;
            box-shadow: 0 10px 0 #29d9d5;
        }

        .responsive-menu::after {
            top: 20px;
        }

        .responsive-menu.active::before {
            transform: rotate(45deg);
            box-shadow: none;
            top: 18px;
        }

        .responsive-menu.active::after {
            transform: rotate(-45deg);
            top: 18px;
        }

        @media (max-width: 768px) {
            .menu {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 60px;
                right: 0;
                background-color: #222;
                width: 200px;
                padding: 10px 0;
                box-shadow: 0 5px 10px rgba(0, 0, 0, 0.5);
                animation: slideFadeIn 0.4s ease forwards;
            }

            .menu.responsive {
                display: flex;
            }

            .menu li {
                margin: 10px 0;
                text-align: left;
                padding-left: 20px;
            }

            .responsive-menu {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .btn-reservation {
                display: none;
            }
        }

        @keyframes slideFadeIn {
            0% {
                opacity: 0;
                transform: translateY(-10px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

<header>
    <div class="logo">
        <a href="category.php">N<span>anos</span></a>
    </div>

    <ul class="menu">
        <li><a href="category.php">Accueil</a></li>
        <li><a href="inscription.php">Inscription</a></li>
        <li><a href="conection.php">Connexion</a></li>
        <li><a href="shoppingcart.php">🛒 Panier (<?= isset($_SESSION['panier']) ? array_sum($_SESSION['panier']) : 0 ?>)</a></li>
    </ul>

    <a href="reservation.php" class="btn-reservation">Réserver</a>
    <div class="responsive-menu"></div>
</header>

<script>
    const burger = document.querySelector('.responsive-menu');
    const menu = document.querySelector('.menu');
    const links = document.querySelectorAll('.menu li');

    burger.addEventListener('click', () => {
        burger.classList.toggle('active');
        menu.classList.toggle('responsive');

        if (menu.classList.contains('responsive')) {
            links.forEach((link, index) => {
                link.style.opacity = "0";
                setTimeout(() => {
                    link.style.opacity = "1";
                    link.style.transition = `opacity 0.3s ease ${index * 100}ms`;
                }, 50);
            });
        } else {
            links.forEach((link) => {
                link.style.opacity = "1";
                link.style.transition = "none";
            });
        }
    });
</script>

</body>
</html>
