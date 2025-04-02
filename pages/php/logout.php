<?php
// Démarrage de la session si elle n'est pas déjà démarrée
session_start();

// Destruction des données de session
$_SESSION = array();

// Destruction du cookie de session si présent
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-42000, '/');
}

// Destruction de la session
session_destroy();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Déconnection</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <!-- Titre principal de l'application -->
    <h1 class="titel-appfaq">M2L</h1>
    <div class="container">
        <!-- Titre de la section de déconnexion -->
        <h2>Déconnexion</h2>
        <!-- Message de confirmation de déconnexion -->
        <p>Utilisateur, vous êtes bien déconnecté.</p>
        <!-- Lien pour revenir à la page d'accueil -->
        <p>Revenir à la page <a href="../../index.php">d'accueil</a>.</p>
    </div>

    <?php
        // Inclusion du pied de page
        include '../../template/php/footer.php';
    ?>
    
</body>
</html>