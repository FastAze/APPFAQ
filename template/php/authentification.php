<?php
/**
 * Fichier contenant les fonctions d'authentification et d'autorisation
 * pour l'application M2L
 */

if (!function_exists('getUserInfo')) {
    /**
     * Récupère les informations de l'utilisateur connecté
     * 
     * @param PDO $dbh Connexion à la base de données
     * @param string $username Nom d'utilisateur
     * @return array Informations de l'utilisateur
     */
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

if (!function_exists('isAdmin')) {
    /**
     * Vérifie si l'utilisateur est un super administrateur
     * 
     * @param string $userType Type d'utilisateur
     * @return bool True si l'utilisateur est un super administrateur
     */
    function isAdmin($userType) {
        return $userType === 'Admin';
    }
}

if (!function_exists('isModerator')) {
    /**
     * Vérifie si l'utilisateur est un administrateur de ligue
     * 
     * @param string $userType Type d'utilisateur
     * @return bool True si l'utilisateur est un administrateur de ligue
     */
    function isModerator($userType) {
        return $userType === 'Moderator';
    }
}

if (!function_exists('canEditMessage')) {
    /**
     * Vérifie si l'utilisateur peut modifier un message
     * 
     * @param array $userInfo Informations de l'utilisateur
     * @param int $messageLigueId ID de la ligue associée au message
     * @return bool True si l'utilisateur peut modifier le message
     */
    function canEditMessage($userInfo, $messageLigueId) {
        return isAdmin($userInfo['lib_usertype']) || 
        (isModerator($userInfo['lib_usertype']) && $userInfo['id_ligue'] == $messageLigueId);
    }
}

if (!function_exists('getMessageInfo')) {
    /**
     * Récupère les informations d'un message
     * 
     * @param PDO $dbh Connexion à la base de données
     * @param int $id_faq ID du message
     * @return array Informations du message
     */
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

if (!function_exists('getFaqMessages')) {
    /**
     * Récupère les messages de la FAQ en fonction du type d'utilisateur
     * 
     * @param PDO $dbh Connexion à la base de données
     * @param array $userInfo Informations de l'utilisateur
     * @return array Liste des messages
     */
    function getFaqMessages($dbh, $userInfo) {
        $userType = $userInfo['lib_usertype'];
        $userLigue = $userInfo['id_ligue'];
        
        // Requête SQL en fonction du type d'utilisateur
        if (isAdmin($userType)) { // Super Admin - toutes les ligues
            $sql = "SELECT faq.id_faq, user_.pseudo, faq.question, faq.reponse, ligue.lib_ligue, user_.id_ligue
                    FROM faq, user_, ligue
                    WHERE faq.id_user = user_.id_user
                    AND user_.id_ligue = ligue.id_ligue
                    ORDER BY faq.id_faq DESC";
            $sth = $dbh->prepare($sql);
        } else { // Moderator ou User - seulement leur ligue
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

if (!function_exists('redirectToLogin')) {
    /**
     * Redirige vers la page de connexion si l'utilisateur n'est pas connecté
     */
    function redirectToLogin() {
        if (!isset($_SESSION['username'])) {
            header('Location: login.php');
            exit();
        }
    }
}

if (!function_exists('checkAuthentication')) {
    /**
     * Vérifie si l'utilisateur est connecté et récupère ses informations
     * 
     * @param PDO $dbh Connexion à la base de données
     * @return array|null Informations de l'utilisateur ou null si non connecté
     */
    function checkAuthentication($dbh) {
        if (!isset($_SESSION['username'])) {
            return null;
        }
        
        return getUserInfo($dbh, $_SESSION['username']);
    }
}
?>