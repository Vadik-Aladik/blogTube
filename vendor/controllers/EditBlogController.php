<?php 

    session_start();
    require_once '../models/Blog.php';
    require_once "../classes/Validate.php";
    $isValid = new Validate;
    $blog = new Blog;
    $_SESSION['errors_msg'] = [];
    $_SESSION['old_data'] = [];

    $isValid->rules([
        'title' => ['required', 'min(8)', 'max(256)'],
        'content' => ['required', 'min(32)', 'max(2048)'],
    ]);

    $edit_blog = $isValid->validatation([
        'title' => $_POST['title'],
        'content' => $_POST['content'],
    ]);

    $blog_data = $isValid->getData();

    if($edit_blog && isset($_POST['edit'])){
        $blog->update('blogs', ['title'=> $blog_data['title'], 'content'=> $blog_data['content']])->where(['id', htmlspecialchars($_GET['blog_id'], ENT_QUOTES, "UTF-8")])->go();

        $_SESSION['errors_msg'] = $isValid->getErrors();
        $_SESSION['old_data'] = $isValid->getData();

        header("Location: ../../views/personal.php");
        exit();
    }
    else if(isset($_POST['delete'])){
        $blog->delete("blogs")->where(['id', htmlspecialchars($_GET['blog_id'], ENT_QUOTES, "UTF-8")])->go();

        $_SESSION['errors_msg'] = $isValid->getErrors();
        $_SESSION['old_data'] = $isValid->getData();

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