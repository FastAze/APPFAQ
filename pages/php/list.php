<?php
    include '../../template/php/ini.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Liste des questions</title>
    <link rel="stylesheet" href="../css/main.css">
    <style>
        body {
            display: block;
        }
    </style>
</head>
<body>
    <?php
        include '../../template/php/header.php';
    ?>
    <div class="mid">
        <div class="faq">
            <button class="question">FAQ</button>
            <div class="reponse">
                <p>Reponse</p>
                <!-- Ajout des FAQ et de leurs réponses avec le PHP -->
                <p>
                    <input class="reponse-btn"  type="button" id="repondre" name="repondre" value="Répondre"/> <!-- Avec ce bouton on pourra afficher la réponse à la question -->
                </p>
            </div>
        </div>
    </div>
    <?php
        include '../../template/php/footer.php';
    ?>
</body>
</html>