<?php
    include '../../template/php/ini.php';
    session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reset MDP</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <h1 class="titel-appfaq">M2L</h1>
    <div class="container">
        <h2>REST MDP</h2>
        <form id="rest" action="rest.php" method="POST">
            <label for="email">Email</label>
            <br>
            <input type="email" name="email" required>
            <br>
            <label for="password">Nouveau mot de passe</label>
            <br>
            <input type="password" id="password" name="password" required>
            <br>
            <label for="confPassword">confirmer le mot de passe</label>
            <br>
            <input type="password" id="confPassword" name="confPassword" required>
            <br>
            <button class="btn" type="submit" name="rest">Réinisialiser</button>
            <button type="button" class="btn" onclick="window.location.href='../../index.php'">Annuler</button>

            <?php
            // Vérifie si le formulaire a été soumis
            if (isset($_POST['rest'])) {
                // Récupère et sécurise les données du formulaire
                $mail = isset($_POST['email']) ? $_POST['email'] : ''; 
                $password = isset($_POST['password']) ? $_POST['password'] : '';
                $MDP_H = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : '';
                $confPassword = isset($_POST['confPassword']) ? $_POST['confPassword'] : '';

                // Vérifie si les champs ne sont pas vides
                if (!empty($mail) && !empty($password) && !empty($confPassword)) {
                    if ($password === $confPassword) {
                        // Connexion à la base de données
                        $dbh = db_connect();
                        
                        $sql = "UPDATE user_ SET mdp = :password WHERE mail = :email";
                        try {
                            $sth = $dbh->prepare($sql);
                            $sth->execute(array(
                            ':password' => $MDP_H,
                            ':email' => $mail
                            ));
                            echo '<p class="success">mot de pas bien rest c cool</p>';
                        } catch ( PDOException $ex) {
                            die("Erreur lors de la requête SQL : ".$ex->getMessage());
                        }
                    } else {
                        echo '<p class="error">les mot de pase son pas corect (pas biens mec)</p>';
                    }
                }
            }
            ?>
        </form>
    </div>

    <?php
        include '../../template/php/footer.php';
    ?>

</body>
</html>