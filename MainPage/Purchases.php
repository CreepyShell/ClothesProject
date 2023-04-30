<html>

<head>

</head>

<body>
    <h1>You puchases are here</h1>
    <?php
    session_start();
    require('../Products/product_type.php');
    require('../Products/products.php');
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../Users/login.php");
    }

    $purchases = getBoughtProducts($_SESSION['user_id']);
    if ($purchases == null) {
        echo '<p>You bought nothing</p>';
    } else {
        foreach ($purchases as $purchase) {
            echo '<br>';
            echo '<h4>Name: ' . $purchase[0]->getName() . '</h4>';
            echo '<p> Category:' . getProductTypeById($purchase[0]->getTypeId())->getCategory() . '</p>';
            echo '<p>Date: ' . $purchase[2] . '</p>';
            echo '<p>Amount: ' . $purchase[1] . '</p>';
            echo '<p>Total cost: ' . $purchase[1] * $purchase[0]->getCost() . '</p>';
        }
    }

    ?>
    <a href="mainpage.php">Go back</a>
</body>

</html>