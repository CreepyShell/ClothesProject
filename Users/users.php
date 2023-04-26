<?php

declare(strict_types=1);

function login(User $user)
{
    $pdo = new PDO('mysql:host=localhost;dbname=clothes; charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM users WHERE email=:email";
    $result = $pdo->prepare($sql);
    $result->bindValue(':email', $user->getEmail());
    $result->execute();

    if ($result->rowCount() > 0) {
        $row = $result->fetch();
        if ($row['password'] == $user->getPassword()) {
            header("Location: ../MainPage/mainpage.php");
            return;
        }
        echo 'password incorrect, try again';
        return;
    }
    echo 'The user with given email was not found';
}

function register(string $email, string $password)
{
    $pdo = new PDO('mysql:host=localhost;dbname=clothes; charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM users WHERE email=:cemail";
    $result = $pdo->prepare($sql);
    $result->bindValue(':cemail', $email);
    $result->execute();
    if ($result->rowCount() == 0) {
        $insertSql = "INSERT INTO USERS(email, password) VALUES(:email, :password)";
        $resultInsert = $pdo->prepare($insertSql);
        $resultInsert->bindValue(':email', $email);
        $resultInsert->bindValue(':password', $password);

        $resultInsert->execute();
        if ($resultInsert->rowCount() == 1) {
            header("Location: ../MainPage/mainpage.php");
            session_start();
            $_SESSION['email'] = $email;
        }
        return;
    }
    echo 'User with this name already exist';
}
