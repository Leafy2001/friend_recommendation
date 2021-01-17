<head><link rel="stylesheet" href="./includes/css/index.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"></head>

<?php include "./includes/header.php";
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    die;
}

$current_user_id = $_SESSION['user_id'];
if(isset($_GET['accept_id'])){
    $accept_id = $_GET['accept_id'];
    $query = "UPDATE relationship SET request_accepted = 1 WHERE ";
    $query .= "request_by = $accept_id AND request_to = $current_user_id;";

    $result = mysqli_query($connection, $query);
    if(!$result){
        echo $query;
        die("ERROR ".mysqli_error($connection));
    }
    header("Location: friend_requests.php");
    die;
}
?>

<body>
    <?php include "./includes/navigation.php"; ?>
    <div class="well">
        <h4 class="sf">Search Friends</h4>
        <form action = "./includes/search_result.php" method = "post" target="_blank">
            <div class="input-group sb">
                <input name = "search" type="text" class="form-control ">
                <span class="input-group-btn">
                    <button name = "submit" class="btn btn-default ic" type="submit">
                        <i class="fa fa-search fa-lg "></i>
                </button>
                </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>
    <h2 class="sf">Current User: </h2>
    <div class="CurrentUser">
      <div class="CurrentUser__left">
      <img class="CurrentUser__leftImg" src = "./includes/images/<?php echo $_SESSION['user_image']; ?>" width=50/>
      </div>
      <div class="CurrentUser__right">
        <h2><?php echo $_SESSION['username']; ?></h2>
        <h3><?php echo $_SESSION['user_firstname']." ".$_SESSION['user_lastname']; ?></h3>
        <h4><?php echo $_SESSION['user_email']; ?></h4>
      </div>


    </div>

    <div>
        <h2 class="sf">Friend Requests : </h2>
        <?php
            $user_id = $_SESSION['user_id'];
            $query = "SELECT * FROM relationship INNER JOIN users ON users.user_id = relationship.request_by ";
            $query .= "WHERE (request_to = $user_id AND request_accepted = 0);";
            $result = mysqli_query($connection, $query);
            if(!$result){
                echo $query;
                die("ERROR ".mysqli_error($connection));
            }
            while($row = mysqli_fetch_assoc($result)){
                $img = $row['user_image'];
                ?>
                <figure class=" grid-item ">
                    <img src = "./includes/images/<?php echo $img; ?>" width=100/>
                    <a href = "profile.php?profile_id=<?php echo $row['user_id']; ?>">
                        <figcaption><?php echo $row['username']; ?></figcaption>
                    </a>
                    <a href="friend_requests.php?accept_id=<?php echo $row['user_id']; ?>">Accept Request</a>
                </figure>
        <?php
            }

        ?>
    </div>

<?php include "./includes/footer.php";
