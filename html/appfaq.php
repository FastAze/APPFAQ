<?php
    include '../template/header.php';
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>APPFAQ</title>
    <link rel="stylesheet" href="../css/main.css">
    <style>
      body {
        display: block;
      }
    </style>
  </head>
  <body>
    <div class="mid">
      <div class="faq">
        <button class="question">FAQ</button>
        <div class="reponse">
          <p>Reponse</p>
          <p>
            <input class="reponse-btn"  type="button" id="repondre" name="repondre" value="Répondre"/>
          </p>
        </div>
      </div>
    </div>
  </body>
</html>
<?php
    include '../template/footer.php';
?>