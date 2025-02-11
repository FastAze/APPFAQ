<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialiser le Mot de passe</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <div class="container">
        <h2>Réinitialiser votre mot de passe</h2>
        <form id="Connexion" action="#" method="POST">
            <label for="mail">Adresse email</label><br>
            <input type="text" id="mail" name="mail"/><br>
            <button type="submit">Réinitialiser</button> <!-- Avec le PHP, nous allons vérifier l'adresse mail et envoyer un mail de réinitialisation-->
            <br>
            <br>
            <a href="login.php">Annuler</a>
        </form>
    </div>
</body>
</html>
<?php
    include '../template/footer.php';
?>