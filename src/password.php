<?php

$step = isset($_GET['step']) ? $_GET['step'] : null;

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe</title>
</head>

<body>
    <h1>Les mots de passe</h1>
    <img src="../images/password.jpg">

    <p><a href="../index.php">Retour à la page d'accueil</a> <a href="password.php">🔄</a><a href="?step=0">👉</a></p>

    <ul>
        <?php if ($step === '0' || $step > 0) : ?>
            <li>
                <h2>Hashage des mots de passe <a href="?step=1">👉</a></h2>
            </li>
        <?php endif; ?>

        <?php if ($step > 0) : ?>
            <ul>
                <li>Respect RGPD</li>
                <li>Hack de la BDD</li>
            </ul>
            <a href="?step=2">👉</a>
            </br>
        <?php endif; ?>

        <?php if ($step == 2 || $step == 3) : ?>
            <img src="../images/cryptage.jpg" style="width:600px;height:300px;">
            <a href="?step=3">👉</a>
        <?php endif; ?>

        <?php if ($step == 3) : ?>
            <img src="../images/hash.jpg" style="width:300px;height:300px;">
            <a href="?step=4">👉</a>
        <?php endif; ?>

        <?php if ($step == 4) : ?>
            <img src="../images/hash-compare.jpg" style="width:600px;height:300px;">
            <a href="?step=5">👉</a>
        <?php endif; ?>

        <?php if ($step > 4) : ?>
            <li>
                <h2>Attaque par force brut <a href="?step=6">👉</a></h2>
            </li>
        <?php endif; ?>

        <?php if ($step > 5) : ?>
            <ul>
                <li>Taux de cryptage élevés </li>
                <li>Authentification multifacteur </li>
                <li>Verrouillage des tentatives de connexion </li>
                <li>CAPTCHA</li>
            </ul>
            <a href="?step=7">👉</a>
            </br>
        <?php endif; ?>

        <?php if ($step == 7) : ?>
            <img src="../images/force-brut.jpg" style="width:500px;height:600px;">
            <a href="?step=8">👉</a>
        <?php endif; ?>
    </ul>


</body>