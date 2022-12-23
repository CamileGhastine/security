<?php
try {
    $dbh = new PDO('mysql:host=localhost;dbname=failles', 'root', '');
} catch (PDOException $e) {
    echo "<h4 style='color:red'>La base de données n'existe plus</h4>";
    echo $e->getMessage();
    die;
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $statement = $dbh->prepare("SELECT * from chat WHERE id = $id ");
    // $statement = $dbh->prepare("SELECT * from messages WHERE id = :id");
    // $statement->bindParam("id", $id);
    $statement->execute();
    $message = $statement->fetch();
}

$statement2 = $dbh->prepare('SELECT id from chat');
$statement2->execute();
$ids = $statement2->fetchall();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>injection SQL</title>
</head>

<body>
    <h1>L'injection SQL</h1>
    <img src="../images/sql.jpg">

    <p><a href="../index.php">Retour à la page d'accueil</a></p>

    <h4>Cliquer sur un id pour décourvir le message</h4>
    <p><?= count($ids) ? null : "Votre base est vide" ?></p>
    <table>
        <tbody>
            <?php foreach ($ids as $row) { ?>
                <tr>
                    <td><a href="?id=<?= htmlspecialchars($row['id']) ?>"><?= htmlspecialchars($row['id']) ?></a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php if (isset($_GET['id'])) {  ?>

        <p>Le message associé à l'id <?= htmlspecialchars($message['id']) ?> est : "<?= isset($message) ? $message['content'] : null ?>"</p>
    <?php } ?>
    <p></p>
</body>

</html>