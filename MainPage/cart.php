<html>

<head>
    <link rel="stylesheet" href="Styles/cart.css">
</head>

<body>
    <div>
        <h1 class="header">You cart is here</h1>
        <a class="go-back" href="mainpage.php">Go back</a>
    </div>
    <?php
    require('../Products/products.php');
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: ../Users/login.php");
    }

    if (isset($_POST['remove-prod']) ?? isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
        foreach ($cart as $key => $item) {
            if ($item[0] == $_GET['pr_id']) {
                unset($cart[$key]);
            }
        }
        $_SESSION['cart'] = $cart;
    }
    ?>
    <div class="cart">
        <?php
        $total = 0.0;
        if (!isset($_SESSION['cart']) || sizeof($_SESSION['cart']) == 0) {
            echo '<h4 style="text-align: center;color: rgb(255, 65, 65);font-size: large;margin:auto">Nothing in the cart</h4>';
        } else {
            $arr = $_SESSION['cart'];
            foreach ($arr as $el) {
                $product = getProductById($el[0]);
                if ($product != null) {
                    $total += $product->getCost() * $el[1]; ?>
                    <div class="cart-item">
                        <h2><?php echo $product->getName(); ?> </h2>
                        <p> <span class="first-word">Amount of products: </span><?php echo $el[1] ?></p><br>
                        <p><span class="first-word">Total cost: </span> <?php echo ($product->getCost() * $el[1]) ?>$</p>
                        <img src="<?php echo $product->getImage() ?>" alt="Product image">
                        <form action="cart.php?pr_id=<?php echo $product->getId() ?>" method="POST">
                            <button class="remove-prod" type="submit" name="remove-prod" class="remove-prod">Remove</button>
                        </form>
                    </div>
        <?php
                }
            }
        } ?>
    </div>
    <div class="actions">
        <p>Total: <?php echo $total ?>$</p>
        <form class="empty-cart" action="cart.php" method="POST">
            <button type="submit" name="empty-cart">Clear the cart</button>
        </form>
        <form class="buy-products" action="cart.php" method="POST">
            <button type="submit" name="buy-products"> Buy products</button>
        </form>
    </div>
    <?php
    if (isset($_POST['empty-cart'])) {
        unset($_SESSION['cart']);
        header("Location: mainpage.php");
    }

    if (isset($_POST['buy-products']) && isset($_SESSION['user_id']) && isset($_SESSION['cart'])) {
        $userId = $_SESSION['user_id'];
        $arr = $_SESSION['cart'];
        $isEnoughProducts = true;
        foreach ($arr as $el) {
            $product = getProductById($el[0]);
            if ($product != null && $product->getAmount() < $el[1]) {
                $isEnoughProducts = false;
                echo '<p class="error" style="text-align: center;color: rgb(255, 65, 65); font-size: large;"> 
                Sorry, but in the stock not enough ' . $product->getName() . ', only ' . $product->getAmount() . ' left</p>';
            }
        }
        if ($isEnoughProducts) {
            foreach ($arr as $item) {
                buyProduct($item[0], $userId, $item[1]);
            }
            unset($_SESSION['cart']);
            header("Location: mainpage.php");
        }
    }
    ?>
</body>

</html>