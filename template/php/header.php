<?php
    include 'ini.php';
    include 'path.php';
    
    $root_path = rtrim(str_replace('\\', '/', dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME'])))), '/');
    $base_url = rtrim(str_replace('\\', '/', dirname(dirname(dirname($_SERVER['PHP_SELF'])))), '/');
?>
<header class="header">
    <a class="logo" href="<?= $base_url ?>/pages/php/list.php">M2L</a>
    
    <!-- <h1>
        <?php
            if (isset($_SESSION["username"]))
            {
                echo '<p class="pseudo">',$_SESSION["username"],'</p>';
            }
            else
            {
                echo '<p class="pseudo">Utilisateur non connecté</p>';
            }
            //echo $_SESSION["ligue"]; il manque le SQL pour afficher la ligue et le type d'utilisateur
        ?>
    </h1> -->

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