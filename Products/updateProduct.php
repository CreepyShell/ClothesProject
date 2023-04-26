<!DOCTYPE html>
<html>

<head>

</head>

<body>
    <?php include("products.php");
    $product = getProductById((int)$_GET['pr_id']);
    if (is_null($product)) {
        header("Location: ../MainPage/mainpage.php");
    }
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
            echo 'Project is not valid: ' . $validation_result;
        } else {
            if (updateProduct($product->getId(), $product)) {
                header("Location: ../MainPage/mainpage.php");
            }
            else{
                echo "Nothing to update";
            }
        }
    }

    ?>
    <form action="updateProduct.php?pr_id=<?php echo $product->getId() ?>" method="POST">
        <label for="prod-name">Enter updated product name</label>
        <input value="<?php echo $product->getName() ?>" type="text" name="prod-name" id="prod-name"><br>

        <label for="prod-descr">Enter updated product description: </label>
        <input value="<?php echo $product->getDescription() ?>" type="text" name="prod-descr" id="prod-descr"><br>

        <label for="prod-cost">Enter updated product cost: </label>
        <input value="<?php echo $product->getCost() ?>" type="text" name="prod-cost" id="prod-cost"><br>

        <label for="prod-img">Enter updated product image url: </label>
        <input value="<?php echo $product->getImage() ?>" type="text" name="prod-img" id="prod-img"><br>
        <button type="submit" name="submit">Submit</button>
    </form>
    <a href="../MainPage/mainpage.php">Go back</a>
</body>

</html>