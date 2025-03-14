<?php
    include '../../template/php/ini.php';
    include '../../template/php/header.php';
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
        $dbh = db_connect();
        $sql = "select id_faq, pseudo, question, reponse
        from faq, user_
        where faq.id_user = user_.id_user";
        try {
        $sth = $dbh->prepare($sql);
        $sth->execute();
        $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
        die("Erreur lors de la requête SQL : " . $ex->getMessage());
        }

        echo "<table>";
        echo "<tr>";
        echo "<th>NR</th>";
        echo "<th>Auteur</th>";
        echo "<th>Question</th>";
        echo "<th>Réponse</th>";
        echo "<th>Actions</th>";
        echo "</tr>";

        foreach ($rows as $row) {
            echo "<tr>";
            echo "<td>" . $row['id_faq'] . "</td>";
            echo "<td>" . $row['pseudo'] . "</td>";
            echo "<td>" . $row['question'] . "</td>";
            echo "<td>" . $row['reponse'] . "</td>";
            echo "<td><a href='edit.php?id_faq=" . $row['id_faq'] . "'>Modifier</a> | <a href='delete.php?id_faq=" . $row['id_faq'] . "'>Supprimer</a></td>";
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