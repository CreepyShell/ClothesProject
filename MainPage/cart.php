<html>

<head>
    <script>

    </script>

</head>

<body>
    <h1>You cart is here</h1>
    <br>
    <?php
    require('../Products/products.php');
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: ../Users/login.php");
    }
    ?>
    <div class="cart">
        <div class="cart-item">
            <?php
            $total = 0.0;
            if (!isset($_SESSION['cart'])) {
                echo '<h4>Nothing in the cart</h4>';
            } else {
                $arr = $_SESSION['cart'];
                foreach ($arr as $el) {
                    $product = getProductById($el[0]);
                    $total += $product->getCost() * $el[1];
                    echo '<h2>' . $product->getName() . '</h2>';
                    echo '<p>num of prods: ' . $el[1] . '</p><br>';
                    echo '<p>Total cost: ' . ($product->getCost() * $el[1]).'</p>';
                    ?>
                    <img src="<?php echo $product->getImage()?>" alt="Product image">
                    <?php
                }
            } ?>
        </div>
        <?php
        if (isset($_POST['empty-cart'])) {
            unset($_SESSION['cart']);
            header("Location: mainpage.php");
        }

        if (isset($_POST['buy-products']) && isset($_SESSION['user_id']) && isset($_SESSION['cart'])) {
            $userId = $_SESSION['user_id'];
            $arr = $_SESSION['cart'];
            foreach ($arr as $el) {
                buyProduct($el[0], $userId, $el[1]);
                unset($_SESSION['cart']);
                header("Location: mainpage.php");
            }
        }
        ?>
    </div>
    <form action="cart.php" method="POST">
        <button type="submit" name="empty-cart">Clear the cart</button>
    </form>
    <form action="cart.php" method="POST">
        <p>Total: <?php echo $total ?>$</p>
        <button type="submit" name="buy-products"> Buy products</button>
    </form>

    <a href="mainpage.php">Go back</a>
</body>

</html>