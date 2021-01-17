<?php include "./includes/header.php" ?>
<head><link rel="stylesheet" href="./includes/css/login.css"></head>

<?php
    if(isset($_SESSION['user_id'])){
        header("Location: index.php");
        die;
    }
    if(isset($_POST['login'])){
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];

        $query = "SELECT * FROM users WHERE (user_email = '$user_email') LIMIT 1";
        $result = mysqli_query($connection, $query);
        if(!$result){
            die("BAD DATA ".mysqli_error($connection));
        }
        if(mysqli_num_rows($result) == 0){
            header("Location: login.php");
        }
        $row = mysqli_fetch_assoc($result);

        $firstname = $row['user_firstname'];
        $lastname = $row['user_lastname'];
        $user_id = $row['user_id'];
        $user_image = $row['user_image'];
        $username = $row['username'];

        $db_email = $row['user_email'];
        $db_password = $row['user_password'];

        if($db_email !== $user_email || $db_password !== $user_password){
            header("Location: login.php");
            die;
        }

        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username;
        $_SESSION['user_firstname'] = $firstname;
        $_SESSION['user_lastname'] = $lastname;
        $_SESSION['user_email'] = $db_email;
        $_SESSION['user_image'] = $user_image;
        $_SESSION['user_password'] = $db_password;
        header("Location: index.php");
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
                            <label class="mb-1"><h6 class="mb-0 text-sm">Email Address</h6></label>
                            <input class="mb-4" type="text" name="user_email" placeholder="Enter a valid email address">
                        </div>
                        <div class="row px-3">
                            <label class="mb-1"><h6 class="mb-0 text-sm">Password</h6></label>
                            <input type="password" name="user_password" placeholder="Enter password" />
                        </div>
                        <br/>
                        <div class="row mb-3 px-3">
                            <button type="submit" class="btn btn-blue text-center" name = "login">Login</button>
                        </div>
                    </form>
                    <div class="row mb-4 px-3"> <small class="font-weight-bold">Don't have an account?
                        <a class="text-danger" href = "register.php">Register</a></small>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-blue py-4">
            <div class="row px-3"> <small class="ml-4 ml-sm-5 mb-2">Copyright &copy; 2020. All rights reserved.</small>
        </div>
    </div>
</div>
