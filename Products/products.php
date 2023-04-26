<?php

declare(strict_types=1);
include('../Models/product.php');

function getAllProducts()
{
    $sql = "SELECT * FROM products";
    return getProductsByQuery($sql);
}

function addProduct(Product $product)
{
    $pdo = new PDO('mysql:host=localhost;dbname=clothes; charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $insertSql = "INSERT INTO PRODUCTS(cost, TypeId, name, image_url, description, Amount)
         VALUES(:cost, :TypeId, :name, :image_url, :description, :amount)";
    $resultInsert = $pdo->prepare($insertSql);
    $resultInsert->bindValue(':cost', $product->getCost());
    $resultInsert->bindValue(':TypeId', $product->getTypeId());
    $resultInsert->bindValue(':name', $product->getName());
    $resultInsert->bindValue(':image_url', $product->getImage());
    $resultInsert->bindValue(':description', $product->getDescription());
    $resultInsert->bindValue(':amount', $product->getAmount());

    $resultInsert->execute();
    return true;
}

function getProductById(int $id)
{
    $pdo = new PDO('mysql:host=localhost;dbname=clothes; charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM products WHERE product_id=" . $id;
    $result = $pdo->query($sql);
    if ($result->rowCount() == 1) {
        $row = $result->fetch();
        $product = new Product(
            (int)$row['product_id'],
            $row['name'],
            $row['description'],
            (float)$row['cost'],
            $row['image_url'],
            (int)$row['TypeId'],
            (int) $row['Amount']
        );
        return $product;
    }
    return null;
}

function updateProduct(int $id, Product $product)
{
    $pdo = new PDO('mysql:host=localhost;dbname=clothes; charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = 'update products set name=:name, description = :description, cost = :cost, image_url = :img_url WHERE product_id = :id';
    $result = $pdo->prepare($sql);
    $result->bindValue(':id', $id);
    $result->bindValue(':name', $product->getName());
    $result->bindValue(':description', $product->getDescription());
    $result->bindValue(':cost', $product->getCost());
    $result->bindValue(':img_url', $product->getImage());
    $result->execute();

    $count = $result->rowCount();
    if ($count > 0) {
        return true;
    }
    return false;
}

function deleteProduct(int $id)
{
    $pdo = new PDO('mysql:host=localhost;dbname=clothes; charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = 'DELETE FROM products WHERE product_id = :id';
    $result = $pdo->prepare($sql);
    $result->bindValue(':id', $id);
    $result->execute();
    if ($result->rowCount() == 1) {
        return true;
    }
    return false;
}

function validateProduct(Product $product)
{
    if (strlen($product->getName()) < 4 || strlen($product->getName()) > 30) {
        return "Invalid name";
    }
    if (strlen($product->getDescription()) > 100) {
        return "Invalid description";
    }

    if (strlen($product->getImage()) > 120) {
        return "Invalid imageUrl";
    }

    if ($product->getCost() <= 0 || $product->getCost() > 10000) {
        return "Invalid product cost";
    }

    if ($product->getAmount() < 0) {
        return "Invalid products amount";
    }
    return "valid";
}

function getProductsByQuery(string $query)
{
    $pdo = new PDO('mysql:host=localhost;dbname=clothes; charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $result = $pdo->query($query);
    $prod_array = array();
    while ($row = $result->fetch()) {
        array_push($prod_array, new Product(
            $row['product_id'],
            $row['name'],
            $row['description'],
            (float)$row['cost'],
            $row['image_url'],
            $row['TypeId'],
            $row['Amount']
        ));
    }
    return $prod_array;
}

function buyProducts(array $ids, int $user_id)
{
    if (sizeof($ids) == 0) {
        return "array is empty";
    }

    $pdo = new PDO('mysql:host=localhost;dbname=clothes; charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $getProductsQuery = 'SELECT product_id, amount FROM Products WHERE ';
    foreach ($ids as $id) {
        $getProductsQuery . 'product_id=' . $id . ' OR ';
    }

    //check is there is enough products in the stock 
    $result = $pdo->query($getProductsQuery);
    while ($row = $result->fetch()) {
        if((int)$row['amount'] < $ids[(int)$row['product_id']][0]){
            return '';
        }
    }

    $insertSql = "INSERT INTO purchase_item(user_id, product_id, purchase_date, amount)
    VALUES(:user_id, :product_id, :purchase_date, :amount)";
    $resultInsert = $pdo->prepare($insertSql);
    $resultInsert->bindValue(':user_id', $user_id);
    $resultInsert->bindValue(':product_id', $ids[0]);
    $resultInsert->bindValue(':purchase_date', date("d/m/Y"));
    $resultInsert->bindValue(':amount', $ids[0][0]);
}
