<?php 

    session_start();

    require_once "../classes/Validate.php";
    require_once "../models/User.php";

    $isValid = new Validate;
    $user = new User;
    $_SESSION['errors_msg'] = [];
    $_SESSION['old_data'] = [];

    $isValid->rules([
        'login' => ['required', 'min(4)', 'max(32)'],
        'email' => ['required', 'max(256)', "email", "unique(users, email)"],
        'password' => ['required', 'min(8)'],
        'password_confirm' => ['required', "same(password)"]
    ]);

    $sign_up = $isValid->validatation([
        'login' => $_POST['login'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
        'password_confirm' => $_POST['password_confirm'],
    ]);

    $data = $isValid->getData();

    if($sign_up){
        $create_user = $user->create('users', [
            'login' => $data['login'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_BCRYPT),
        ]);

        $res = $user->select('users')->where(["email", "$data[email]"])->one();
        
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
    else{
        $_SESSION['errors_msg'] = $isValid->getErrors();
        $_SESSION['old_data'] = $isValid->getData();
        header("Location: ../../views/sign_up.php");
        exit();
    }
?>

    <!-- // if($sign_up){
    //     $data = $isValid->getData();

    //     $create_user = $user->create('users', [
    //         'login' => $data['login'],
    //         'email' => $data['email'],
    //         'password' => password_hash($data['password'], PASSWORD_BCRYPT),
    //     ], 'sss');

    //     if($create_user){
    //         $data = $isValid->getData();
    //         $res = $user->select('users', 'id, login', "email = '$data[email]'");

    //         $_SESSION['auth'] = true;
    //         $_SESSION['user_id'] = $res[0]['id'];
    //         $_SESSION['user_login'] = $res[0]['login'];

    //         if(isset($_SESSION['errors_msg']) && isset($_SESSION['old_data'])){
    //             unset($_SESSION['errors_msg']);
    //             unset($_SESSION['old_data']);
    //         }

    //         header("Location: ../../views/main.php");
    //         exit();
    //     }
    // }
    // else{
    //     $_SESSION['errors_msg'] = $isValid->getErrors();
    //     $_SESSION['old_data'] = $isValid->getData();
    //     header("Location: ../../views/sign_up.php");
    //     exit();
    // } -->