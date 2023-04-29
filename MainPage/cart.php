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

    if(!isset($_SESSION['user_id'])){
        header("Location: ../Users/login.php");
    }

    if (!isset($_SESSION['cart'])) {
        echo '<h4>Nothing in the cart</h4>';
    } else {
        $arr = $_SESSION['cart'];
        foreach ($arr as $el) {
            $product = getProductById($el[0]);
            echo '<h1>' . $product->getName() . '</h1><br>';
            echo 'num of prods: ' . $el[1] . '<br>';
        }
    }

    if (isset($_POST['empty-cart'])) {
        unset($_SESSION['cart']);
        header("Location: mainpage.php");
    }

    if (isset($_POST['buy-products']) && isset($_SESSION['user_id']) && isset($_SESSION['cart'])) {
        $userId = $_SESSION['user_id'];
        $arr = $_SESSION['cart'];
        foreach ($arr as $el) {
            buyProduct($el[0], $userId, $el[1]);
            header("Location: mainpage.php");
        }
    }
    ?>
    <form action="cart.php" method="POST">
        <button type="submit" name="empty-cart">Clear the cart</button>
    </form>
    <form action="cart.php" method="POST">
        <button type="submit" name="buy-products"> Buy products</button>
    </form>
</body>

</html>