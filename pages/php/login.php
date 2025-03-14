<?php
    include '../../template/php/ini.php';
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
            <button type="button" class="btn" onclick="window.location.href='list.php'">Annuler</button>
            <?php
                if (isset($_POST['seco']))
                {

                    // Vérifiez les identifiants ici
                    // Si les identifiants sont corrects, définissez les variables de session
                    $_SESSION["username"] = $_POST['username'];
                    $_SESSION["password"] = $_POST['password'];
                    header('Location: list.php');
                }
                else
                {
                    // echo "Identifiant ou mot de passe incorrect";
                }
            ?>
            <p>Vous n'avez pas de compte ?</p>
            <a href="register.php">S'inscrire</a>
        </form>
    </div>
    <?php
        include '../../template/php/footer.php';
    ?>
</body>
</html>