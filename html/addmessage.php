<?php
    include '../template/header.php';
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
    <div class="container">
        <h2>Ajouter une question</h2>
        <textarea placeholder="Entrez votre message" required></textarea>
        <button>Enregistrer</button>
        <button class="cancel-btn" onclick="window.location.href='appfaq.php'">Annuler</button>
    </div>
</body>
</html>

<?php
    include '../template/footer.php';
?>