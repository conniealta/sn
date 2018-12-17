<?php
session_start();
include('header.php'); // in "header.php" ist auch "user_data.php" inkludiert und $_SESSION["angemeldet"];
?>

<br><br><br>
<h1> Followers - Wer folgt mir? </h1>
<br><br>

<?php
$dbfollowers = DB::query('SELECT list5.username, list5.profile_pic FROM list5, followers
                             WHERE list5.id = followers.follower_id
                             AND user_id = :userid', array(':userid'=>$user_loggedin));


foreach ($dbfollowers as $f) {

    //echo $f['username'];
    $username = $f['username'];

    echo "<img style='width: 75px; height: 75px; border-radius: 55px; margin-left:10px;' src='img_upload/profile_pics/" . $f['profile_pic'] . "'>" . ' ' . ' ' . "<a href='profile.php?username=" . $username . " ' >" . $f['username']. '</a>' ;
    echo "<hr>";
}
?>

