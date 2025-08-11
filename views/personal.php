<?php 

    session_start();
    require_once '../vendor/models/Blog.php';

    if(!isset($_SESSION['auth']) || $_SESSION['auth'] == false){
        header("Location: sign_in.php");
        exit();
    }

    $blog = new Blog;
    $blogs_user = $blog->select("blogs")->where(["user_id", $_SESSION['user_id']])->all();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="h-screen bg-main">

    <?php require "components/header.php" ?>

    <section class="container">

        <div class="flex bg-white py-16px px-10px my-30px justify-between items-center personal">
            <h1>Здравствуйте, <span class="color-main"><?= $_SESSION['user_login'] ?></span></h1>

            <div class="flex personal_but w-500px justify-between">
                <a href="create_blog.php" class="a_but text-24 bg-main p-10px border-none radius-5px">Создать новый блог</a>
                <a href="../vendor/controllers/LogoutController.php" class="a_but text-24 bg-main p-10px border-none radius-5px">Выйти из аккаунта</a>
            </div>
        </div>

        <div class="main_blogs flex flex-wrap justify-start">
            <?php foreach($blogs_user as $elem) { ?>
                <a href="edit_blog.php?blog_id=<?= urlencode($elem['id']) ?>" class="main_blogs_users bg-white radius-5px px-10px py-16px w-340px mb-10px mr-20px">
                    <h3 class="mb-10px"><?= htmlspecialchars($elem['title'], ENT_QUOTES, "UTF-8") ?></h3>
                    <p class="mb-10px test text-base"><?= htmlspecialchars($elem['content'], ENT_QUOTES, "UTF-8") ?></p>
                    <p class="text-base text-right">author: <span class="color-main font-medium"><?= htmlspecialchars($_SESSION['user_login'], ENT_QUOTES, "UTF-8") ?></span></p>
                </a>
            <?php } ?>
        </div>
    </section>
    
</body>
</html>