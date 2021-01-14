<?php

//DEVELOPMENT
// define('DB_USER', 'root');
// define('DB_HOST', 'localhost');
// define('DB_PASS', '');
// define('DB_NAME', 'friend_recommendation');

//PRODUCTION
define('DB_USER', 'maW0hSi7Ck');
define('DB_HOST', 'remotemysql.com');
define('DB_PASS', '9ZHMUlmkIQ');
define('DB_NAME', 'maW0hSi7Ck');

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if($connection == false){
    die("Service Temporarily Unavailable");
}

?>