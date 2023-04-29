<?php

declare(strict_types=1);
include('../Models/product_type.php');
function getProductTypes()
{
    $type_query = "SELECT * FROM product_types";
    $pdo = new PDO('mysql:host=localhost;dbname=clothes; charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $result = $pdo->query($type_query);
    $prod_type_array = array();
    while ($row = $result->fetch()) {
        $prod_type = new ProductType();
        $prod_type->setDescription($row['description']);
        $prod_type->setCategory($row['category']);
        $prod_type->setId($row['id']);
        array_push($prod_type_array, $prod_type);
    }
    return $prod_type_array;
}
