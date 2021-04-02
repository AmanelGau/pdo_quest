<?php

require_once '_connec.php';

function connect(): PDO
{
    $pdo = new PDO(DSN, USER, PASS);
    return $pdo;
}

function getFriendsList(): ?array
{
    $pdo = connect();
    $query = 'SELECT * FROM friend';
    $statement = $pdo->prepare($query);
    $statement->execute();
    $friends = $statement->fetchAll();
    return $friends;
}

function addfriend(array $getArray): array
{
    $errors = [];
    $isGetValid = array_key_exists('firstname', $getArray) && array_key_exists('lastname', $getArray);
    if ($isGetValid) 
    {
        $firstname = $getArray['firstname'];
        $lastname = $getArray['lastname'];
        if ( strlen($firstname) < 1 )
        {
            $errors[] = "Prénom trop court";
        } 
        elseif (strlen($firstname) > 45)
        {
            $errors[] = "Prénom trop long";
        }

        if ( strlen($lastname) < 1 )
        {
            $errors[] = "Nom trop court";
        } 
        elseif (strlen($lastname) > 45)
        {
            $errors[] = "Nom trop long";
        }

        if (!$errors)
        {
            $pdo = connect();
            $query = 'INSERT INTO friend(firstname ,lastname) VALUES (:firstname, :lastname)';
            $statement = $pdo->prepare($query);

            $statement->bindValue(':firstname', $firstname);
            $statement->bindValue(':lastname', $lastname);

            $statement->execute();
        }
    }
    return $errors;
}