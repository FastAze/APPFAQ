<?php

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

if (!function_exists('isAdmin')) {
    function isAdmin($userType) {
        return $userType === 'Admin';
    }
}

if (!function_exists('isModerator')) {
    function isModerator($userType) {
        return $userType === 'Moderator';
    }
}

if (!function_exists('canEditMessage')) {
    function canEditMessage($userInfo, $messageLigueId) {
        return isAdmin($userInfo['lib_usertype']) || 
        (isModerator($userInfo['lib_usertype']) && $userInfo['id_ligue'] == $messageLigueId);
    }
}

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

if (!function_exists('redirectToLogin')) {
    function redirectToLogin() {
        if (!isset($_SESSION['username'])) {
            header('Location: login.php');
            exit();
        }
    }
}

if (!function_exists('checkAuthentication')) {
    function checkAuthentication($dbh) {
        if (!isset($_SESSION['username'])) {
            return null;
        }
        
        return getUserInfo($dbh, $_SESSION['username']);
    }
}
?>
