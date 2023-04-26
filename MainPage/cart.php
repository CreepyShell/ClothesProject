<html>

<head>
    <script>

    </script>

</head>

<body>
    <h1>You cart is here</h1>
    <a href="mainpage.php">Go back</a>
    <?php

    session_start();
    if (!isset($_SESSION['cart'])) echo '<h4>Nothing in the cart</h4>';
    else {
       
    };
    ?>
</body>

</html>