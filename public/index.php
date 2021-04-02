<?php require 'functions.php';
$errors = addfriend($_GET);
$friends = getFriendsList();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>
    <ul>
        <?php foreach($friends as $friend) : ?>
        <li><?= $friend['firstname'] ?> <?= $friend['lastname'] ?></li>
        <?php endforeach ?>
    </ul>
    <?php foreach($errors as $error) : ?>
    <p><?= $error ?></p>
    <?php endforeach ?>
    <form action="" method="get">
        <label for="firstname">Prénom</label>
        <input type="text" id="firstname" name="firstname">
        <label for="lastname">Nom</label>
        <input type="text" id="lastname" name="lastname">
        <input type="submit" value="Ajouter">
    </form>
</body>
</html>
