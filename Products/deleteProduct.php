<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Users/login.php");
}
include("products.php");
$product = getProductById((int)$_GET['pr_id']);
if (is_null($product)) {
    header("Location: ../MainPage/mainpage.php");
}
if (isset($_POST['submit']) && !is_null($product)) {
    if (deleteProduct($product->id)) {
        header("Location: ../MainPage/mainpage.php");
        return;
    }
    echo '<p>Sorry, something went wrong, can not delete a project</p>';
}
?>
<html>

<head>
    <link rel="stylesheet" href="../MainPage/Styles/products.css">
</head>

<body>
    <h2 class="title"> Are you sure you want to delete this product?</h2>
    <a class="go-back" href="../MainPage/mainpage.php">No, go back</a>
    <form class="main-form" action="deleteProduct.php?pr_id=<?php echo $product->getId() ?>" method="POST">
        <button class="delete-prod-submit" type="submit" name="submit">Delete this rubbish</button>
    </form>
</body>

</html>