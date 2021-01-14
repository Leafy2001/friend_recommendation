<?php include "header.php"; ?>

<body>

<?php
    if(!isset($_SESSION['user_id'])){
        header("Location: ../login.php");
        die;
    }

    if(isset($_POST['submit'])){
        $text = $_POST['search'];
        echo "You searched for : ".$text."<br />";
        $query = "SELECT * FROM users WHERE username LIKE '%$text%';";
        $result = mysqli_query($connection, $query);
        if(!$result){
            die("ERROR ".mysqli_error($connection));
        }
        while($row = mysqli_fetch_assoc($result)){
    ?>
    <a href = "../profile.php?profile_id=<?php echo $row['user_id']; ?>"><?php echo $row['username']; ?></a>        
    <?php    }
    }

?>

</body>