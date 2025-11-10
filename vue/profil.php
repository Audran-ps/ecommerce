<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    header("Location: conection.php");
    exit;
}

$user = $_SESSION['user'];

// Traitement des mises à jour du profil
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'update_profile':
            // Mettre à jour les informations du profil
            $_SESSION['user']['prenom'] = htmlspecialchars($_POST['prenom']);
            $_SESSION['user']['email'] = htmlspecialchars($_POST['email']);
            $_SESSION['user']['telephone'] = htmlspecialchars($_POST['telephone']);
            $_SESSION['user']['adresse'] = htmlspecialchars($_POST['adresse']);
            $success_message = "Profil mis à jour avec succès !";
            $user = $_SESSION['user'];
            break;
            
        case 'upload_avatar':
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === 0) {
                $allowed = ['jpg', 'jpeg', 'png', 'gif'];
                $filename = $_FILES['avatar']['name'];
                $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                
                if (in_array($ext, $allowed)) {
                    $newname = 'avatar_' . $user['id'] . '.' . $ext;
                    $upload_path = 'uploads/' . $newname;
                    
                    if (move_uploaded_file($_FILES['avatar']['tmp_name'], $upload_path)) {
                        $_SESSION['user']['avatar'] = $upload_path;
                        $user = $_SESSION['user'];
                        $success_message = "Photo de profil mise à jour !";
                    }
                }
            }
            break;
    }
}

