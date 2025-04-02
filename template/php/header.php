<?php
    // Inclusion des fichiers de configuration et de chemin
    include 'ini.php';
    include 'path.php';
    
    // Démarrage de la session
    session_start();
    
    // Définition du chemin racine et de l'URL de base
    $root_path = rtrim(str_replace('\\', '/', dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME'])))), '/');
    $base_url = rtrim(str_replace('\\', '/', dirname(dirname(dirname($_SERVER['PHP_SELF'])))), '/');
?>

<header class="header">
    <!-- Lien vers la page de liste -->
    <a class="logo" href="<?= $base_url ?>/pages/php/list.php">M2L</a>
    <h1>
        <?php
            // Vérification si l'utilisateur est connecté
            if(isset($_SESSION["username"])) {
                $username = $_SESSION["username"];
                
                // Connexion à la base de données
                $dbh = db_connect();
                
                // Requête SQL pour obtenir la ligue de l'utilisateur
                $sql = "SELECT lib_ligue
                        FROM ligue, user_
                        WHERE ligue.id_ligue = user_.id_ligue
                        AND user_.pseudo = :username";
                try {
                    // Préparation et exécution de la requête
                    $sth = $dbh->prepare($sql);
                    $sth->bindParam(':username', $username, PDO::PARAM_STR);
                    $sth->execute();
                    $userinfo = $sth->fetch(PDO::FETCH_ASSOC);
                    
                    // Affichage des informations de l'utilisateur
                    if($userinfo && isset($userinfo['lib_ligue'])) {
                        echo '<p>Connecté en tant que '. $username . ' de la ' . $userinfo['lib_ligue'] . '</p>';
                    } else {
                        echo '<p>Connecté en tant que '. $username . '</p>';
                    }
                } catch (PDOException $ex) {
                    // Gestion des erreurs SQL
                    die("Erreur lors de la requête SQL : " . $ex->getMessage());
                }
            }
        ?>
    </h1>
    
    <!-- Formulaire de déconnexion - Modification du traitement -->
    <form action="<?= $base_url ?>/pages/php/logout.php" method="POST">
        <button class="btn" type="submit" name="deco">Déconnexion</button>
    </form>
</header>