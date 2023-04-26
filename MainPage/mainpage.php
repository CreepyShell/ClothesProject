<?php
session_start();
getAllProducts();
function getAllProducts()
{
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=clothes; charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        <?php }
            if(isset($_POST['cart-button'])){
                    
            }

