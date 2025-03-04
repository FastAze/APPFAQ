<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="/pages/css/main.css">
</head>
<body>
    <h1 id="titre-faq">F.A.Q</h1>
    <div class="container">
        <h2>Bienvenue sur l'APP F.A.Q</h2>
        <p>Vous avez des questions ?</p>
        <br>
        <br>
        <p>Nous avons des réponses !</p>
        <br>
        <button onclick="window.location.href='/pages/php/login.php'">Connexion</button>
        <br>
        <button onclick="window.location.href='/pages/php/register.php'">Inscription</button>
        <br>
    </div>
    <?php
        include 'template/php/footer.php';
    ?>
</body>
</html>