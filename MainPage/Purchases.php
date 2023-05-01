<html>

<head>
    <link rel="stylesheet" href="Styles/purchases.css">
    <link rel="stylesheet" href="Styles/cart.css">
</head>

<body>
    <div class="header">
        <h1>You puchases are here</h1>
        <a href="mainpage.php" class="go-back">Go back</a>
    </div>
    <?php
    session_start();
    require('../Products/product_type.php');
    require('../Products/products.php');
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../Users/login.php");
    } ?>
    <div class="purchase-container">
        <?php
        $purchases = getBoughtProducts($_SESSION['user_id']);
        if ($purchases == null) {
            echo '<h3 class="error" style="text-align: center;color: rgb(255, 65, 65);font-size: large; margin:auto">You bought nothing</h3>';
        } else {
            foreach ($purchases as $purchase) { ?>
                <div class="purchase">
                    <h4><span class="first-word">Name: </span> <?php echo $purchase[0]->getName(); ?></h4>
                    <p> <span class="first-word">Category: </span> <?php echo getProductTypeById($purchase[0]->getTypeId())->getCategory(); ?></p>
                    <p><span class="first-word">Date: </span> <?php echo $purchase[2]; ?></p>
                    <p><span class="first-word">Amount: </span> <?php echo $purchase[1]; ?></p>
                    <p><span class="first-word">Total cost: </span> <?php echo $purchase[1] * $purchase[0]->getCost(); ?>$</p>
                </div>
        <?php }
        } ?>
    </div>
</body>

</html>