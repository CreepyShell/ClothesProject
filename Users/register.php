<?php try {
    $pdo = new PDO('mysql:host=localhost;dbname=clothes; charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM users WHERE email=:cemail";
    $result = $pdo->prepare($sql);
    $result->bindValue(':cemail', $_POST['email']);
    $result->execute();
    if ($result->rowCount() == 0) {
        $password = $_POST['password'];
        $insertSql = "INSERT INTO USERS VALUES(:cemail, :cpassword)";
        $resultInsert = $pdo->prepare($sql);
        $resultInsert->bindValue(':cemail', $_POST['email']);
        $resultInsert->bindValue(':cpassword', $_POST['password']);
        $resultInsert->execute();
        if ($resultInsert->rowCount() == 0) {
            header('mainpage.php');
        }
    }
} catch (PDOException $e) {
    $output = 'Unable to connect to the database server: ' . $e->getMessage();
}
