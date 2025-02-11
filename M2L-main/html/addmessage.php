<?php
    include '../template/header.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création d'un message</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #667eea, #764ba2);
        }
        .signup-container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            animation: fadeIn 0.8s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-90px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .signup-container h2 {
            margin-bottom: 1rem;
            color: #333;
        }
        .signup-container textarea {
            width: 100%;
            height: 100px;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: none;
        }
        .signup-container button {
            width: 100%;
            padding: 10px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
            margin: 10px 0;
        }
        .signup-container button:hover {
            background: #5a67d8;
        }
        .signup-container .cancel-btn {
            background: #ccc;
        }
        .signup-container .cancel-btn:hover {
            background: #bbb;
        }
    </style>
</head>
<body>
    
    <div class="signup-container">
        <h2>Ajouter une question</h2>
        <textarea placeholder="Entrez votre message" required></textarea>
        <button>Enregistrer</button>
        <button class="cancel-btn">Annuler</button>
    </div>

</body>
</html>

<?php
    include '../template/footer.php';
?>
