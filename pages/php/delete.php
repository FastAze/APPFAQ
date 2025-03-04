<?php
    include '../template/header.php';
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
    <div class="container">
        <h2>Supprimer un message</h2>
        <form action="#" method="post">
            <!-- Avec le PHP, nous allons afficher les questions des utilisateurs et une checkbox pour les sélectionner. -->
            <button type="submit">Supprimer</button><!-- Supprime la question de la liste avec le PHP -->
        </form>
        <button type="button" class="cancel-btn" onclick="window.location.href='list.php'">Annuler</button>
    </div> 
</body>
</html>
<?php
    include '../template/footer.php';
?>