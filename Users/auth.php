<?php
include('header.html');
if (isset($_GET['auth'])) {
    if ($_GET['auth'] == 'Login') {
        echo '<form action="login.php" method="post">
        <label for="email">Email:</label><input type="text" id="email" name="email"><br>
        <label for="password">Password:</label><input type="password" id="password" name="password"><br>
        <button type="submit">Submit</button>
    </form>';
    }
    if ($_GET['auth'] == 'Register') {
        echo '<form action="register.php" method="post">
        <label for="email">Email:</label><input type="text" id="email" name="email"><br>
        <label for="password">Password:</label><input type="password" id="password" name="password"><br>
        <label for="conf-password">Confirm password:</label><input type="password" id="conf-password"><br>
        <button type="submit">Submit</button>
    </form>';
    }
}
include('footer.html');
