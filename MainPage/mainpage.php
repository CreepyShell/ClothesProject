<?php
include('../Products/products.php');
?>
<!DOCTYPE html>
<html>

<head>
    <script src="cart.js"></script>
</head>

<body>
    <div>
        <a href="../Users/login.php">Login</a>
        <a href="../Users/register.php">Register</a>
        <a href="cart.php">Got to cart</a>
    </div>
    <div>
        <a href="../Products/addProduct.php">Add product</a>
    </div>
    <div class="product-container">
        <?php
        $prod_array = getAllProducts();
        if (is_array($prod_array)) {
            foreach ($prod_array as $arr) { ?>
                <div class="product">
                    <h2><?php echo $arr->getName() ?></h2>
                    <h3><?php echo $arr->getCost() ?></h3>
                    <h5><?php echo $arr->getDescription() ?></h5>
                    <img src="<?php echo $arr->getImage() ?>" alt="<?php echo $arr->getName() ?> photo">
                    <form action="mainpage.php?id=<?php echo $arr->getId() ?>" method="POST">
                        <input type="number" min="0" name="amount">
                        <button id="cart-button" name="cart-button">Add to cart</button>
                    </form>
                </div>
                <a href="../Products/updateProduct.php?pr_id=<?php echo $arr->getId() ?>">Update product</a>
                <a href="../Products/deleteProduct.php?pr_id=<?php echo $arr->getId() ?>">Remove product</a>

        <?php }
            if (isset($_POST['cart-button'])) {
                $prod_id = $_GET['id'];
                $count = $_POST['amount'];
                session_start();
                if (isset($_SESSION['cart'])) {
                    $cart = $_SESSION['cart'];
                    array_push($cart, array($prod_id, $count));
                    $_SESSION['cart'] = $cart;
                } else {
                    $_SESSION['cart'] = array(array($prod_id, $count));
                }
            }
        } ?>
    </div>
</body>

</html>