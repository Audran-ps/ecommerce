<?php
require 'db.php';

if (!isset($_GET['token'])) {
    exit('Token manquant.');
}

$token = $_GET['token'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE reset_token = ? AND token_expire > NOW()");
$stmt->execute([$token]);
$user = $stmt->fetch();

if (!$user) {
    exit("Lien expiré ou invalide.");
}
?>

<form action="process_reset.php" method="post">
  <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
  <input type="password" name="password" placeholder="Nouveau mot de passe" required>
  <button type="submit">Mettre à jour</button>
</form>
