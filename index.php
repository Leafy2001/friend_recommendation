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
        <h2>FRIEND SUGGESTIONS : </h2>
        <?php include "recommend_friends.php"; ?>
    </div>

<?php include "./includes/footer.php"; 
