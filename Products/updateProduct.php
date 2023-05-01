<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../MainPage/Styles/products.css">
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../Users/login.php");
    }
    include("products.php");
    $product = getProductById((int)$_GET['pr_id']);
    if (is_null($product)) {
        header("Location: ../MainPage/mainpage.php");
    } ?>
    <h1 class="title">Update product</h1>
    <a class="go-back" href="../MainPage/mainpage.php">Go back</a>
    <form class="main-form" action="updateProduct.php?pr_id=<?php echo $product->getId() ?>" method="POST">
        <label class="prod-name" for="prod-name">Enter updated product name: </label>
        <input value="<?php echo $product->getName() ?>" type="text" name="prod-name" id="prod-name"><br>

        <label class="prod-description" for="prod-descr">Enter updated product description: </label><br>
        <input value="<?php echo $product->getDescription() ?>" type="text" name="prod-descr" id="prod-descr"><br>

        <label class="prod-cost" for="prod-cost">Enter updated product cost: </label>
        <input value="<?php echo $product->getCost() ?>" type="number" name="prod-cost" id="prod-cost"><br>

        <label class="prod-image" for="prod-url">Enter updated product image url: </label>
        <input value="<?php echo $product->getImage() ?>" type="text" name="prod-img" id="prod-url"><br>
        <button class="update-prod-submit" type="submit" name="submit">Submit</button>
    </form>
    <?php
    if (isset($_POST['submit'])) {
        $newName = $_POST['prod-name'];
        $product->setName($newName);

        $newDescr = $_POST['prod-descr'];
        $product->setDescription($newDescr);

        $newCost = $_POST['prod-cost'];
        $product->setCost($newCost);

        $newImg = $_POST['prod-img'];
        $product->setImage($newImg);

        $validation_result = validateProduct($product);
        if ($validation_result != 'valid') {
            echo '<p class="error">Project is not valid: ' . $validation_result.'</p>';
        } else {
            if (updateProduct($product->getId(), $product)) {
                header("Location: ../MainPage/mainpage.php");
            } else {
                echo '<p class="error">Nothing to update</p>';
            }
        }
    }
    ?>
</body>

</html>