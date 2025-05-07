<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boutique</title>
</head>
<body>
    <?php
    $categories = include 'get_categories.php';
    ?>
    
    <?php foreach ($categories as $categorie): ?>
        <li><?= htmlspecialchars($categorie['nom']) ?></li>
    <?php endforeach; ?>

</body>
</html>