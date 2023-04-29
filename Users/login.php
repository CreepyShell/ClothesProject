<form action="login.php" method="POST">
    <label for="email">Email:</label><input type="text" id="email" name="email"><br>
    <label for="password">Password:</label><input type="password" id="password" name="password"><br>
    <button name="login" type="submit">Submit</button>
</form>
<a href="../MainPage/mainpage.php">Go back</a>
<?php
include('header.html');
include('users.php');

if(isset($_SESSION['user_id'])){
    header("Location: ../MainPage/mainpage.php");
}

if (isset($_POST['login'])) {
    try {
        $user = new User();
        $user->setPassword($_POST['password']);
        $user->setEmail($_POST['email']);
        login($user);
    } catch (PDOException $e) {
        $output = 'Unable to connect to the database server: ' . $e->getMessage();
        echo $output;
    }
}
include('footer.html');
?>