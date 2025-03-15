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
            <button type="button" class="btn" onclick="window.location.href='../../index.php'">Annuler</button>
            <?php
            $username = isset($_POST['username'])? $_POST['username'] : '';
            $password = isset($_POST['password'])? $_POST['password'] : '';
                if (isset($_POST['seco']))
                {
                    $dbh = db_connect();
                    $sql = "select pseudo, mdp
                            from user_
                            where pseudo = '$username' 
                            and mdp = '$password'";
                    try {
                    $sth = $dbh->prepare($sql);
                    $sth->execute();
                    $rows = $sth->fetch(PDO::FETCH_ASSOC);
                    if ($rows['pseudo'] == $username && $rows['mdp'] == $password) {
                        $_SESSION["username"] = $_POST['username'];
                        $_SESSION["password"] = $_POST['password'];
                        header('Location: list.php');
                    } else {
                        echo "Identifiant ou mot de passe incorrect";
                    }
                    } 
                    catch (PDOException $ex) {
                    die("Erreur lors de la requête SQL : " . $ex->getMessage());
                    }
                }
            ?>
            <p>Vous n'avez pas de compte : <a href="register.php">S'inscrire</a></p>
        </form>
        </div>
    <?php
        include '../../template/php/footer.php';
    ?>
</body>
</html>