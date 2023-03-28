<?php
include('mainpage.html');
session_start();
getAllProducts();
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
        .$e->getMessage().' in '.$e->getFile().':' . $e->getLine(); 
        
    }
}

