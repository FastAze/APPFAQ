<?php
    include '../../template/php/header.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit message</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <div class="container">
        <h2>Modifier la réponse</h2>
        <form action="#" method="post">
            <textarea name="réponses" id="réponses" placeholder="Réponses" rows="10" cols="60" style="resize: none;" required></textarea> <!-- Affiche la réponse à modifier avec le PHP-->
            <br>
            <button class="btn" type="submit">Enregistrer</button>
        </form>
        <button type="button" class="btn" onclick="window.location.href='list.php'">Annuler</button>
    </div>
</body>
</html>
<?php
    include '../../template/php/footer.php';
?>