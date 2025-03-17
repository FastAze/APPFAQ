<?php
    include '../../template/php/ini.php';
    include '../../template/php/header.php';
    include '../../template/php/authentification.php';
    
    $dbh = db_connect();
    
    redirectToLogin();
    
    $userInfo = getUserInfo($dbh, $_SESSION["username"]);
    
    if (isset($_GET['id_faq'])) {
        $id_faq = $_GET['id_faq'];
        $question = getMessageInfo($dbh, $id_faq);
        
        $canDelete = canEditMessage($userInfo, $question['id_ligue']);
    }
    
    if (isset($_POST['delete'])) {
        $id_faq = $_POST['id_faq'];
        
        $checkQuestion = getMessageInfo($dbh, $id_faq);
        $canDelete = canEditMessage($userInfo, $checkQuestion['id_ligue']);
        
        if ($canDelete) {
            $deleteSql = "DELETE FROM faq WHERE id_faq = :id_faq";
            $deleteStmt = $dbh->prepare($deleteSql);
            $deleteStmt->bindParam(':id_faq', $id_faq, PDO::PARAM_INT);
            $deleteStmt->execute();
            header('Location: list.php');
            exit();
        } else {
            $errorMsg = "Vous n'avez pas les droits nécessaires pour supprimer cette question.";
        }
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppression d'un message</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
<h1 class="titel-appfaq">M2L</h1>
    <div class="container">
        <h2>Supprimer une question</h2>
        <?php if (isset($canDelete) && $canDelete): ?>
            <form action="delete.php" method="post">
                <input type="hidden" name="id_faq" value="<?php echo $id_faq; ?>">
                <label for="question">Question :</label>
                <br>
                <textarea name="question" rows="10" cols="60" style="resize: none;" readonly><?php echo $question['question']; ?></textarea>
                <br>
                <label for="reponse">Réponse :</label>
                <br>
                <textarea name="reponse" rows="10" cols="60" style="resize: none;" readonly><?php echo $question['reponse']; ?></textarea>
                <br>
                <button class="btn" name="delete" type="submit">Supprimer</button>
                <button type="button" class="btn" onclick="window.location.href='./list.php'">Annuler</button>
            </form>
        <?php else: ?>
            <p>Vous n'avez pas les droits nécessaires pour supprimer cette question ou la question n'existe pas.</p>
            <button type="button" class="btn" onclick="window.location.href='./list.php'">Retour à la liste</button>
        <?php endif; ?>
        
        <?php if (isset($errorMsg)): ?>
            <p style="color: red;"><?php echo $errorMsg; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
<?php
    include '../../template/php/footer.php';
?>
