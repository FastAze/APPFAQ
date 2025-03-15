<?php
    include '../../template/php/ini.php';
    include '../../template/php/header.php';
    include '../../template/php/authentification.php';
    
    $dbh = db_connect();
    
    // Vérifier si l'utilisateur est connecté
    redirectToLogin();
    
    // Récupérer les informations de l'utilisateur
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
        // Récupérer la liste des messages
        $rows = getFaqMessages($dbh, $userInfo);
        
        echo "<table>";
        echo "<tr>";
        echo "<th>NR</th>";
        echo "<th>Auteur</th>";
        echo "<th>Question</th>";
        echo "<th>Réponse</th>";
        echo "<th>Ligue</th>";
        // N'afficher la colonne Actions que pour les utilisateurs autorisés
        if (isAdmin($userType) || isModerator($userType)) {
            echo "<th>Actions</th>";
        }
        echo "</tr>";

        foreach ($rows as $row) {
            echo "<tr>";
            echo "<td>" . $row['id_faq'] . "</td>";
            echo "<td>" . $row['pseudo'] . "</td>";
            echo "<td>" . $row['question'] . "</td>";
            echo "<td>" . $row['reponse'] . "</td>";
            echo "<td>" . $row['lib_ligue'] . "</td>";
            
            // Afficher les actions uniquement pour les admins/modérateurs autorisés
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

    <a href="add.php">Ajouter une question</a>
    </div>

    <?php
        include '../../template/php/footer.php';
    ?>

</body>
</html>