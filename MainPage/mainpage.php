<?php
require('../Products/products.php');
require('../Products/product_type.php');
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="Styles/mainpage.css">
    <script src="cart.js"></script>
</head>

<body>
    <div class="authorize">
        <?php
        session_start();
        if (isset($_POST['logOut'])) {
            session_destroy();
            header("Location: ../Users/login.php");
        }
        $currentDate = date('j/m/Y H:i');
        if (!isset($_SESSION['user_id'])) {
            echo '<a href="../Users/login.php">Login</a>';
            echo '<a href="../Users/register.php">Register</a><br>';
        } else {
            include('AuthorizeActions/logOut.html');
        }
        ?>
    </div>
    <h1 class="title">Welcome to the Clothing Recomendation Shop</h1>
    <div class="manage-products">
        <?php
        if (isset($_SESSION['user_id'])) {
            echo  '<a href="cart.php">Go to the cart</a><br>';
            echo '<a href="purchases.php">Show my purchases</a><br>';
            echo '<a href="../Products/addProduct.php">Add product</a>';
        }
        ?>
    </div>
    <div class="product-container">
        <?php
        $prod_array = getAllProducts();
        if (is_array($prod_array)) {
            foreach ($prod_array as $arr) { ?>
                <div class="product">
                    <h2><?php echo $arr->getName() ?></h2>
                    <h3><span class="first-word">Cost: </span> <?php echo $arr->getCost() ?>$</h3>
                    <h3><span class="first-word"> Type: </span><?php echo getProductTypeById($arr->getTypeId())->getCategory() ?></h3>
                    <h5><span class="first-word">Description: </span><?php echo $arr->getDescription() ?></h5>
                    <h5><span class="first-word">Left in the stock: </span><?php echo $arr->getAmount() ?></h5>
                    <img src="<?php echo $arr->getImage() ?>" alt="<?php echo $arr->getName() ?> photo">
                    <?php
                    if (isset($_SESSION['user_id'])) {
                        include('AuthorizeActions/addToCartButton.html');
                    }
                    ?>
                    <?php
                    if (isset($_SESSION['user_id'])) {
                        echo '<a class="prod-update" href="../Products/updateProduct.php?pr_id=' . $arr->getId() . '">Update product</a><br>';
                        echo '<a class="prod-delete" href="../Products/deleteProduct.php?pr_id=' . $arr->getId() . '">Remove product</a>';
                    }
                    ?>
                </div>
        <?php }
            if (isset($_POST['cart-button'])) {
                $prod_id = $_GET['id'];
                $count = $_POST['amount'];
                if (isset($_SESSION['cart'])) {
                    $cart = $_SESSION['cart'];
                    foreach ($cart as $key => $value) {
                        if ($value[0] == $prod_id) {
                            unset($cart[$key]);
                        }
                    }
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