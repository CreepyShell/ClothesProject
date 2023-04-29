<form action="register.php" method="post" onsubmit="return validate(e)">
    <label for="email">Email:</label><input type="text" id="email" name="email"><br>
    <label for="password">Password:</label><input type="password" id="password" name="password"><br>
    <label for="conf-password">Confirm password:</label><input type="password" id="conf-password" name="conf-password"><br>
    <input type="submit" name="register" value="Submit">
</form>
<?php
include('header.html');
include('users.php');
if(isset($_SESSION['user_id'])){
    header("Location: ../MainPage/mainpage.php");
}
if (isset($_POST['register'])) {
    try {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $conf_pasword = $_POST['conf-password'];

        if ($password != $conf_pasword) {
            echo 'Passwords do not match';
        } else {
            register($email, $password);
        }
    } catch (PDOException $e) {
        $output = 'Unable to connect to the database server: ' . $e->getMessage();
        echo $output;
    }
}

include('footer.html');
