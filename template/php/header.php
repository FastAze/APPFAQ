<?php
    include 'ini.php';
    include 'path.php';
    session_start();
    $root_path = rtrim(str_replace('\\', '/', dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME'])))), '/');
    $base_url = rtrim(str_replace('\\', '/', dirname(dirname(dirname($_SERVER['PHP_SELF'])))), '/');
?>

<header class="header">
<a class="logo" href="<?= $base_url ?>/pages/php/list.php">M2L</a>
    <h1>

        <?php
            if(isset($_SESSION["username"])) {
                $username = $_SESSION["username"];
                $dbh = db_connect();
                $sql = "SELECT lib_ligue
                        FROM ligue, user_
                        WHERE ligue.id_ligue = user_.id_ligue
                        AND user_.pseudo = :username";
                try {
                    $sth = $dbh->prepare($sql);
                    $sth->bindParam(':username', $username, PDO::PARAM_STR);
                    $sth->execute();
                    $userinfo = $sth->fetch(PDO::FETCH_ASSOC);
                    
                    if($userinfo && isset($userinfo['lib_ligue'])) {
                        echo '<p>Connecté en tant que '. $username . ' de la ' . $userinfo['lib_ligue'] . '</p>';
                    } else {
                        echo '<p>Connecté en tant que '. $username . '</p>';
                    }
                } catch (PDOException $ex) {
                    die("Erreur lors de la requête SQL : " . $ex->getMessage());
                }
            }
        ?>

    </h1>
    <form action="<?= $base_url ?>/pages/php/logout.php" method="POST">
        <button class="btn" type="submit" name="deco">Déconnexion</button>
    </form>

    <?php
        if (isset($_POST['deco']))
        {
            session_start();
            session_unset();
            session_destroy();
            setcookie(session_name(),"",time()-3600);
            header('Location: ' . $base_url . '/pages/php/logout.php');
        }
    ?>

</header>