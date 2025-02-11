<?php
    include '../template/header.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connection</title>
    <link rel="stylesheet" href="../css/main.css">
</head>

<body>
    <div class="signup-container">
        <h2>Connexion</h2>
        <form id="Connexion" action="login.html" method="POST">
            <label for="username">Identifiant</label><br>
            <input type="text" id="username" name="username"/><br>
            
            <label for="password">Mot de passe</label><br>
            <input type="password" id="password" name="password"><br>
            
            <div class="remember-me">
                <div class="left">
                    <input type="checkbox" id="souvenir"/>
                    <label for="souvenir">Se souvenir de moi</label>
                </div>
            </div>

            <button type="submit">Se connecter</button>
            <br>
            <br>
                <a>Vous n'avez pas de compte ?</a>
                <a href="/html/register.html">S'inscrire</a>
        </form>
    </div>
</body>
</html>
<?php
    include '../template/footer.php';
?>

