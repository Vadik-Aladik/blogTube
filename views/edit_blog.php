<?php 

    session_start();
    require_once '../vendor/models/Blog.php';

    if(!isset($_SESSION['auth']) || $_SESSION['auth'] == false){
        header("Location: sign_in.php");
        exit();
    }

    $blog = new Blog();

    $user_blog = $blog->select('blogs')->where(['id', htmlspecialchars($_GET['blog_id'], ENT_QUOTES, "UTF-8")])->one();

    $_SESSION['old_data']['title'] = $user_blog['title'];
    $_SESSION['old_data']['content'] = $user_blog['content'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create blog</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="h-screen bg-main flex">

    <form action="../vendor/controllers/EditBlogController.php?blog_id=<?= urlencode($_GET['blog_id']) ?>" method="POST" class="w-560px py-30px bg-white radius-5px m-auto flex flex-col items-center">
        
        <div class="my-10px flex flex-col items-end">
            <input class="w-406px border-solid-gray  p-6px radius-5px" type="text" name="title" value="<?php if(isset($_SESSION['old_data']['title'])) echo htmlspecialchars($_SESSION['old_data']['title'], ENT_QUOTES, "UTF-8") ?>">
            <p class="text-right color-red w-367px"><?php if(isset($_SESSION['errors_msg']['title'])) echo htmlspecialchars($_SESSION['errors_msg']['title'][0], ENT_QUOTES, "UTF-8") ?></p>
        </div>

        <div class="mb-30px flex flex-col items-end">
            <textarea class="w-406px resize-none h-190px border-solid-gray p-6px radius-5px" name="content" id=""><?php if(isset($_SESSION['old_data']['content'])) echo htmlspecialchars($_SESSION['old_data']['content'], ENT_QUOTES, "UTF-8") ?></textarea>
            <p class="text-right color-red w-367px"><?php if(isset($_SESSION['errors_msg']['content'])) echo htmlspecialchars($_SESSION['errors_msg']['content'][0], ENT_QUOTES, "UTF-8") ?></p>
        </div>

        <div class="w-406px flex justify-between">
            <button type="submit" name="delete" value="true" class="text-base bg-main p-10px border-none radius-5px">Удалить блог</button>
            <button type="submit" name="edit" value="true" class="text-base bg-main p-10px border-none radius-5px">Редактировать</button>
        </div>
    </form>
</body>
</html>

<?php 

    if(isset($_SESSION['errors_msg']) || isset($_SESSION['old_data'])){
        unset($_SESSION['errors_msg']);
        unset($_SESSION['old_data']);
    }

?>
