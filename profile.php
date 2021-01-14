<?php include "./includes/header.php"; ?>
<?php

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
}

$current_user_id = $_SESSION['user_id'];

if(isset($_GET['unfriend_id'])){
    $remove_friend_id = $_GET['unfriend_id'];
    $query = "DELETE FROM relationship WHERE ";
    $query .= "(request_by = $current_user_id AND request_to = $remove_friend_id) ";
    $query .= "OR (request_by = $remove_friend_id AND request_to = $current_user_id); ";
    $result = mysqli_query($connection, $query);
    if(!$result){
        die("ERROR ".mysqli_error($connection));
    }
    header("Location: profile.php?profile_id=$remove_friend_id");
    die;
}

if(isset($_GET['addfriend_id'])){
    $add_friend_id = $_GET['addfriend_id'];
    $query = "INSERT INTO relationship (request_by, request_to, request_accepted) VALUES ";
    $query .= "($current_user_id, $add_friend_id, 0);";
    
    $result = mysqli_query($connection, $query);
    if(!$result){
        echo $query;
        die("ERROR ".mysqli_error($connection));
    }
    header("Location: profile.php?profile_id=$add_friend_id");
    die;
}

if(isset($_GET['accept_id'])){
    $accept_id = $_GET['accept_id'];
    $query = "UPDATE relationship SET request_accepted = 1 WHERE ";
    $query .= "request_by = $accept_id AND request_to = $current_user_id;";
    
    $result = mysqli_query($connection, $query);
    if(!$result){
        echo $query;
        die("ERROR ".mysqli_error($connection));
    }
    header("Location: profile.php?profile_id=$accept_id");
    die;
}

if(isset($_GET['profile_id'])){
    $profile_id = $_GET['profile_id'];
    $query = "SELECT * FROM users WHERE user_id = $profile_id;";
    $result = mysqli_query($connection, $query);
    if(!$result){
        die("ERROR ".mysqli_error($connection));
    }
    $row = mysqli_fetch_assoc($result);
    $username = $row['username'];
}

?>
<body>
    <?php include "./includes/navigation.php"; ?>
    <br/>
    <figure>
        <img src = "./includes/images/<?php echo $row['user_image']; ?>" width = 300/>
        <figcaption><?php echo $username; ?></figcaption>
    </figure>
    <h1><?php echo $username; ?></h1>
    <h2><?php echo $row['user_firstname']." ".$row['user_lastname']; ?></h2>
    <h2><?php echo $row['user_email']; ?></h2>
    <?php
        $query = "SELECT * FROM relationship WHERE ";
        $query .= "(request_by = $current_user_id AND request_to = $profile_id AND request_accepted = 0);";
        $result = mysqli_query($connection, $query);
        if(!$result){die("ERROR ".mysqli_error($connection));}

        if(mysqli_num_rows($result) > 0){
            echo "REQUEST SENT";
        }else{

            $query = "SELECT * FROM relationship WHERE ";
            $query .= "(request_by = $current_user_id AND request_to = $profile_id AND request_accepted = 1);";
            $result = mysqli_query($connection, $query);
            if(!$result){die("ERROR ".mysqli_error($connection));}

            if(mysqli_num_rows($result) > 0){ ?>
                <a href = "profile.php?unfriend_id=<?php echo $profile_id; ?>">UNFRIEND</a>
    <?php   }else{

                $query = "SELECT * FROM relationship WHERE ";
                $query .= "(request_by = $profile_id AND request_to = $current_user_id AND request_accepted = 1);";
                $result = mysqli_query($connection, $query);
                if(!$result){die("ERROR ".mysqli_error($connection));}

                if(mysqli_num_rows($result) > 0){ ?>
                    <a href = "profile.php?unfriend_id=<?php echo $profile_id; ?>">UNFRIEND</a>
        <?php   }else{

                    $query = "SELECT * FROM relationship WHERE ";
                    $query .= "(request_by = $profile_id AND request_to = $current_user_id AND request_accepted = 0);";
                    $result = mysqli_query($connection, $query);
                    if(!$result){die("ERROR ".mysqli_error($connection));}

                    if(mysqli_num_rows($result) > 0){ ?>
                        <a href = "profile.php?accept_id=<?php echo $profile_id; ?>">ACCEPT REQUEST</a>
            <?php   }else{
                        if($profile_id == $current_user_id){

                        }else{ ?>
                            <a href = "profile.php?addfriend_id=<?php echo $profile_id; ?>">ADD FRIEND</a>
                <?php   }
                        
                    }
                }
            }
        }
    ?>
            

</body>

<?php include "./includes/footer.php"; 