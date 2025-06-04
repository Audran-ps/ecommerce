<?php
$host = 'localhost';
$dbname = 'ecommerce';
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
} catch (PDOException $e) {
    die("❌ Erreur de connexion : " . $e->getMessage());
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        $token = bin2hex(random_bytes(32));
        $expires = date('Y-m-d H:i:s', strtotime('+1 hour'));

        $stmt = $pdo->prepare("UPDATE users SET reset_token = ?, token_expire = ? WHERE email = ?");
        $stmt->execute([$token, $expires, $email]);

        $resetLink = "http://localhost/ecommerce/vue/conection.php?token=" . $token;

        $subject = "Réinitialisation de votre mot de passe";
        $body = "Cliquez sur le lien pour réinitialiser votre mot de passe : <a href=\"$resetLink\">Réinitialiser</a>";

        sendMail($email, $subject, $body); // Fonction définie dans mailer.php
    }

    echo "Si l'adresse existe, un lien a été envoyé.";
}
?>