// Récupérer l'historique des commandes (simulation)
$commandes = [
    [
        'id' => '001',
        'date' => '2024-03-15',
        'total' => 89.99,
        'statut' => 'Livrée',
        'articles' => 3
    ],
    [
        'id' => '002',
        'date' => '2024-03-20',
        'total' => 129.99,
        'statut' => 'En cours',
        'articles' => 2
    ]
];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil - Nanos</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --primary-color: #29d9d5;
            --secondary-color: #1fb3af;
            --dark-bg: #222;
            --white-text: #fff;
            --light-gray: #f8f9fa;
            --border-color: #e0e0e0;
            --transition-speed: 0.3s;
        }

        body {
            font-family: 'Segoe UI', Roboto, 'Helvetica Neue', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding-top: 80px;
        }

        /* Header styles */
        header {
            background-color: var(--dark-bg);
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
            color: var(--primary-color);
            text-decoration: none;
            transition: color var(--transition-speed) ease;
        }

        .logo a:hover {
            color: var(--secondary-color);
        }

        .logo a span {
            color: var(--white-text);
        }

        .menu {
            display: flex;
            list-style: none;
            align-items: center;
            margin: 0;
        }

        .menu li {
            margin: 0 15px;
            position: relative;
        }

        .menu li a {
            color: var(--white-text);
            font-size: 1.4rem;
            text-decoration: none;
            position: relative;
            transition: color var(--transition-speed) ease;
            display: flex;
            align-items: center;
        }

        .menu li a:hover {
            color: var(--primary-color);
        }

        .menu li a::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -5px;
            height: 2px;
            width: 0%;
            background-color: var(--primary-color);
            transition: width var(--transition-speed) ease;
        }

        .menu li a:hover::after {
            width: 100%;
        }

        .cart-count {
            background-color: var(--primary-color);
            color: #000;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 0.8rem;
            margin-left: 5px;
            font-weight: bold;
        }

        .btn-reservation {
            color: var(--primary-color);
            font-size: 1.4rem;
            border: 2px solid var(--primary-color);
            padding: 5px 20px;
            transition: all var(--transition-speed) ease;
            font-weight: bold;
            text-decoration: none;
            border-radius: 4px;
        }

        .btn-reservation:hover {
            background-color: var(--primary-color);
            color: var(--dark-bg);
            transform: translateY(-2px);
        }

        .user-info {
            display: flex;
            align-items: center;
            color: var(--white-text);
            margin-right: 15px;
        }

        .user-info img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 10px;
        }

        /* Container principal */
        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .profile-header {
            text-align: center;
            margin-bottom: 40px;
            animation: fadeInDown 0.6s ease;
        }

        .profile-header h1 {
            font-size: 2.5rem;
            color: white;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .profile-wrapper {
            display: grid;
            grid-template-columns: 350px 1fr;
            gap: 30px;
            animation: fadeInUp 0.6s ease;
        }

        /* Carte de profil */
        .profile-card {
            background: white;
            border-radius: 20px;
            padding: 40px 30px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
            text-align: center;
            height: fit-content;
            position: sticky;
            top: 100px;
        }

        .avatar-container {
            position: relative;
            width: 150px;
            height: 150px;
            margin: 0 auto 25px;
        }

        .avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid var(--primary-color);
            box-shadow: 0 5px 20px rgba(41, 217, 213, 0.3);
        }

        .avatar-upload {
            position: absolute;
            bottom: 5px;
            right: 5px;
            background: var(--primary-color);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all var(--transition-speed) ease;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
        }

        .avatar-upload:hover {
            background: var(--secondary-color);
            transform: scale(1.1);
        }

        .avatar-upload input {
            display: none;
        }

        .profile-name {
            font-size: 1.8rem;
            font-weight: bold;
            color: var(--dark-bg);
            margin-bottom: 10px;
        }

        .profile-email {
            color: #666;
            margin-bottom: 25px;
        }

        .profile-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-top: 30px;
        }

        .stat-item {
            background: var(--light-gray);
            padding: 15px;
            border-radius: 10px;
            text-align: center;
        }

        .stat-number {
            font-size: 1.8rem;
            font-weight: bold;
            color: var(--primary-color);
        }

        .stat-label {
            font-size: 0.9rem;
            color: #666;
            margin-top: 5px;
        }

        /* Section de contenu */
        .profile-content {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        }

        .tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
            border-bottom: 2px solid var(--border-color);
        }

        .tab-btn {
            padding: 15px 30px;
            background: none;
            border: none;
            font-size: 1.1rem;
            font-weight: 600;
            color: #666;
            cursor: pointer;
            transition: all var(--transition-speed) ease;
            border-bottom: 3px solid transparent;
            position: relative;
            bottom: -2px;
        }

        .tab-btn.active {
            color: var(--primary-color);
            border-bottom-color: var(--primary-color);
        }

        .tab-content {
            display: none;
            animation: fadeIn 0.4s ease;
        }

        .tab-content.active {
            display: block;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--dark-bg);
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid var(--border-color);
            border-radius: 10px;
            font-size: 1rem;
            transition: all var(--transition-speed) ease;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(41, 217, 213, 0.1);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all var(--transition-speed) ease;
            box-shadow: 0 5px 15px rgba(41, 217, 213, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(41, 217, 213, 0.4);
        }

        /* Commandes */
        .order-card {
            background: var(--light-gray);
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 15px;
            display: grid;
            grid-template-columns: auto 1fr auto;
            gap: 20px;
            align-items: center;
            transition: all var(--transition-speed) ease;
        }

        .order-card:hover {
            transform: translateX(5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .order-id {
            background: white;
            padding: 10px 15px;
            border-radius: 8px;
            font-weight: bold;
            color: var(--primary-color);
        }

        .order-info {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .order-date {
            color: #666;
            font-size: 0.9rem;
        }

        .order-status {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .status-livree {
            background: #d4edda;
            color: #155724;
        }

        .status-en-cours {
            background: #fff3cd;
            color: #856404;
        }

        .order-total {
            font-size: 1.3rem;
            font-weight: bold;
            color: var(--dark-bg);
        }

        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            border-left: 4px solid #28a745;
        }

        /* Animations */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .profile-wrapper {
                grid-template-columns: 1fr;
            }

            .profile-card {
                position: static;
            }
        }

        @media (max-width: 768px) {
            .tabs {
                overflow-x: auto;
            }

            .tab-btn {
                padding: 12px 20px;
                font-size: 1rem;
            }

            .order-card {
                grid-template-columns: 1fr;
                text-align: center;
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
        <div class="user-info">
            <img src="<?= htmlspecialchars($user['avatar'] ?? 'uploads/default-avatar.png') ?>" alt="Avatar">
            <span><?= htmlspecialchars($user['prenom']) ?></span>
        </div>
        <li><a href="category.php">Accueil</a></li>
        <li><a href="profil.php">Mon Profil</a></li>
        <li><a href="deconnexion.php">Déconnexion</a></li>
        <li>
            <a href="panier.php">
                🛒 Panier 
                <span class="cart-count">
                    <?= isset($_SESSION['panier']) ? array_sum(array_column($_SESSION['panier'], 'quantity')) : 0 ?>
                </span>
            </a>
        </li>
    </ul>

    <a href="contact.php" class="btn-reservation">Contact</a>
</header>

<div class="container">
    <div class="profile-header">
        <h1>👤 Mon Profil</h1>
    </div>

    <?php if (isset($success_message)): ?>
        <div class="success-message"><?= $success_message ?></div>
    <?php endif; ?>

    <div class="profile-wrapper">
        <!-- Carte de profil -->
        <div class="profile-card">
            <form method="post" enctype="multipart/form-data" id="avatarForm">
                <input type="hidden" name="action" value="upload_avatar">
                <div class="avatar-container">
                    <img src="<?= htmlspecialchars($user['avatar'] ?? 'uploads/default-avatar.png') ?>" alt="Avatar" class="avatar">
                    <label class="avatar-upload">
                        <input type="file" name="avatar" accept="image/*" onchange="document.getElementById('avatarForm').submit()">
                        📷
                    </label>
                </div>
            </form>

            <div class="profile-name"><?= htmlspecialchars($user['prenom'] ?? 'Utilisateur') ?></div>
            <div class="profile-email"><?= htmlspecialchars($user['email'] ?? 'email@example.com') ?></div>

            <div class="profile-stats">
                <div class="stat-item">
                    <div class="stat-number"><?= count($commandes) ?></div>
                    <div class="stat-label">Commandes</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number"><?= isset($_SESSION['panier']) ? count($_SESSION['panier']) : 0 ?></div>
                    <div class="stat-label">Au panier</div>
                </div>
            </div>
        </div>

        <!-- Contenu principal -->
        <div class="profile-content">
            <div class="tabs">
                <button class="tab-btn active" onclick="switchTab('informations')">📝 Informations</button>
                <button class="tab-btn" onclick="switchTab('commandes')">📦 Mes commandes</button>
                <button class="tab-btn" onclick="switchTab('securite')">🔒 Sécurité</button>
            </div>

            <!-- Onglet Informations -->
            <div class="tab-content active" id="informations">
                <h2 style="margin-bottom: 25px; color: var(--dark-bg);">Mes informations personnelles</h2>
                <form method="post">
                    <input type="hidden" name="action" value="update_profile">
                    
                    <div class="form-group">
                        <label for="prenom">Prénom *</label>
                        <input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($user['prenom'] ?? '') ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="telephone">Téléphone</label>
                        <input type="tel" id="telephone" name="telephone" value="<?= htmlspecialchars($user['telephone'] ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <label for="adresse">Adresse de livraison</label>
                        <textarea id="adresse" name="adresse" rows="3"><?= htmlspecialchars($user['adresse'] ?? '') ?></textarea>
                    </div>

                    <button type="submit" class="btn-primary">💾 Enregistrer les modifications</button>
                </form>
            </div>

            <!-- Onglet Commandes -->
            <div class="tab-content" id="commandes">
                <h2 style="margin-bottom: 25px; color: var(--dark-bg);">Historique de mes commandes</h2>
                
                <?php if (empty($commandes)): ?>
                    <div style="text-align: center; padding: 40px;">
                        <div style="font-size: 4rem; opacity: 0.3; margin-bottom: 20px;">📦</div>
                        <p style="color: #666; font-size: 1.1rem;">Aucune commande pour le moment</p>
                        <a href="category.php" class="btn-primary" style="display: inline-block; margin-top: 20px; text-decoration: none;">Découvrir nos produits</a>
                    </div>
                <?php else: ?>
                    <?php foreach ($commandes as $commande): ?>
                        <div class="order-card">
                            <div class="order-id">#<?= $commande['id'] ?></div>
                            <div class="order-info">
                                <div class="order-date">📅 <?= date('d/m/Y', strtotime($commande['date'])) ?></div>
                                <div><?= $commande['articles'] ?> article<?= $commande['articles'] > 1 ? 's' : '' ?></div>
                                <span class="order-status status-<?= strtolower(str_replace(' ', '-', $commande['statut'])) ?>">
                                    <?= $commande['statut'] ?>
                                </span>
                            </div>
                            <div class="order-total"><?= number_format($commande['total'], 2) ?> €</div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- Onglet Sécurité -->
            <div class="tab-content" id="securite">
                <h2 style="margin-bottom: 25px; color: var(--dark-bg);">Sécurité du compte</h2>
                
                <div class="form-group">
                    <label for="old_password">Ancien mot de passe</label>
                    <input type="password" id="old_password" name="old_password">
                </div>

                <div class="form-group">
                    <label for="new_password">Nouveau mot de passe</label>
                    <input type="password" id="new_password" name="new_password">
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirmer le mot de passe</label>
                    <input type="password" id="confirm_password" name="confirm_password">
                </div>

                <button type="submit" class="btn-primary">🔒 Modifier le mot de passe</button>
            </div>
        </div>
    </div>
</div>

<script>
function switchTab(tabName) {
    // Masquer tous les contenus
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.remove('active');
    });
    
    // Désactiver tous les boutons
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    
    // Activer l'onglet sélectionné
    document.getElementById(tabName).classList.add('active');
    event.target.classList.add('active');
}
</script>

</body>
</html>