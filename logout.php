<?php ob_start(); session_start(); include "./includes/db.php";

    if(isset($_SESSION['user_id'])){
        $_SESSION['user_id'] = NULL;
        $_SESSION['username'] = NULL;
        $_SESSION['user_firstname'] = NULL;
        $_SESSION['user_lastname'] = NULL;
        $_SESSION['user_email'] = NULL;
        $_SESSION['user_image'] = NULL;
        $_SESSION['user_password'] = NULL;
    }
    header("Location: login.php");
?>