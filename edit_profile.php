<?php include "./includes/header.php"; 
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    die;
}

if(isset($_POST['update_profile'])){
    $user_id = $_SESSION['user_id'];
    $username = $_POST['username'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_password = $_POST['user_password'];
    $user_email = $_POST['user_email'];
    
    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];

    $milliseconds = round(microtime(true) * 1000);
    $new_name = $milliseconds.$user_image;
    move_uploaded_file($user_image_temp, "./includes/images/$new_name");

    if(empty($user_image)){
        $query = "SELECT * FROM users WHERE user_id = $user_id LIMIT 1;";
        $select_img = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($select_img);
        $new_name = $row['user_image'];
    }

    $query = "UPDATE users ";
    $query .= "SET username = '$username', ";
    $query .= "user_firstname = '$user_firstname', ";
    $query .= "user_lastname = '$user_lastname', ";
    $query .= "user_password = '$user_password', ";
    $query .= "user_email = '$user_email', ";
    $query .= "user_image = '$new_name' ";
    $query .= "WHERE user_id = $user_id;";

    $result = mysqli_query($connection, $query);
    if(!$result){
        echo $query."<br/>";
        die("ERROR OCCURED ".mysqli_error($connection));
    }

    $_SESSION['username'] = $username;
    $_SESSION['user_firstname'] = $user_firstname;
    $_SESSION['user_lastname'] = $user_lastname;
    $_SESSION['user_email'] = $user_email;
    $_SESSION['user_image'] = $new_name;
    $_SESSION['user_password'] = $user_password;

    header("Location: edit_profile.php");
}

?>

<body>
    <?php include "./includes/navigation.php"; ?>
    
    <form action="" method = "post" enctype="multipart/form-data">

        <div class="form-group">
            <label for="title">Username</label>
            <input type="text" class="form-control" name="username" value="<?php echo $_SESSION['username']; ?>"/>
        </div>

        <div class="form-group">
            <img src = "./includes/images/<?php echo $_SESSION['user_image']; ?>" width="300"/>
            <label for="user_image">User Image</label>
            <input type="file" name = "user_image"/>
        </div>

        <div class="form-group">
            <label for="title">First Name</label>
            <input type="text" class="form-control" name="user_firstname" value="<?php echo $_SESSION['user_firstname']; ?>"/>
        </div>

        <div class="form-group">
            <label for="title">Last Name</label>
            <input type="text" class="form-control" name="user_lastname" value="<?php echo $_SESSION['user_lastname']; ?>"/>
        </div>

        <div class="form-group">
            <label for="title">Email</label>
            <input type="text" class="form-control" name="user_email" value="<?php echo $_SESSION['user_email']; ?>"/>
        </div>

        <div class="form-group">
            <label for="title">Password</label>
            <input type="text" class="form-control" name = "user_password" value="<?php echo $_SESSION['user_password']; ?>"/>
        </div>

        <div class = "form-group">
            <input class = 'btn btn-primary' type='submit' name = 'update_profile' value = 'UPDATE'/>
        </div>
    </form>
    

<?php include "./includes/footer.php"; 
