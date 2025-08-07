<?php 

    session_start();

    require_once "../classes/Validate.php";
    require_once "../classes/Database.php";
    require_once "../models/User.php";
    require_once "../classes/CSRF.php";

    $isValid = new Validate;
    $user = new User;
    $csrf = new CSRF();

    $_SESSION['errors_msg'] = [];
    $_SESSION['old_data'] = [];

    $isValid->rules([
        'email' => ['required', "email", 'max(256)', "exists(users)"],
        'password' => ['required', 'min(8)'],
    ]);

    $sign_in = $isValid->validatation([
        'email' => $_POST['email'],
        'password' => $_POST['password'],
    ]);

    $data = $isValid->getData();
    $res = $user->select('users')->where(["email", "$data[email]"])->one();

    $password_verify = password_verify($data['password'], $res['password']);

    if($sign_in && $password_verify && $csrf->checkToken($_POST['token'])){
        $_SESSION['auth'] = true;
        $_SESSION['user_id'] = $res['id'];
        $_SESSION['user_login'] = $res['login'];
        
        if(isset($_SESSION['errors_msg']) && isset($_SESSION['old_data'])){
            unset($_SESSION['errors_msg']);
            unset($_SESSION['old_data']);
        }
        
        header("Location: ../../views/main.php");
        exit();
    }
    else if($sign_in && $csrf->checkToken($_POST['token'])){
        $isValid->errors_msg['password'][] = "Неправильно введен пароль";

        $_SESSION['errors_msg'] = $isValid->getErrors();
        $_SESSION['old_data'] = $isValid->getData();
        header("Location: ../../views/sign_in.php");
        exit();
    }
    else{
        $_SESSION['errors_msg'] = $isValid->getErrors();
        $_SESSION['old_data'] = $isValid->getData();
        header("Location: ../../views/sign_in.php");
        exit();
    }

?>