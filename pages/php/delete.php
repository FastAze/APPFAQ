<?php
    // Inclusion des fichiers nécessaires
    include '../../template/php/ini.php';
    include '../../template/php/header.php';
    include '../../template/php/authentification.php';
    
    // Connexion à la base de données
    $dbh = db_connect();
    
    // Redirection vers la page de connexion si l'utilisateur n'est pas authentifié
    redirectToLogin();
    
    // Récupération des informations de l'utilisateur connecté
    $userInfo = getUserInfo($dbh, $_SESSION["username"]);
    
    // Vérification si l'ID de la FAQ est passé en paramètre GET
    if (isset($_GET['id_faq'])) {
        $id_faq = $_GET['id_faq'];
        // Récupération des informations de la question
        $question = getMessageInfo($dbh, $id_faq);
        
        // Vérification si l'utilisateur a le droit de supprimer la question
        $canDelete = canEditMessage($userInfo, $question['id_ligue']);
    }
    
    // Vérification si le formulaire de suppression a été soumis
    if (isset($_POST['delete'])) {
        $id_faq = $_POST['id_faq'];
        
        // Récupération des informations de la question
        $checkQuestion = getMessageInfo($dbh, $id_faq);
        // Vérification si l'utilisateur a le droit de supprimer la question
        $canDelete = canEditMessage($userInfo, $checkQuestion['id_ligue']);
        
        // Si l'utilisateur a le droit de supprimer la question
        if ($canDelete) {
            // Suppression de la question de la base de données
            $deleteSql = "DELETE FROM faq WHERE id_faq = :id_faq";
            $deleteStmt = $dbh->prepare($deleteSql);
            $deleteStmt->bindParam(':id_faq', $id_faq, PDO::PARAM_INT);
            $deleteStmt->execute();
            // Redirection vers la liste des questions
            header('Location: list.php');
            exit();
        } else {
            // Message d'erreur si l'utilisateur n'a pas les droits nécessaires
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
            <!-- Formulaire de suppression de la question -->
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
            <!-- Message si l'utilisateur n'a pas les droits nécessaires ou si la question n'existe pas -->
            <p>Vous n'avez pas les droits nécessaires pour supprimer cette question ou la question n'existe pas.</p>
            <button type="button" class="btn" onclick="window.location.href='./list.php'">Retour à la liste</button>
        <?php endif; ?>
        
        <?php if (isset($errorMsg)): ?>
            <!-- Affichage du message d'erreur -->
            <p style="color: red;"><?php echo $errorMsg; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
<?php
    // Inclusion du pied de page
    include '../../template/php/footer.php';
?>
