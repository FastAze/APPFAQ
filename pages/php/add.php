<?php
    include '../../template/php/header.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création d'un message</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <h1 class="titel-appfaq">M2L</h1>
    <div class="container">
        <h2>Ajouter une question</h2>
        <form action="#" method="post">
            <textarea name="message" placeholder="Entrez votre message" required></textarea>
            <br>
            <button class="btn" type="submit">Enregistrer</button><!-- Ajoute la question à la liste avec le PHP -->
            <button class="btn" onclick="window.location.href='list.php'">Annuler</button>
        </form>
    </div>
</body>
</html>
<?php
    include '../../template/php/footer.php';
?>