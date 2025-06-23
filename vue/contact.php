<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <style>
        /* Reset et styles de base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.6;
        }

        /* Styles de la section contact */
        #contact {
            max-width: 1200px;
            margin: 50px auto;
            padding: 0 20px;
            animation: fadeIn 1s ease-in-out;
        }

        .title {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 40px;
            color: #2c3e50;
            position: relative;
            padding-bottom: 15px;
        }

        .title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(90deg, #3498db, #9b59b6);
            border-radius: 2px;
        }

        form {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        form:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .left-right {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
        }

        .left, .right {
            flex: 1;
            min-width: 300px;
        }

        label {
            display: block;
            margin: 15px 0 8px;
            font-weight: 600;
            color: #2c3e50;
            animation: slideIn 0.5s ease-out forwards;
        }

        input, textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 6px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        input:focus, textarea:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
            outline: none;
            transform: scale(1.02);
        }

        textarea {
            resize: vertical;
            min-height: 150px;
        }

        iframe {
            width: 100%;
            height: 300px;
            border: none;
            border-radius: 8px;
            margin-top: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.5s ease;
        }

        iframe:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        button {
            display: block;
            width: 200px;
            margin: 30px auto 0;
            padding: 15px;
            background: linear-gradient(45deg, #3498db, #9b59b6);
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.4s ease;
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.4);
            animation: pulse 2s infinite;
        }

        button:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 25px rgba(52, 152, 219, 0.6);
            animation: none;
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 20px;
            background-color: #2c3e50;
            color: white;
            margin-top: 50px;
            animation: slideUp 0.8s ease-out;
        }

        footer span {
            color: #3498db;
            font-weight: 600;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideIn {
            from { 
                opacity: 0;
                transform: translateX(-20px);
            }
            to { 
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideUp {
            from { 
                opacity: 0;
                transform: translateY(50px);
            }
            to { 
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .left-right {
                flex-direction: column;
            }
            
            .title {
                font-size: 2rem;
            }
            
            button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <?php
    // include '../back/connection.php';
    include 'navbar.php';
?>
    <!-- Section contact -->
    <section id="contact">
        <h1 class="title">Contact</h1>
        <form action="">
            <div class="left-right">
                <div class="left">
                    <label>Nom Complet</label>
                    <input type="text" placeholder="Votre nom complet">
                    <label>Objet</label>
                    <input type="text" placeholder="Objet de votre message">
                    <label>Email</label>
                    <input type="email" placeholder="Votre email">
                    <label>Message</label>
                    <textarea placeholder="Votre message..." cols="30" rows="10"></textarea>
                </div>
                <div class="right">
                    <label>Numéro</label>
                    <input type="tel" placeholder="Votre numéro de téléphone">
                    <label>Date</label>
                    <input type="date">
                    <label>Autres Détails</label>
                    <input type="text" placeholder="Informations supplémentaires">
                    <label>Adresse</label>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.9916256937595!2d2.292292615509614!3d48.85837007928746!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e2964e34e2d%3A0x8ddca9ee380ef7e0!2sTour%20Eiffel!5e0!3m2!1sfr!2sfr!4v1647531560805!5m2!1sfr!2sfr" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
            <button type="submit">Envoyer</button>
        </form>
    </section>

    <footer>
        <p>Réalisé par <span>Nanos</span> | Tous les droits sont réservés.</p>
    </footer>

    <script>
        // Animation pour les éléments au scroll
        document.addEventListener('DOMContentLoaded', function() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animated');
                    }
                });
            }, { threshold: 0.1 });

            document.querySelectorAll('label, input, textarea, iframe').forEach(el => {
                observer.observe(el);
            });
        });

        // Menu responsive (si vous l'utilisez)
        var toggle_menu = document.querySelector('.responsive-menu');
        var menu = document.querySelector('.menu');
        if (toggle_menu && menu) {
            toggle_menu.onclick = function() {
                toggle_menu.classList.toggle('active');
                menu.classList.toggle('responsive');
            };
        }
    </script>
</body>
</html>