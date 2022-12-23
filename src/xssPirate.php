<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site pirate</title>
</head>

<body>
    <h1>La faille XSS</h1>
    <img src="../images/xss.jpg">

    <p><a href="../index.php">Retour à la page d'accueil</a></p>

    <form action="xss.php" method="POST">
        <label for="content">Nom d'utilisateur</label>
        <input type="text" name="username">
        <label for="content">Mot de passe</label>
        <input type="text" name="password">
        <input type="submit" value="publier">
    </form>

</body>

<script>alert('Attention vous avez été déconnecté !')</script>