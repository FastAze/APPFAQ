<?php
    // Inclusion du fichier d'en-tête
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
        <!-- Formulaire pour ajouter une question -->
        <form action="add.php" method="post">
            <textarea name="question" placeholder="Question" rows="10" cols="60" style="resize: none;" required></textarea>
            <br>
            <button class="btn" type="submit" name="register">Enregistrer</button>
            <button type="button" class="btn" onclick="window.location.href='./list.php'">Annuler</button>
        </form>
        <?php
            // Vérification si le formulaire a été soumis
            if (isset($_POST['question']) ) {
                // Récupération et sécurisation de la question
                $question = htmlspecialchars($_POST['question']);
                $currentDate = date('Y-m-d H:i:s');
                $username = $_SESSION["username"];

                // Connexion à la base de données
                $dbh = db_connect();
                // Requête pour obtenir l'ID de l'utilisateur
                $sql = "SELECT id_user FROM user_ WHERE pseudo = '$username'";
                try {
                    $sth = $dbh->prepare($sql);
                    $sth->execute();
                    $user = $sth->fetch(PDO::FETCH_ASSOC);
                    
                    if ($user) {
                        // Si l'utilisateur est trouvé, insertion de la question dans la base de données
                        $userId = $user['id_user'];
                        $insertSql = "INSERT INTO faq (question, dat_question, id_user) 
                                    VALUES ('$question', '$currentDate', '$userId')";
                        $stmt = $dbh->prepare($insertSql);
                        $stmt->execute();
                        
                        // Redirection vers la liste des questions après l'insertion
                        header('Location: list.php');
                        exit();
                    } else {
                        // Message d'erreur si l'utilisateur n'est pas trouvé
                        echo '<p style="color: red;">Erreur : Utilisateur non trouvé.</p>';
                    }
                } catch (PDOException $ex) {
                    // Gestion des erreurs SQL
                    die("Erreur lors de la requête SQL : " . $ex->getMessage());
                }
            }
        ?>
    </div>
</body>
</html>
<?php
    // Inclusion du fichier de pied de page
    include '../../template/php/footer.php';
?>