<?php
    $host = 'localhost';
    $dbname = 'm2l';
    $username = 'root';
    $password = '';
    $ligue = 'ligue';

    session_start();
    $_SESSION["username"] = $username;
    $_SESSION["password"] = $password;
    $_SESSION["ligue"] = $ligue;
?>