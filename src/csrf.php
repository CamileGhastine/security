<?php
session_start();

$dbh = new PDO('mysql:host=localhost;dbname=failles', 'root', '');

if (isset($_POST['pseudo'])) {
    $_SESSION['pseudo'] = $_POST['pseudo'];
    // $_SESSION['token'] = 'token_secret';
}

if (isset($_GET['delete'])) {
    $statement4 =  $dbh->prepare("SELECT pseudo FROM chat WHERE id=:id");
    $statement4->execute([
        "id" => $_GET['delete'],
    ]);
    $pseudo = $statement4->fetch();
    $pseudo = $pseudo ? $pseudo['pseudo'] : "faux";

    // Supression message
    // $backToken = isset($_SESSION['token']) ? $_SESSION['token'] : "rien";
    // $frontToken = isset($_GET['token']) ? $_GET['token'] : null;
    // if ($pseudo == $_SESSION['pseudo'] && $backToken == $frontToken) {
    if ($pseudo == $_SESSION['pseudo']) {
        $statement3 = $dbh->prepare("DELETE FROM chat WHERE id=:id");
        $statement3->execute(["id" => $_GET['delete']]);
    } else {
        echo "<p style='color:red'>Vous n'êtes pas autorisé à supprimer ce message !</p>";
    }
}


if (isset($_POST['message'])) {
    $statement2 = $dbh->prepare("INSERT INTO chat (content, pseudo) VALUES (:content, :pseudo)");
    $statement2->execute([
        "content" => $_POST['message'],
        "pseudo" => $_SESSION['pseudo']
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
    <title>Faille CSRF</title>
</head>

<body>
    <h1>La faille CSRF (Cross-Site Request Forgery)</h1>
    <img src="../images/csrf.jpg">
    <p><a href="../index.php">Retour à la page d'accueil</a></p>

    <?php
    if (!isset($_SESSION['pseudo'])) {
    ?>

        <form action="csrf.php" method="POST">
            <label for="content">Entrez votre pseudo </label>
            <input type="text" name="pseudo">
            <input type="submit" value="Connection">
        </form>


    <?php }

    if (isset($_SESSION['pseudo'])) {
        echo "<p>Bienvenue " . $_SESSION['pseudo'] . " (<a href='deconnect.php'>Déconnexion</a>)<p>";
    }
    ?>

    <table>
        <tbody>
            <?php foreach ($messages as $message) { ?>
                <tr>
                    <td>
                        <?php $token = isset($_SESSION['token']) ? $_SESSION['token'] : null ?>
                        <?= htmlspecialchars($message['pseudo']) . ' (id=' . $message['id'] . ')' ?> :
                        <?= ($message['content']) ?>
                        <?= isset($_SESSION['pseudo']) && $_SESSION['pseudo'] == $message['pseudo']
                            // lien vers delete
                            ? '<a href="csrf.php?delete=' . $message['id'] . '">X</a>'
                            // ? '<a href="csrf.php?delete=' . $message['id'] . '&token=' . $token . '">X</a>'
                            : null ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php
    if (isset($_SESSION['pseudo'])) {
    ?>
        <form action="csrf.php" method="POST">
            <label for="content">Entrez votre message </label>
            <input type="text" name="message">
            <input type="submit" value="publier">
        </form>
    <?php } ?>

</body>

</html>