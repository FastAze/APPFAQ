<?php
    // Inclusion du fichier de configuration
    include '../../template/php/ini.php';
    // Démarrage de la session
    session_start();
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
    <h1 class="titel-appfaq">M2L</h1>
    <div class="container">
        <h2>Inscription</h2>
        <!-- Formulaire d'inscription -->
        <form id="Inscription" action="register.php" method="POST">
            <label for="username">Pseudo</label>
            <br>
            <input type="text" name="username" required>
            <br>
            <label for="email">Email</label>
            <br>
            <input type="email" name="email" required>
            <br>
            <label for="password">Mot de passe</label>
            <br>
            <input type="password" name="password" required>
            <br>
            <label for="ligue">Ligue</label>
            <br>
            <select name="ligue" required>
                <option value="liguefoot">Ligue de football</option>
                <option value="liguebasket">Ligue de basket</option>
                <option value="liguevolley">Ligue de volley</option>
                <option value="liguehandball">Ligue de handball</option>
                <option value="toutesligues">Toutes les ligues</option>
            </select>
            <br>
            <button class="btn" type="submit" name="inscrire">S'inscrire</button>
            <button type="button" class="btn" onclick="window.location.href='../../index.php'">Annuler</button>

            <?php
                // Récupération et hachage du mot de passe
                $MDP_H = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : '';
                // Récupération des autres champs du formulaire
                $username = isset($_POST['username'])? $_POST['username'] : '';
                $email = isset($_POST['email'])? $_POST['email'] : '';
                $ligue = isset($_POST['ligue'])? $_POST['ligue'] : '';

                // Détermination de l'ID de la ligue
                $id_ligue = 1;
                switch($ligue) {
                    case 'liguefoot':
                        $id_ligue = 1;
                        break;
                    case 'liguebasket':
                        $id_ligue = 2;
                        break;
                    case 'liguevolley':
                        $id_ligue = 3;
                        break;
                    case 'liguehandball':
                        $id_ligue = 4;
                        break;
                    default:
                        $id_ligue = 5;
                }

                // Si le formulaire est soumis
                if (isset($_POST['inscrire'])) {
                    // Connexion à la base de données
                    $dbh = db_connect();
                    // Requête d'insertion de l'utilisateur
                    $sql = "insert into user_ (pseudo, mail, mdp, id_ligue, id_usertype) values ('$username', '$email', '$MDP_H', '$id_ligue', 3)";
                    try {
                        // Préparation et exécution de la requête
                        $sth = $dbh->prepare($sql);
                        $sth->execute();
                    } catch (PDOException $ex) {
                        // Gestion des erreurs
                        die("Erreur lors de la requête SQL : " . $ex->getMessage());
                    }
                    // Redirection vers la liste des utilisateurs
                    header('Location: list.php');
                }
            ?>

        </form>
        <p>Vous n'avez deja un compte : <a href="login.php">Se connecter</a></p>
    </div>

    <?php
        // Inclusion du pied de page
        include '../../template/php/footer.php';
    ?>
    
</body>
</html>