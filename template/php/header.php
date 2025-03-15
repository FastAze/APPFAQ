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
            $username = isset($_POST['username'])? $_POST['username'] : '';
            $dbh = db_connect();
                    $sql = "select lib_ligue
                    from ligue, user_
                    where ligue.id_ligue = user_.id_ligue
                    and user_.pseudo = '$username'";
                    try {
                    $sth = $dbh->prepare($sql);
                    $sth->execute();
                    $userinfo = $sth->fetch(PDO::FETCH_ASSOC);
                    } catch (PDOException $ex) {
                    die("Erreur lors de la requête SQL : " . $ex->getMessage());
                    }
                    echo '<p>Connecter en tant que '. $_SESSION["username"] . ' de la ' . $userinfo . '</p>';
        ?>
    </h1>
    <form action="<?= $base_url ?>/pages/php/logout.php" method="POST">
        <button class="btn" type="submit" name="deco">Déconnexion</button>
    </form>
    <?php
        if (isset($_POST['deco']))
        {
            session_destroy();
            header('Location: ' . $base_url . '/pages/php/logout.php');
        }
    ?>
</header>