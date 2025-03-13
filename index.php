<?php
    include 'template/php/path.php';
?>
<?php
    include 'template/php/header.php'
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="<?= path ?>/pages/css/main.css">
</head>
<body>
    <h1 class="titel-appfaq">F.A.Q</h1>
    <div class="container">
        <h2>Bienvenue sur l'APP F.A.Q</h2>
        <p class="break-line">Vous avez des questions ?</p>
        <p>Nous avons des réponses !</p>
        <button class="btn" onclick="window.location.href='<?= path ?>/pages/php/login.php'">Connexion</button>
        <button class="btn" onclick="window.location.href='<?= path ?>/pages/php/register.php'">Inscription</button>
    </div>
    <?php
        include 'template/php/footer.php';
    ?>
</body>
</html>