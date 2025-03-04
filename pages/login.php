<?php
    include '../template/ini.php';
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
    <div class="container">
        <h2>Connexion</h2>
        <form id="Connexion" action="login.php" method="POST">
            <label for="username">Identifiant</label>
            <br>
            <input type="text" id="username" name="username" required/>
            <br>
            <label for="password">Mot de passe</label>
            <br>
            <input type="password" id="password" name="password" required>
            <br>
            <div class="remember-me">
                <div class="left">
                    <input type="checkbox" id="souvenir"/>
                    <label for="souvenir">Se souvenir de moi</label>
                </div>
            </div>
            <button type="submit" name="seco">Se connecter</button>
            <?php
                if (isset($_POST['seco']))
                {
                    $_SESSION["username"] = $_post['username'];
                    $_SESSION["password"] = $_post['password'];
                    $_SESSION["ligue"] = $ligue;
                    header('Location: list.php');
                    // ajouter la vérification de l'identifiant et du mot de passe
                }
                else
                {
                    echo "Identifiant ou mot de passe incorrect";
                }
            ?>
            <br>
            <br>
            <div class="inline">
                <p>Vous ne vous souvenez plus de votre mot de passe ?</p>
                <a href="resetpswd.php">Réinitialiser le mot de passe</a>
            </div>
            <br>
            <p>Vous n'avez pas de compte ?</p>
            <a href="register.php">S'inscrire</a>
        </form>
    </div>
</body>
</html>
<?php
    include '../template/footer.php';
?>