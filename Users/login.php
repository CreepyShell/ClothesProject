<?php
include('header.html');
echo '<form action="login.php" method="POST">
        <label for="email">Email:</label><input type="text" id="email" name="email"><br>
        <label for="password">Password:</label><input type="password" id="password" name="password"><br>
        <button name="login" type="submit">Submit</button>
    </form>';
if (isset($_POST['login'])) {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=clothes; charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM users WHERE email=:cemail";
        $result = $pdo->prepare($sql);
        $result->bindValue(':cemail', $_POST['email']);
        $result->execute();
        if ($result->rowCount() > 0) {
            $row = $result->fetch();
            if ($row['password'] == $_POST['password']) {
                header("Location: ../MainPage/mainpage.php");
                return;
            }
            echo 'password incorrect, try again';
            return;
        }
        echo 'The user with given email was not found';
    } catch (PDOException $e) {
        $output = 'Unable to connect to the database server: ' . $e->getMessage();
        echo $output;
    }
}
include('footer.html');
?>