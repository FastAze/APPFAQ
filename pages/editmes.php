<?php
    include '../template/header.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le message</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <div class="container">
        <h2>Modifier le message</h2>
        <form action="#" method="post">
            <label for="message" class="test">Message</label>
            <br>
            <textarea name="message" id="message" placeholder="Message" rows="10" cols="60" style="resize: none;" required></textarea> <!-- Affiche le message à modifier avec le PHP-->
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