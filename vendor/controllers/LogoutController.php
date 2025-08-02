<?php 

    session_start();
    $_SESSION = [];

    session_destroy();

    header("Location: ../../views/sign_in.php");
    exit();

?>