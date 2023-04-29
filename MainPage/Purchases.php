<html>
    <head>

    </head>
    <body>
        <?php
        session_start();
        if(!isset($_SESSION['user_id'])){
            header("Location: ../Users/login.php");
        }
        
        ?>
        <a href="mainpage.php">Go back</a>
    </body>
</html>