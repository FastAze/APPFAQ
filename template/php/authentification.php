<?php
/**
 * Fichier contenant les fonctions d'authentification et de gestion des droits
 * Ce module fournit les fonctionnalités nécessaires pour vérifier l'identité des utilisateurs,
 * leurs rôles et permissions dans l'application FAQ
 */

/**
 * Récupère les informations d'un utilisateur depuis la base de données
 * 
 * @param PDO $dbh La connexion à la base de données
 * @param string $username Le nom d'utilisateur à rechercher
 * @return array|false Les informations de l'utilisateur ou false si non trouvé
 */
if (!function_exists('getUserInfo')) {
    function getUserInfo($dbh, $username) {
        $userQuery = "SELECT user_.id_user, user_.id_ligue, usertype.id_usertype, usertype.lib_usertype 
                        FROM user_, usertype 
                        WHERE user_.id_usertype = usertype.id_usertype 
                        AND user_.pseudo = :username";
        
        try {
            $userStmt = $dbh->prepare($userQuery);
            $userStmt->bindParam(':username', $username, PDO::PARAM_STR);
            $userStmt->execute();
            return $userStmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            die("Erreur lors de la récupération des informations utilisateur : " . $ex->getMessage());
        }
    }
}

/**
 * Vérifie si un utilisateur possède le rôle d'administrateur
 * 
 * @param string $userType Le type d'utilisateur à vérifier
 * @return bool True si l'utilisateur est un admin, false sinon
 */
if (!function_exists('isAdmin')) {
    function isAdmin($userType) {
        return $userType === 'Admin';
    }
}

/**
 * Vérifie si un utilisateur possède le rôle de modérateur
 * 
 * @param string $userType Le type d'utilisateur à vérifier
 * @return bool True si l'utilisateur est un modérateur, false sinon
 */
if (!function_exists('isModerator')) {
    function isModerator($userType) {
        return $userType === 'Moderator';
    }
}

/**
 * Détermine si un utilisateur peut modifier un message spécifique
 * Un administrateur peut modifier tous les messages
 * Un modérateur peut uniquement modifier les messages de sa ligue
 * 
 * @param array $userInfo Les informations de l'utilisateur
 * @param int $messageLigueId L'ID de la ligue à laquelle appartient le message
 * @return bool True si l'utilisateur peut modifier le message, false sinon
 */
if (!function_exists('canEditMessage')) {
    function canEditMessage($userInfo, $messageLigueId) {
        return isAdmin($userInfo['lib_usertype']) || 
        (isModerator($userInfo['lib_usertype']) && $userInfo['id_ligue'] == $messageLigueId);
    }
}

/**
 * Récupère les informations complètes d'un message de la FAQ
 * 
 * @param PDO $dbh La connexion à la base de données
 * @param int $id_faq L'identifiant du message à récupérer
 * @return array|false Les informations du message ou false si non trouvé
 */
if (!function_exists('getMessageInfo')) {
    function getMessageInfo($dbh, $id_faq) {
        $sql = "SELECT faq.*, user_.id_ligue, ligue.lib_ligue
                FROM faq, user_, ligue
                WHERE faq.id_user = user_.id_user 
                AND user_.id_ligue = ligue.id_ligue
                AND faq.id_faq = :id_faq";
        
        try {
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':id_faq', $id_faq, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            die("Erreur lors de la récupération du message : " . $ex->getMessage());
        }
    }
}

/**
 * Récupère tous les messages de la FAQ selon les droits de l'utilisateur
 * Les administrateurs voient tous les messages
 * Les autres utilisateurs ne voient que les messages de leur ligue
 * 
 * @param PDO $dbh La connexion à la base de données
 * @param array $userInfo Les informations de l'utilisateur
 * @return array Tableau contenant les messages de la FAQ
 */
if (!function_exists('getFaqMessages')) {
    function getFaqMessages($dbh, $userInfo) {
        $userType = $userInfo['lib_usertype'];
        $userLigue = $userInfo['id_ligue'];
        
        if (isAdmin($userType)) {
            $sql = "SELECT faq.id_faq, user_.pseudo, faq.question, faq.reponse, ligue.lib_ligue, user_.id_ligue
                    FROM faq, user_, ligue
                    WHERE faq.id_user = user_.id_user
                    AND user_.id_ligue = ligue.id_ligue
                    ORDER BY faq.id_faq DESC";
            $sth = $dbh->prepare($sql);
        } else {
            $sql = "SELECT faq.id_faq, user_.pseudo, faq.question, faq.reponse, ligue.lib_ligue, user_.id_ligue
                    FROM faq, user_, ligue
                    WHERE faq.id_user = user_.id_user
                    AND user_.id_ligue = ligue.id_ligue
                    AND user_.id_ligue = :userLigue
                    ORDER BY faq.id_faq DESC";
            $sth = $dbh->prepare($sql);
            $sth->bindParam(':userLigue', $userLigue, PDO::PARAM_INT);
        }
        
        try {
            $sth->execute();
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            die("Erreur lors de la récupération des messages : " . $ex->getMessage());
        }
    }
}

/**
 * Redirige l'utilisateur vers la page de connexion s'il n'est pas authentifié
 * Vérifie si la variable de session username existe
 */
if (!function_exists('redirectToLogin')) {
    function redirectToLogin() {
        if (!isset($_SESSION['username'])) {
            header('Location: login.php');
            exit();
        }
    }
}

/**
 * Vérifie si l'utilisateur est authentifié et retourne ses informations
 * 
 * @param PDO $dbh La connexion à la base de données
 * @return array|null Les informations de l'utilisateur ou null s'il n'est pas connecté
 */
if (!function_exists('checkAuthentication')) {
    function checkAuthentication($dbh) {
        if (!isset($_SESSION['username'])) {
            return null;
        }
        
        return getUserInfo($dbh, $_SESSION['username']);
    }
}
?>