<head><link rel="stylesheet" href="./includes/css/index.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<?php include "./includes/header.php";
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
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
        <h2 class="sf">Friend Suggestions : </h2>
        <?php include "recommend_friends.php"; ?>
    </div>

<?php include "./includes/footer.php";
