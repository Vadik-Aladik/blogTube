<?php 

    session_start();

    require_once '../vendor/models/Blog.php';

    if(!isset($_SESSION['auth']) || $_SESSION['auth'] == false){
        header("Location: sign_in.php");
        exit();
    }

    $blog = new Blog;
    $id_blog = htmlspecialchars($_GET['blog_id'], ENT_QUOTES, 'UTF-8');

    $user_blog = $blog->blogUser()->where(['blogs.id', "$id_blog"])->one();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="h-screen bg-main">
    
    <?php require "components/header.php" ?>

    <section class="container bg-white p-10px my-30px px-76px py-30px rounded-5px">
        <div>
            <div class="mb-30px">
                <h3><?= htmlspecialchars($user_blog['title'], ENT_QUOTES, "UTF-8") ?></h3>
                <div class="flex items-center mt-10px">
                    <p class=" text-16px color-red"><?= htmlspecialchars($user_blog['login'], ENT_QUOTES, "UTF-8") ?></p>
                    <p class="ml-10px"><?= htmlspecialchars($user_blog['created_at'], ENT_QUOTES, "UTF-8") ?></p>
                </div>
            </div>

            <div><?= htmlspecialchars($user_blog['content'], ENT_QUOTES, "UTF-8") ?></div>
        </div>
    </section>

</body>
</html>