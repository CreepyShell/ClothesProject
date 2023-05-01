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
    ?>
    <h1 class="title">Add product</h1>
    <a class="go-back" href="../MainPage/mainpage.php">Go back</a>
    <form class="main-form" action="addProduct.php" method="POST">
        <label class="prod-name" for="prod-name">Enter product name: </label><input type="text" name="name" id="prod-name"><br>
        <label class="prod-cost" for="prod-cost">Enter product cost: </label><input type="number" name="cost" id="prod-cost"><br>
        <label class="prod-description" for="prod-descr">Enter product description: </label><br><input type="text" name="descr" id="prod-descr"><br>
        <label class="prod-image" for="prod-url">Enter product image url: </label><input type="text" name="image-url" id="prod-url"><br>
        <label class="prod-type" for="prod-type">Enter product type: </label><select name="prod-type" id="prod-type">
            <?php
            include('product_type.php');
            foreach (getProductTypes() as $type) {
                echo '<option class="prod-type-options" value=' . $type->getId() . ">" . $type->getCategory() . "</option>";
            }
            ?>
        </select><br>
        <label class="prod-amount" for="prod-amount">Enter amount of products: </label><input type="number" min="1" name="prod-amount" id="prod-amount"><br>
        <button class="add-prod-submit" type="submit" name="submit">Ready</button>
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
                    echo '<p class="error">Something went wrong</p>';
                }
            } else {
                echo '<p class="error">'.validateProduct($product).'</p>';
            }
        }
        ?>
    </form>
</body>

</html>