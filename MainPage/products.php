<?php
function getAllProducts()
{
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=clothes; charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM products";
        $result = $pdo->query($sql);
        while ($row = $result->fetch()) {
            $bt = $row["name"];
            echo $bt . '--' . $row["cost"];
        }
    } catch (PDOException $e) {
        $output = 'Unable to connect to the database server: '
            . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
    }
}
function addProduct($name, $cost, $typeId, $image_url)
{
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=clothes; charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $insertSql = "INSERT INTO PRODUCTS(cost, TypeId, name, image_url)
         VALUES(:cost, :TypeId, :name, :image_url)";
        $resultInsert = $pdo->prepare($insertSql);
        $resultInsert->bindValue(':cost', $cost);
        $resultInsert->bindValue(':TypeId', $typeId);
        $resultInsert->bindValue(':name', $name);
        $resultInsert->bindValue(':image_url', $image_url);

        $resultInsert->execute();
        
    } catch (PDOException $e) {
        $output = 'Unable to connect to the database server: '
            . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
    }
}
?>