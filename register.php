<?php include "./includes/header.php" ?>
<head><link rel="stylesheet" href="./includes/css/register.css"></head>

<?php ob_start(); session_start(); ?>
<?php include "./includes/db.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Friend Recommendation System - By Shashank Parmar</title>
</head>

<?php

if(isset($_SESSION['user_id'])){
    header("Location: index.php");
    die;
}

if(isset($_POST['register'])){
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $confirm_user_password = $_POST['confirm_user_password'];
    if($user_password !== $confirm_user_password){
        header("Location: register.php");
        die;
    }
    $query = "INSERT INTO users (username, user_email, user_password, user_firstname, user_lastname, user_image) VALUES ";
    $query .= "('$username', '$user_email', '$user_password', 'F_NAME', 'L_NAME', 'default.jpg');";
    $result = mysqli_query($connection, $query);
    if(!$result){
        // header("Location: register.php");
        die("ERROR ".mysqli_error($connection));
    }
    header("Location: login.php");
    die;
}

?>
<div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
    <div class="card card0 border-0">
        <div class="row d-flex">
            <div class="col-lg-6">
                <div class="card1 pb-5">
                    <div class="row"> <img src="https://i.imgur.com/CXQmsmF.png" class="logo"> </div>
                    <div class="row px-3 justify-content-center mt-4 mb-5 border-line"> <img src="https://i.imgur.com/uNGdWHi.png" class="image"> </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card2 card border-0 px-4 py-5">
                    <form action = "" method = "post">
                        <div class="row px-3">
                          <label for="title">Username</label>
                          <input type="text" class="form-control" name="username" placeholder="Enter your username" required/>
                        </div>
                        <div class="row px-3">
                          <label for="title">Email</label>
                          <input type="text" class="form-control" name="user_email" placeholder="Enter your email" required/>
                        </div>
                        <div class="row px-3">
                          <label for="title">Password</label>
                          <input type="text" class="form-control" name = "user_password" placeholder="Enter password" required/>
                        </div>
                        <div class="row px-3">
                          <label for="title">Confirm Password</label>
                          <input type="text" class="form-control" name = "confirm_user_password" placeholder="Re Enter password" required/>
                        </div>
                        <br/>
                        <div class="row mb-3 px-3">
                            <button type="submit" class="btn btn-blue text-center" name = 'register' value = 'REGISTER'>Register</button>
                        </div>
                    </form>
                    <div class="row mb-4 px-3"> <small class="font-weight-bold">Already have an account?
                        <a class="text-danger" href = "login.php">Login</a></small>
                    </div>

                </div>
            </div>
        </div>
        <div class="bg-blue py-4">
            <div class="row px-3"> <small class="ml-4 ml-sm-5 mb-2">Copyright &copy; 2020. All rights reserved.</small>
        </div>
    </div>
</div>
