<?php
    include '../template/ini.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <div class="container">
        <h2>Inscription</h2>
        <form id="Inscription" action="register.php" method="POST">
            <label for="username">Nom d'utilisateur</label>
            <br>
            <input type="text" name="username" required>
            <br>
            <label for="ligue">Liste des ligue</label>
            <select name="ligue" required>
                <option value="liguefoot">Ligue de football</option>
                <option value="liguebasket">Ligue de basket</option>
                <option value="liguevolley">Ligue de volley</option>
                <option value="liguehandball">Ligue de handball</option>
                <option value="toutesligues">Toutes les ligues</option>
            </select>
            <br>
            <label for="email">Adresse e-mail</label>
            <br>
            <input type="email" name="email" required>
            <br>
            <label for="password">Mot de passe</label>
            <br>
            <input type="password" name="password" required>
            <br>
            <label for="password">Confirmer le mot de passe</label>
            <br>
            <input type="password" name="ppassword" required>
            <br>
            <div class="remember-me">
                <div class="left">
                    <input type="checkbox" id="souvenir"/>
                    <label for="souvenir">Se souvenir de moi</label>
                </div>
            </div>
            <button type="submit" name="inscrire">S'inscrire</button><!-- Avec le PHP, nous allons vérifier la création du compte et rediriger vers la page login.php-->
            <?php
                $MDP_H = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : '';
                if (isset($_POST['inscrire']))
                {
                    $_SESSION["username"] = $_POST['username'];
                    $_SESSION["password"] = $_POST['password'];
                    $_SESSION["ligue"] = $_POST['ligue'];
                    header('Location: list.php');
                    // ajouter la vérification de l'identifiant et du mot de passe
                }
                else
                {
                    echo "Identifiant ou mot de passe incorrect";
                }
            ?>
            <p>Vous avez un compte ?</p>
            <a href="login.php">login</a>
        </form>
    </div>    
    <?php
        include '../../template/php/footer.php';
    ?>
</body>
</html>