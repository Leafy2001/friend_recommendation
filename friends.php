<?php include "./includes/header.php"; 
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    die;
}
?>

<body>
    <?php include "./includes/navigation.php"; ?>
    <div class="well">
        <h4>Search Friends</h4>
        <form action = "./includes/search_result.php" method = "post" target="_blank">
            <div class="input-group">
                <input name = "search" type="text" class="form-control">
                <span class="input-group-btn">
                    <button name = "submit" class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                </button>
                </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>
    <h2><?php echo $_SESSION['username']; ?></h2>
    <h3><?php echo $_SESSION['user_firstname']." ".$_SESSION['user_lastname']; ?></h3>
    <img src = "./includes/images/<?php echo $_SESSION['user_image']; ?>" width=50/>
    <div>
        <h2>Current FRIENDs : </h2>
        <?php 
            $user_id = $_SESSION['user_id'];
            $query = "SELECT * FROM relationship INNER JOIN users ON users.user_id = relationship.request_to "; 
            $query .= "WHERE (request_by = $user_id AND request_to != $user_id AND request_accepted = 1);";
            $result = mysqli_query($connection, $query);
            if(!$result){
                echo $query;
                die("ERROR ".mysqli_error($connection));
            }
            while($row = mysqli_fetch_assoc($result)){
                $img = $row['user_image'];
                ?>
                <figure style="display:inline-block">
                    <img src = "./includes/images/<?php echo $img; ?>" width=100/>
                    <a href = "profile.php?profile_id=<?php echo $row['user_id']; ?>">
                        <figcaption><?php echo $row['username']; ?></figcaption>
                    </a>
                </figure>
        <?php
            }

            $query = "SELECT * FROM relationship INNER JOIN users ON users.user_id = relationship.request_by "; 
            $query .= "WHERE (request_by != $user_id AND request_to = $user_id AND request_accepted = 1);";
            $result = mysqli_query($connection, $query);
            if(!$result){
                echo $query;
                die("ERROR ".mysqli_error($connection));
            }
            while($row = mysqli_fetch_assoc($result)){
                $img = $row['user_image'];
                ?>
                <figure style="display:inline-block">
                    <img src = "./includes/images/<?php echo $img; ?>" width=100/>
                    <a href = "profile.php?profile_id=<?php echo $row['user_id']; ?>">
                        <figcaption><?php echo $row['username']; ?></figcaption>
                    </a>
                </figure>
        <?php
            }

        ?>
    </div>

<?php include "./includes/footer.php"; 
