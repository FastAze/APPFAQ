<?php
    // Inclusion des fichiers nécessaires
    include '../../template/php/ini.php';
    include '../../template/php/header.php';
    include '../../template/php/authentification.php';
    
    // Connexion à la base de données
    $dbh = db_connect();
    
    // Redirection vers la page de connexion si l'utilisateur n'est pas authentifié
    redirectToLogin();
    
    // Récupération des informations de l'utilisateur connecté
    $userInfo = getUserInfo($dbh, $_SESSION["username"]);
    $userType = $userInfo['lib_usertype'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Liste des questions</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <h1 class="titel-appfaq">M2L</h1>
    <div class="container">
    <h2>Liste des questions</h2>

    <?php
        // Récupération des messages de la FAQ
        $rows = getFaqMessages($dbh, $userInfo);
        
        // Affichage du tableau des questions
        echo "<table>";
        echo "<tr>";
        echo "<th>NR</th>";
        echo "<th>Auteur</th>";
        echo "<th>Question</th>";
        echo "<th>Réponse</th>";
        echo "<th>Ligue</th>";
        // Affichage de la colonne Actions si l'utilisateur est admin ou modérateur
        if (isAdmin($userType) || isModerator($userType)) {
            echo "<th>Actions</th>";
        }
        echo "</tr>";

        // Boucle pour afficher chaque question
        foreach ($rows as $row) {
            echo "<tr>";
            echo "<td>" . $row['id_faq'] . "</td>";
            echo "<td>" . $row['pseudo'] . "</td>";
            echo "<td>" . $row['question'] . "</td>";
            echo "<td>" . $row['reponse'] . "</td>";
            echo "<td>" . $row['lib_ligue'] . "</td>";
            
            // Affichage des liens de modification et suppression si l'utilisateur peut éditer le message
            if (canEditMessage($userInfo, $row['id_ligue'])) {
                echo "<td><div class='action-links'>";
                echo "<a href='edit.php?id_faq=" . $row['id_faq'] . "'>Modifier</a>";
                echo "<a href='delete.php?id_faq=" . $row['id_faq'] . "'>Supprimer</a>";
                echo "</div></td>";
            } elseif (isModerator($userType)) {
                echo "<td>Pas autorisé</td>";
            }
            echo "</tr>";
        }
        
        echo "</table>";
    ?>

    <!-- Lien pour ajouter une nouvelle question -->
    <a href="add.php">Ajouter une question</a>
    </div>

    <?php
        // Inclusion du pied de page
        include '../../template/php/footer.php';
    ?>

</body>
</html>
