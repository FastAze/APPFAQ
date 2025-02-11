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
        <label for="réponses">Réponses</label>
        <p></p>
        <textarea name="réponses" id="réponses" placeholder="Réponses" rows="10" cols="60" style="resize: none;"></textarea>
        <p></p>
        <p></p>
        <button onclick="window.location.href='(PLACE HOLDER)'">Comfirmer les changement</button>
    </div>
</body>
</html>
<?php
    include '../template/footer.php';
?>