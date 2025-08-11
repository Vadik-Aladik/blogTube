<?php 

    session_start();

    require_once '../vendor/models/Blog.php';

    if(!isset($_SESSION['auth']) || $_SESSION['auth'] == false){
        header("Location: sign_in.php");
        exit();
    }

    $blog = new Blog;
    $all_blog = $blog->blogUser()->all();
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

    <section class="container">
        <h1 class="my-30px text-center">Блоги пользователей</h1>
        <div class="personal_blogs flex flex-wrap justify-start">
            <?php foreach($all_blog as $elem) { ?>
                <a href="view_blog.php?blog_id=<?= urlencode($elem['id']) ?>" class="personal_blogs_users bg-white radius-5px px-10px py-16px w-340px mb-10px mr-20px">
                    <h3 class="mb-10px"><?= htmlspecialchars($elem['title'], ENT_QUOTES, "UTF-8") ?></h3>
                    <p class="mb-10px test text-base"><?= htmlspecialchars($elem['content'], ENT_QUOTES, "UTF-8") ?></p>
                    <p class="text-base text-right">author: <span class="color-main font-medium"><?= htmlspecialchars($elem['login'], ENT_QUOTES, "UTF-8") ?></span></p>
                </a>
            <?php } ?>
        </div>
    </section>
</body>
</html>