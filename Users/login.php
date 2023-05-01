<?php
include('header.html');?>
<h1 class="login-title">Login</h1>
<form class="login-form" action="login.php" method="POST">
    <label class="email" for="email">Email:</label><input type="text" id="email" name="email"><br>
    <label class="password" for="password">Password:</label><input type="password" id="password" name="password"><br>
    <button class="submit" name="login" type="submit">Submit</button>
</form>

<?php
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