<?php
    include 'ini.php';
    include 'path.php';
    
    // Déterminer le chemin de base du site
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
    <nav class="navbar">
        <a href="<?= $base_url ?>/pages/php/list.php">Liste des questions</a>
        <a href="<?= $base_url ?>/pages/php/add.php">Ajouter une question</a>
        <a href="<?= $base_url ?>/pages/php/editmes.php">Modifier une question</a>
        <a href="<?= $base_url ?>/pages/php/editrep.php">Modifier une réponse</a>
        <a href="<?= $base_url ?>/pages/php/delete.php">Supprimer une question</a>
    </nav>
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