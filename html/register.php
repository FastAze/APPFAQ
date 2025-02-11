<?php
    include '../template/header.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>
    <div class="container">
        <h2>Inscription</h2>
        <form id="Inscription" action="#" method="POST">
            <label for="username">Nom d'utilisateur</label><br>
            <input type="text" id="username" name="username"/><br>

            <select name="ligue" id="ligue">
                <option value="liguefoot">Ligue de football</option>
                <option value="liguebasket">Ligue de basket</option>
                <option value="liguevolley">Ligue de volley</option>
                <option value="liguehandball">Ligue de handball</option>
                <option value="toutesligues">Toutes les ligues</option>
            
            <label for="email">Adresse e-mail</label><br>
            <input type="email" id="email" name="email"><br>
            
            <label for="password">Mot de passe</label><br>
            <input type="password" id="password" name="password" required><br>
            
            <label for="ppassword">Confirmer le mot de passe</label><br>
            <input type="password" id="ppassword" name="ppassword" required><br>

            <div class="remember-me">
                <div class="left">
                    <input type="checkbox" id="souvenir"/>
                    <label for="souvenir">Se souvenir de moi</label>
                </div>

            </div>

            <button type="submit">Se connecter</button>

            <a>Vous avez un compte ?</a>
            <a href="/html/login.html">login</a>
        </form>
    </div>
</body>
</html>
<?php
    include '../template/footer.php';
?>
