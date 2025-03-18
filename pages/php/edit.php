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
    
    // Vérification si un ID de FAQ est passé en paramètre GET
    if (isset($_GET['id_faq'])) {
        $id_faq = $_GET['id_faq'];
        // Récupération des informations de la question
        $question = getMessageInfo($dbh, $id_faq);
        
        // Vérification des droits de modification de l'utilisateur
        $canEdit = canEditMessage($userInfo, $question['id_ligue']);
    }
    
    // Traitement du formulaire de mise à jour
    if (isset($_POST['update'])) {
        $id_faq = $_POST['id_faq'];
        $questionText = htmlspecialchars($_POST['question']);
        $reponse = htmlspecialchars($_POST['reponse']);
        $currentDate = date('Y-m-d H:i:s');
        
        // Vérification des informations de la question et des droits de modification
        $checkQuestion = getMessageInfo($dbh, $id_faq);
        $canEdit = canEditMessage($userInfo, $checkQuestion['id_ligue']);
        
        // Mise à jour de la question si l'utilisateur a les droits nécessaires
        if ($canEdit) {
            $updateSql = "UPDATE faq 
                            SET question = :question, reponse = :reponse, dat_reponse = :dat_reponse
                            WHERE id_faq = :id_faq";
            $updateStmt = $dbh->prepare($updateSql);
            $updateStmt->bindParam(':question', $questionText, PDO::PARAM_STR);
            $updateStmt->bindParam(':reponse', $reponse, PDO::PARAM_STR);
            $updateStmt->bindParam(':dat_reponse', $currentDate, PDO::PARAM_STR);
            $updateStmt->bindParam(':id_faq', $id_faq, PDO::PARAM_INT);
            $updateStmt->execute();
            // Redirection vers la liste des questions après mise à jour
            header('Location: list.php');
            exit();
        } else {
            // Message d'erreur si l'utilisateur n'a pas les droits nécessaires
            $errorMsg = "Vous n'avez pas les droits nécessaires pour modifier cette question.";
        }
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une question / Réponse</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <h1 class="titel-appfaq">M2L</h1>
    <div class="container">
        <h2>Modifier une question / Réponse</h2>
        <?php if (isset($canEdit) && $canEdit): ?>
            <!-- Formulaire de modification de la question -->
            <form action="edit.php" method="post">
                <input type="hidden" name="id_faq" value="<?php echo $id_faq; ?>">
                <label for="question">Question :</label>
                <br>
                <textarea name="question" rows="10" cols="60" style="resize: none;" required><?php echo $question['question']; ?></textarea>
                <br>
                <label for="reponse">Réponse :</label>
                <br>
                <textarea name="reponse" rows="10" cols="60" style="resize: none;" required><?php echo $question['reponse']; ?></textarea>
                <br>
                <button class="btn" name="update" type="submit">Enregistrer</button>
                <button type="button" class="btn" onclick="window.location.href='./list.php'">Annuler</button>
            </form>
        <?php else: ?>
            <!-- Message si l'utilisateur n'a pas les droits nécessaires ou si la question n'existe pas -->
            <p>Vous n'avez pas les droits nécessaires pour modifier cette question ou la question n'existe pas.</p>
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
