<?php
function print_var($x){echo "<pre>";var_dump($x);echo "</pre>";}
$edges = array();

$query = "SELECT * FROM relationship WHERE request_accepted = 1;";
$result = mysqli_query($connection, $query);
if(!$result){
    die("SERVICE NOT AVAILABLE ".mysqli_error($result));
}

while($row = mysqli_fetch_assoc($result)){
    $user_one = $row['request_by'];
    $user_two = $row['request_to'];

    if(!array_key_exists($user_one, $edges)){
        $edges[$user_one] = array();
    }
    if(!array_key_exists($user_two, $edges)){
        $edges[$user_two] = array();
    }

    array_push($edges[$user_one], $user_two);
    array_push($edges[$user_two], $user_one);
}

$height = array();

function bfs($start){
    global $edges, $height;
    
    $queue = array();
    array_push($queue, $start);
    $height[$start] = 0;

    while(sizeof($queue) > 0){
        $front = array_values($queue)[0];
        array_shift($queue);
        $my_height = $height[$front];

        for($i = 0; array_key_exists($front, $edges) == 1 && $i < sizeof($edges[$front]); $i++){
            $ele = array_values($edges[$front])[$i];
            if(!array_key_exists($ele, $height)){
                array_push($queue, $ele);
                $height[$ele] = $my_height + 1;
            }
        }
    }
}

bfs($_SESSION['user_id']);

$ans = array();
foreach($height as $key=>$value){
    $my_height = $value;
    $element = $key;
    if(!array_key_exists($my_height, $ans)){
        $ans[$my_height] = array();
    }
    array_push($ans[$my_height], $element);
}

$friends_shown = 0;
for($j = 2; array_key_exists($j, $ans) == 1; $j++){
    echo "<b>Level ".($j-1)." friend suggestions : </b><br/>";
    foreach($ans[$j] as $my_height=>$element){
        $friend_id = $element;
        $query = "SELECT * FROM users WHERE user_id = $friend_id;";
        $result = mysqli_query($connection, $query);
        if(!$result){
            die("ERROR ".mysqli_error($connection));
        }
        $row = mysqli_fetch_assoc($result);
        $img = $row['user_image'];
        $friends_shown++;
        ?>
        <figure style="display:inline-block">
            <img src = "./includes/images/<?php echo $img; ?>" width=100/>
            <a href = "profile.php?profile_id=<?php echo $row['user_id']; ?>">
                <figcaption><?php echo $row['username']; ?></figcaption>
            </a>
        </figure>
        <?php
    }echo "<br/>";
}
if($friends_shown == 0){
    ?>
    <h3>You dont have any friends yet. </h3>
    <?php
    $query = "SELECT * FROM users LIMIT 50;";
    $result = mysqli_query($connection, $query);
    if(!$result){
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
}
?>
