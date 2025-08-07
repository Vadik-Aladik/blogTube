<?php 

    session_start();
    require_once '../models/Blog.php';
    require_once "../classes/Validate.php";
    require_once "../classes/CSRF.php";

    $blog = new Blog;
    $isValid = new Validate;
    $csrf = new CSRF();

    $_SESSION['errors_msg'] = [];
    $_SESSION['old_data'] = [];

    $user_blog = $blog->select('blogs')->where(['id', htmlspecialchars($_GET['blog_id'], ENT_QUOTES, "UTF-8")])->one();

    if($_SESSION['user_id'] != $user_blog['user_id']){
        header("Location: personal.php");
        exit();
    }

    $isValid->rules([
        'title' => ['required', 'min(8)', 'max(256)'],
        'content' => ['required', 'min(32)', 'max(2048)'],
    ]);

    $edit_blog = $isValid->validatation([
        'title' => $_POST['title'],
        'content' => $_POST['content'],
    ]);

    $blog_data = $isValid->getData();

    if($edit_blog && $_POST['action'] == "edit" && $csrf->checkToken($_POST['token'])){
        $blog->update('blogs', ['title'=> $blog_data['title'], 'content'=> $blog_data['content']])->where(['id', htmlspecialchars($_GET['blog_id'], ENT_QUOTES, "UTF-8")])->go();

        $_SESSION['errors_msg'] = $isValid->getErrors();
        $_SESSION['old_data'] = $isValid->getData();

        header("Location: ../../views/personal.php");
        exit();
    }
    else if($_POST['action'] == 'delete' && $csrf->checkToken($_POST['token'])){
        $blog->delete("blogs")->where(['id', htmlspecialchars($_GET['blog_id'], ENT_QUOTES, "UTF-8")])->go();

        $_SESSION['errors_msg'] = $isValid->getErrors();
        $_SESSION['old_data'] = $isValid->getData();

        header("Location: ../../views/personal.php");
        exit();
    }
    else{
        $_SESSION['errors_msg'] = $isValid->getErrors();
        $_SESSION['old_data'] = $isValid->getData();

        header("Location: ../../views/edit_blog.php?blog_id=$_GET[blog_id]");
        exit();
    }

?>