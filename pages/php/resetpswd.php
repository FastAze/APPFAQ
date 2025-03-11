<?php
    include 'test.php';
?>
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
            <label for="mail">Adresse email</label>
            <br>
            <input type="email" id="mail" name="mail" required>
            <br>
            <button type="submit">Réinitialiser</button> <!-- Avec le PHP, nous allons vérifier l'adresse mail et envoyer un mail de réinitialisation-->
            <br>
        </form>
        <button type="button" class="cancel-btn" onclick="window.location.href='login.php'">Annuler</button>
    </div>
</body>
</html>
<?php
    include '../../template/php/footer.php';
?>