<?php 

    session_start();

    require_once "../vendor/classes/CSRF.php";
    $csrf = new CSRF();

    if(isset($_SESSION['auth']) && $_SESSION['auth'] == true){
        header("Location: main.php");
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="flex h-screen bg-main">
    <form class="bg-white w-560px flex flex-col items-center m-auto py-30px radius-5px" action="../vendor/controllers/SignInController.php" method="POST">
        <h2 class="mb-20px color-main">ВХОД</h2>
        <input type="hidden" name="token" value="<?= $csrf->getToken() ?>">

        <div class="mt-10px flex flex-col items-end">
            <input class="sign_field w-367px p-6px radius-5px border-solid-gray" type="text" name="email" placeholder="Введите почту" value="<?php if(isset($_SESSION['old_data']['email'])) echo $_SESSION['old_data']['email'] ?>">
            <p class="sign_errors text-right color-red w-367px"><?php if(isset($_SESSION['errors_msg']['email'])) echo $_SESSION['errors_msg']['email'][0] ?></p>
        </div>
        
        <div class="mt-10px flex flex-col items-end">
            <input class="sign_field w-367px p-6px radius-5px border-solid-gray" type="password" name="password" placeholder="Введите пароль" value="<?php if(isset($_SESSION['old_data']['password'])) echo $_SESSION['old_data']['password'] ?>">
            <p class="sign_errors text-right color-red w-367px"><?php if(isset($_SESSION['errors_msg']['password'])) echo $_SESSION['errors_msg']['password'][0] ?></p>
        </div>
        
        <button type="submit" class="mt-30px text-24 bg-main p-10px border-none radius-5px">Войти</button>
        <a href="sign_up.php" class="mt-10px">У меня нет <span class="color-main">аккаунта</span></a>
    </form>
</body>
</html>

<?php 

    if(isset($_SESSION['errors_msg']) && isset($_SESSION['old_data'])){
        unset($_SESSION['errors_msg']);
        unset($_SESSION['old_data']);
    }

?>