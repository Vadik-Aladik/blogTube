<?php 

    session_start();

    require_once "../classes/Validate.php";
    require_once "../classes/CSRF.php";
    require_once "../models/Blog.php";

    $isValid = new Validate;
    $csrf = new CSRF();
    $blog = new Blog;
    $_SESSION['errors_msg'] = [];
    $_SESSION['old_data'] = [];

    $isValid->rules([
        'title' => ['required', 'min(8)', 'max(256)'],
        'content' => ['required', 'min(32)', 'max(2048)'],
    ]);

    $create_blog = $isValid->validatation([
        'title' => $_POST['title'],
        'content' => $_POST['content'],
    ]);

    if($create_blog && $csrf->checkToken($_POST['token']) && $_POST['action'] == 'create'){
        $data = $isValid->getData();
        $created_at = date('Y-m-d H:i:s');
        
        $new_blog = $blog->create('blogs', [
            'user_id' => $_SESSION['user_id'],
            'title' => $data['title'],
            'content' => $data['content'],
            'created_at' => $created_at
        ]);

        if($new_blog){
            if(isset($_SESSION['errors_msg']) || isset($_SESSION['old_data'])){
                unset($_SESSION['errors_msg']);
                unset($_SESSION['old_data']);
            }
            header("Location: ../../views/personal.php");
            exit();
        }
        
    }
    else if($_POST['action'] == 'back' && $csrf->checkToken($_POST['token'])){
        header("Location: ../../views/personal.php");
        exit();
    }
    else{
        $_SESSION['errors_msg'] = $isValid->getErrors();
        $_SESSION['old_data'] = $isValid->getData();

        header("Location: ../../views/create_blog.php");
        exit();
    }

?>