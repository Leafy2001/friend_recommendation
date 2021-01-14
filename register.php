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
    $query = "INSERT INTO users (username, user_email, user_password) VALUES ";
    $query .= "('$username', '$user_email', '$user_password');";
    $result = mysqli_query($connection, $query);
    if(!$result){
        // header("Location: register.php");
        die("ERROR ".mysqli_error($connection));
    }
    header("Location: login.php");
    die;
}

?>

<body>
    <form action="" method = "post">
        <div class="form-group">
            <label for="title">Username</label>
            <input type="text" class="form-control" name="username" required/>
        </div>
        
        <div class="form-group">
            <label for="title">Email</label>
            <input type="text" class="form-control" name="user_email" required/>
        </div>

        <div class="form-group">
            <label for="title">Password</label>
            <input type="text" class="form-control" name = "user_password" required/>
        </div>

        <div class="form-group">
            <label for="title">Confirm Password</label>
            <input type="text" class="form-control" name = "confirm_user_password" required/>
        </div>

        <div class = "form-group">
            <input class = 'btn btn-primary' type='submit' name = 'register' value = 'REGISTER'/>
        </div>
    </form>
    <div class="row mb-4 px-3"> <small class="font-weight-bold">Already have an account? 
        <a class="text-danger" href = "login.php">Login</a></small> 
    </div>

</body>