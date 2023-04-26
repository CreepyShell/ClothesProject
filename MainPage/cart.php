<html>

<head>
    <script>

    </script>

</head>

<body>
    <h1>You cart is here</h1>
    <a href="mainpage.php">Go back</a>
    <br>
    <?php
    include('../Products/products.php');
    session_start();
    if (!isset($_SESSION['cart'])) {
        echo '<h4>Nothing in the cart</h4>';
    } else {
        $arr = $_SESSION['cart'];
        foreach ($arr as $el) {
            $product = getProductById($el[0]);
            echo '<h1>'.$product->getName().'</h1><br>';
            echo 'num of prods: ' . $el[1] . '<br>';
        }
    }

    if(isset($_POST['empty-cart'])){
        session_destroy();
        header("Location: mainpage.php");
    }
    ?>
    <form action="cart.php" method="POST">
        <button type="submit" name="empty-cart">Clear the cart</button>
    </form>
    <form action=""></form>
</body>

</html>