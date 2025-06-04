<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];

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

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        $token = bin2hex(random_bytes(32));
        $expires = date('Y-m-d H:i:s', strtotime('+1 hour'));

        $stmt = $pdo->prepare("UPDATE users SET reset_token = ?, token_expire = ? WHERE email = ?");
        $stmt->execute([$token, $expires, $email]);

        $resetLink = "http://localhost/ecommerce/vue/conection.php?token=" . $token;

        // ENVOI EMAIL
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'paysaudran@gmail.com';
            $mail->Password   = 'ibom vaod cibr mkvj';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            $mail->setFrom('paysaudran@gmail.com', 'Nanos');
            $mail->addAddress($email, $user['username'] . ' ' . $user['name']);

            $mail->isHTML(true);
            $mail->Subject = "Réinitialisation de votre mot de passe";
            $mail->Body    = "
                <h2>Réinitialisation demandée</h2>
                <p>Bonjour {$user['username']},</p>
                <p>Cliquez sur le lien suivant pour réinitialiser votre mot de passe :</p>
                <p><a href=\"$resetLink\">Réinitialiser mon mot de passe</a></p>
                <p>Ce lien est valable 1 heure.</p>
            ";

            $mail->send();
        } catch (Exception $e) {
            echo "⚠️ L'email n'a pas pu être envoyé : {$mail->ErrorInfo}";
        }
    }

    echo "✅ Si l'adresse existe, un lien a été envoyé.";
}
?>
