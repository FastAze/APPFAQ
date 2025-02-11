<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>APPFAQ</title>
    <link rel="stylesheet" href="/css/main.css">
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
        </div>
      </div>
    </div>

    <script>
      var acc = document.getElementsByClassName("question");
      var i;

      for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function () {
          this.classList.toggle("active");
          this.parentElement.classList.toggle("active");

          var pannel = this.nextElementSibling;

          if (pannel.style.display === "block") {
            pannel.style.display = "none";
          } else {
            pannel.style.display = "block";
          }
        });
      }
    </script>
  </body>
</html>