<?php

$dbh = new PDO('mysql:host=localhost;dbname=failles', 'root', '');


if (isset($_GET['delete'])) {
    $statement = $dbh->prepare("DELETE FROM chat WHERE id=:id");
    $statement->execute(["id" => $_GET['delete']]);
}


if (isset($_POST['message'])) {
    $statement = $dbh->prepare("INSERT INTO chat (content, pseudo) VALUES (:content, :pseudo)");
    $statement->execute([
        "content" => $_POST['message'],
        "pseudo" => 'camile'
    ]);
}

$statement = $dbh->prepare('SELECT * from chat');
$statement->execute();
$messages = $statement->fetchall();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faille XSS</title>
</head>

<body>
    <h1>La faille XSS</h1>
    <img src="../images/xss.jpg">

    <p><a href="../index.php">Retour à la page d'accueil</a></p>

    <form action="xss.php" method="POST">
        <label for="content">Entrez votre message </label>
        <input type="text" name="message">
        <input type="submit" value="publier">
    </form>
    <table>
        <tbody>
            <?php foreach ($messages as $message) : 
                $id = $message['id'];
                $message = $message['content'];

                // $message = str_replace('&', '&amp;', $message);
                // $message = str_replace('<', '&lt;', $message);
                // $message = str_replace('>', '&gt;', $message);
                // $message = str_replace('"', '&quot;', $message);
                ?>
                <p>
                    <?= $message ?>
                    <a href="xss.php?delete=<?= $id ?>">X</a>
                </p>
            <?php endforeach; ?>
        </tbody>
    </table>



</body>


<!-- <script>window.location.href='http://www.lequipe.fr/'</script> -->
<!-- <script>window.location.href='xssPirate.php'</script> -->