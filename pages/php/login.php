<?php
    include '../../template/php/ini.php';
    session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <h1 class="titel-appfaq">M2L</h1>
    <div class="container">
        <h2>Connexion</h2>
        <form id="Connexion" action="login.php" method="POST">
            <label for="username">Pseudo</label>
            <br>
            <input type="text" id="username" name="username" required/>
            <br>
            <label for="password">Mot de passe</label>
            <br>
            <input type="password" id="password" name="password" required>
            <br>
            <button class="btn" type="submit" name="seco">Se connecter</button>
            <button type="button" class="btn" onclick="window.location.href='../../index.php'">Annuler</button><br>

            <?php
            // Vérifie si le formulaire a été soumis
            if (isset($_POST['seco'])) {
                // Récupère et sécurise les données du formulaire
                $username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '';
                $password = isset($_POST['password']) ? $_POST['password'] : '';

                // Vérifie si les champs ne sont pas vides
                if (!empty($username) && !empty($password)) {
                    // Connexion à la base de données
                    $dbh = db_connect();
                    
                    try {
                        // Prépare et exécute la requête SQL pour récupérer l'utilisateur
                        $sql = "SELECT pseudo, mdp FROM user_ WHERE pseudo = :username";
                        $sth = $dbh->prepare($sql);
                        $sth->bindParam(':username', $username, PDO::PARAM_STR);
                        $sth->execute();
                        $user = $sth->fetch(PDO::FETCH_ASSOC);
                        
                        // Vérifie si l'utilisateur existe et si le mot de passe est correct
                        if ($user && password_verify($password, $user['mdp'])) {
                            // Démarre la session utilisateur et redirige vers la page de liste
                            $_SESSION["username"] = $username;
                            header('Location: list.php');
                            exit();
                        } else {
                            // Affiche un message d'erreur si les identifiants sont incorrects
                            echo "<p style='color: red;'>Identifiant ou mot de passe incorrect</p>";
                        }
                    } catch (PDOException $ex) {
                        // Affiche un message d'erreur en cas de problème avec la requête SQL
                        die("Erreur lors de la récupération des informations utilisateur : " . $ex->getMessage()."<br>".$sql);
                    }
                }
            }
            ?>
            <a href="rest.php">mot de passe oublier ?</a>
            <p>Vous n'avez pas de compte : <a href="register.php">S'inscrire</a></p>
        </form>
    </div>

    <?php
        include '../../template/php/footer.php';
    ?>

</body>
</html>