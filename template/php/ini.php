<?php
    /**
    * Connexion à la base de données
    *
    * @return PDO objet de connexion
    */
    function db_connect()
    {
        $dsn = 'mysql:host=localhost;dbname=m2l';  // contient le nom du serveur et de la base
        $user = 'root';
        $password = '';

        try
        {
            $dbh = new PDO($dsn, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        
        catch (PDOException $ex)
        {
            die("Erreur lors de la connexion SQL : " . $ex->getMessage());
        }
        return $dbh;
    }

    session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
?>