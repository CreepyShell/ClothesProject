<?php try {
    $pdo = new PDO('mysql:host=localhost;dbname=clothes; charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM users WHERE email=:cemail";
    $result = $pdo->prepare($sql);
    $result->bindValue(':cemail', $_POST['email']);
    $result->execute();
    if ($result->rowCount() > 0) {
        $row = $result->fetch();
        if ($row['password'] == $_POST['password']) {
            echo 'login';
        }
    }
} catch (PDOException $e) {
    $output = 'Unable to connect to the database server: ' . $e->getMessage();
}
