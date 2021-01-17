<head><link rel="stylesheet" href="./includes/css/register.css">
<meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<nav class="navdes">

    <a class="btn btn-nav text-center" href = "index.php">Home</a>
    <a class="btn btn-nav text-center" href = "profile.php?profile_id=<?php echo $_SESSION['user_id']; ?>">Profile</a>
    <a class="btn btn-nav text-center" href = "edit_profile.php">Edit Profile</a>
    <a class="btn btn-nav text-center" href = "friends.php">View Friends</a>
    <a class="btn btn-nav text-center" href = "friend_requests.php">Friend Requests</a>
    <a class="btn btn-nav text-center lo" href = "logout.php">Log Out</a>
</nav>
