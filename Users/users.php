<?php

declare(strict_types=1);
include('../Models/user.php');
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
            session_start();
            $_SESSION['user_id'] = $row['user_id'];
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
    $user = new User();
    $user->setEmail($email);
    $user->setPassword($password);
    $message = validateUser($user);
    if ($message != "valid") {
        echo "Invalid data: " . $message;
        return;
    }

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
            header("Location: login.php");
        }
        return;
    }
    echo 'User with this name already exist';
}

function validateUser(User $user)
{
    if (strlen($user->getEmail()) < 6 || strlen($user->getEmail()) > 50) {
        return "Invalid email, must be greater than 6 symbols and less than 50 symbols";
    }
    if (strlen($user->getPassword()) < 8 || strlen($user->getPassword()) > 20) {
        return "Invalid password, must be greater than 8 symbols and less than 20 symbols";
    }
    return "valid";
}
