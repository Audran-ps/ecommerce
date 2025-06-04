<?php
session_start();

// Vérification CAPTCHA en premier
if (!isset($_POST['captcha']) || $_POST['captcha'] != $_SESSION['captcha_code']) {
    die('❌ Erreur : Le code CAPTCHA est incorrect.');
}
unset($_SESSION['captcha_code']);

// Connexion à la base de données
$host = 'localhost';
$dbname = 'ecommerce';
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
} catch (PDOException $e) {
    die("❌ Erreur de connexion : " . $e->getMessage());
}

// Récupération des données
$name = $_POST['username'] ?? '';
$username = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$confirm_password = $_POST['confirm-password'] ?? '';

// Vérification mot de passe
if ($password !== $confirm_password) {
    die('❌ Les mots de passe ne correspondent pas.');
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insertion dans la base
try {
    $sql = "INSERT INTO users (name, username, email, password) VALUES (:nom, :prenom, :email, :hashedPassword)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nom' => $name,
        ':prenom' => $username,
        ':email' => $email,
        ':hashedPassword' => $hashedPassword,
    ]);
} catch (PDOException $e) {
    die("❌ Erreur lors de l'inscription : " . $e->getMessage());
}

// ⚡ Envoi d'email avec PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    // Configuration du serveur SMTP
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'paysaudran@gmail.com';       // ➤ Ton adresse Gmail
    $mail->Password   = 'ibom vaod cibr mkvj' ;   // ➤ Mot de passe d'application
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // Expéditeur et destinataire
    $mail->setFrom('paysaudran@gmail.com', 'Nanos');
    $mail->addAddress($email, "$username $name");

    // Contenu du mail
    $mail->isHTML(true);
    $mail->Subject = "Bienvenue sur notre site, $username !";
    $mail->Body    = "
        <h1>Inscription réussie</h1>
        <p>Bonjour $username,</p>
        <p>Merci de vous être inscrit sur notre site. Vous pouvez maintenant vous connecter.</p>
        <p><a href='http://localhost/ecommerce/vue/conection.php'>Se connecter</a></p>
    ";

    $mail->send();
    echo "✅ Inscription réussie ! Un email de confirmation a été envoyé à <strong>$email</strong>.";
} catch (Exception $e) {
    echo "⚠️ Inscription réussie, mais l'email n'a pas pu être envoyé. Erreur : {$mail->ErrorInfo}";
}
