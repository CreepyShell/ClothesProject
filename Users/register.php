<?php
include('header.html');

echo '<form action="register.php" method="post" onsubmit="return validate(e)">
    <label for="email">Email:</label><input type="text" id="email" name="email"><br>
    <label for="password">Password:</label><input type="password" id="password" name="password"><br>
    <label for="conf-password">Confirm password:</label><input type="password" id="conf-password" name="conf-password"><br>
    <input type="submit" name="register" value="Submit">
</form>';

if (isset($_POST['register'])) {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=clothes; charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM users WHERE email=:cemail";
        $result = $pdo->prepare($sql);
        $result->bindValue(':cemail', $_POST['email']);
        $result->execute();
        if ($result->rowCount() == 0) {
            $password = $_POST['password'];
            $email = $_POST['email'];
            $conf_pass = $_POST['conf-password'];
            
            if ($password == $conf_pass) {
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
            } else {
                echo "Passwords do not match";
            }
        } else {
            echo 'User with this name already exist';
        }
    } catch (PDOException $e) {
        $output = 'Unable to connect to the database server: ' . $e->getMessage();
        echo $output;
    }
}

include('footer.html');
