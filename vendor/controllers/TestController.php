<?php 

    session_start();

    require_once "../classes/CSRF.php";

    $csrf = new CSRF();
    $token = $csrf->getToken();

    echo $csrf->getToken() . '<br>';
    echo $csrf->getToken() . '<br>';
    echo $_POST['token'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
        <input type="hidden" name="token" value="<?= $token ?>">
        <input type="text" name="values">
        <input type="submit" value="send">
    </form>
</body>
</html>

<!-- http://localhost/port/vendor/controllers/TestController.php -->

<!-- http://localhost/port/views/create_blog.php -->