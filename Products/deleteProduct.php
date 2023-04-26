<?php
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

<form action="deleteProduct.php?pr_id=<?php echo $product->getId() ?>" method="POST">
    <p> Are you sure you want to delete this product?</p>
    <button type="submit" name="submit">Delete this rubbish</button>
</form>
<a href="../MainPage/mainpage.php">No, go back</a>