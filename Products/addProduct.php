<html>

<head></head>

<body>
    <?php 
    session_start();
    if(!isset($_SESSION['user_id'])){
        header("Location: ../Users/login.php");
    }
    ?>
    <form action="addProduct.php" method="POST">
        <h1>Add product</h1>
        <label for="prod-name">Enter product name</label><input type="text" name="name" id="prod-name"><br>
        <label for="prod-cost">Enter product cost</label><input type="number" name="cost" id="prod-costs"><br>
        <label for="prod-descr">Enter product description </label><input type="text" name="descr" id="prod-descr"><br>
        <label for="prod-url">Enter product image url</label><input type="text" name="image-url" id="prod-url"><br>
        <label for="prod-type">Enter product type</label><select name="prod-type" id="prod-type">
            <?php
            include('product_type.php');
            foreach(getProductTypes() as $type){
                echo "<option value=".$type->getId().">".$type->getCategory()."</option>";
            }
            ?>
        </select><br>
        <label for="prod-amount">Enter amount of products</label><input type="text" name="prod-amount" id="prod-amount"><br>
        <button type="submit" name="submit">Ready</button>
        <a href="../MainPage/mainpage.php">Go back</a>
        <?php
        include("products.php");
        if (isset($_POST['submit'])) {
            $cost = $_POST['cost'];
            settype($cost, 'float');

            $amount = $_POST['prod-amount'];
            settype($amount, 'int');

            $prod_type = $_POST['prod-type'];
            settype($prod_type, 'int');

            $product = new Product($_POST['name'], $_POST['descr'], $cost, $_POST['image-url'], $prod_type, $amount);
            if (validateProduct($product) == "valid") {
                if (addProduct($product)) {
                    header("Location: ../MainPage/mainpage.php");
                } else {
                    echo "Something went wrong";
                }
            } else {
                echo validateProduct($product);
            }
        }
        ?>
    </form>
</body>

</html>