<?php
include('header.html'); ?>
<h1 class="register-title">Register</h1>
<form class="register-form" action="register.php" method="post" onsubmit="return validate(e)">
    <label class="email" for="email">Email:</label><input type="text" id="email" name="email"><br>
    <label class="password" for="password">Password:</label><input type="password" id="password" name="password"><br>
    <label class="conf-password" for="conf-password">Confirm password:</label><input type="password" id="conf-password" name="conf-password"><br>
    <input class="submit" type="submit" name="register" value="Submit">
</form>
<?php
include('users.php');
if (isset($_SESSION['user_id'])) {
    header("Location: ../MainPage/mainpage.php");
}
if (isset($_POST['register'])) {
    try {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $conf_pasword = $_POST['conf-password'];

        if ($password != $conf_pasword) {
            echo '<p class="error">Passwords do not match</p>';
        } else {
            register($email, $password);
        }
    } catch (PDOException $e) {
        $output = 'Unable to connect to the database server: ' . $e->getMessage();
        echo $output;
    }
}

include('footer.html');
