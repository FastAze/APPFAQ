<?php
    include '../template/header.php';
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
            <label for="réponses">Réponses</label>
            <br>
            <textarea name="réponses" id="réponses" placeholder="Réponses" rows="10" cols="60" style="resize: none;" required></textarea> <!-- Affiche la réponse à modifier avec le PHP-->
            <br>
            <button type="submit">Confirmer les changements</button>
        </form>
        <button type="button" class="cancel-btn" onclick="window.location.href='list.php'">Annuler</button>
    </div>
</body>
</html>
<?php
    include '../template/footer.php';
?>