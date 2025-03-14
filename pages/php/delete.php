<?php
    include '../../template/php/header.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppression d'un message</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
<h1 class="titel-appfaq">M2L</h1>
    <div class="container">
        <h2>Supprimer une question</h2>
        <form action="#" method="post">
            <label for="question">Question</label>
            <br>
            <textarea name="question" id="question" placeholder="question" rows="10" cols="60" style="resize: none;" required></textarea> <!-- Affiche le message à modifier avec le PHP-->
            <br>
            <label for="réponses">Réponses</label>
            <br>
            <textarea name="réponses" id="réponses" placeholder="Réponses" rows="10" cols="60" style="resize: none;" required></textarea> <!-- Affiche la réponse à modifier avec le PHP-->
            <br>
            <button class="btn" type="submit">Supprimer</button>
            <button type="button" class="btn" onclick="window.location.href='list.php'">Annuler</button>
        </form>
    </div>
</body>
</html>
<?php
    include '../../template/php/footer.php';
?>