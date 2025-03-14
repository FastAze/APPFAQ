<?php
    include '../../template/php/header.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout d'une question</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <h1 class="titel-appfaq">M2L</h1>
    <div class="container">
        <h2>Ajouter une question :</h2>
        <form action="add.php" method="post">
            <?php
                if (isset($_POST['register']))
                {
                    header('Location: ./list.php');
                }
            ?>
            <textarea name="question" placeholder="Question" rows="10" cols="60" style="resize: none;" required></textarea>
            <br>
            <button class="btn" type="submit" name="register">Enregistrer</button><!-- Ajoute la question à la liste avec le PHP -->
            <button class="btn" onclick="window.location.href='./list.php'">Annuler</button>
        </form>
    </div>
</body>
</html>
<?php
    include '../../template/php/footer.php';
?>