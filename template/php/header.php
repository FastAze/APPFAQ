<?php
    include 'ini.php';
?>
<header>
    <h1>
        <?php
            if (isset($_SESSION["username"])) {
                echo $_SESSION["username"];
            } else {
                echo "Utilisateur non connecté";
            }
            //echo $_SESSION["ligue"]; il manque le SQL pour afficher la ligue et le type d'utilisateur
        ?>
    </h1>
    <nav>
        <ul>
            <li><a href="/pages/php/list.php">Liste des questions</a></li>
            <li><a href="/pages/php/add.php">Ajouter une question</a></li>
            <li><a href="/pages/php/editmes.php">Modifier une question</a></li>
            <li><a href="/pages/php/editrep.php">Modifier une réponse</a></li>
            <li><a href="/pages/php/delete.php">Supprimer une question</a></li>
        </ul>
    </nav>
    <button class="floating-button" onclick="window.location.href='/pages/php/logout.php'">Déconnexion</button>
</header>