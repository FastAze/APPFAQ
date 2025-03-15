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
            <textarea name="question" placeholder="Question" rows="10" cols="60" style="resize: none;" required></textarea>
            <br>
            <button class="btn" type="submit" name="register">Enregistrer</button>
            <button type="button" class="btn" onclick="window.location.href='./list.php'">Annuler</button>
        </form>
        <?php
                if (isset($_POST['question']) ) {
                    $question = htmlspecialchars($_POST['question']);
                    $currentDate = date('Y-m-d H:i:s');
                    $username = $_SESSION["username"];

                    $dbh = db_connect();
                    $sql = "SELECT id_user FROM user_ WHERE pseudo = '$username'";
                    try {
                        $sth = $dbh->prepare($sql);
                        $sth->execute();
                        $user = $sth->fetch(PDO::FETCH_ASSOC);
                        
                        if ($user) {
                            $userId = $user['id_user'];
                            
                            // Insérer la nouvelle question
                            $insertSql = "INSERT INTO faq (question, dat_question, id_user) 
                                        VALUES ('$question', '$currentDate', '$userId')";
                            $stmt = $dbh->prepare($insertSql);
                            $stmt->execute();
                            
                            header('Location: list.php');
                            exit();
                        } else {
                            echo '<p style="color: red;">Erreur : Utilisateur non trouvé.</p>';
                        }
                    } catch (PDOException $ex) {
                        die("Erreur lors de la requête SQL : " . $ex->getMessage());
                    }
                }
            ?>
    </div>
</body>
</html>
<?php
    include '../../template/php/footer.php';
?>