<?php
session_start();
?>

<!DOCTYPE html> <!-- das ist HTML 5 -->
<html lang="de">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css" media="screen"/>
    <title> Benachrichtigungen </title>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>



</head>

<body>


<?php
include('header.php');
?>

<br><br><br><br>

<a href="logout.php">Log out!</a>



<?php


include('Post.php');


if(!isset($_SESSION["angemeldet"]))
{
    echo"Bitte zuerst <a href=\"login.html\">einloggen</a>";
    die();
}
else {
    $user_loggedin = $_SESSION['angemeldet'];
    echo "Hallo User: ".$user_loggedin;
}



echo "<h1>Benachrichtigungen</h1>";
if (DB::query('SELECT * FROM notifications WHERE receiver=:userid', array(':userid'=>$user_loggedin))) {
    $notifications = DB::query('SELECT * FROM notifications WHERE receiver=:userid', array(':userid'=>$user_loggedin));
    $user = DB::query('SELECT username FROM list5 WHERE id=:userid', array(':userid' => $user_loggedin))[0]['username'];
    $postId = DB::query('SELECT id FROM posts WHERE user_id=:userid ', array(':userid'=>$user_loggedin))[0]['id'];

    foreach($notifications as $n) {
        if ($n['type'] == 1) {
            $senderName = DB::query('SELECT username FROM list5 WHERE id=:senderid', array(':senderid'=>$n['sender']))[0]['username'];
            #hier wird der name des users ermittelt der die Benachrichtigung auslöst
            if ($n['extra'] == "") {
                echo "Du hast eine Benachrichtigung!<hr />";
            } else {
                $extra = json_decode($n['extra']);
                echo "<a href='profile.php?username=".$senderName ."'> @$senderName </a> hat dich in einem  <a href='profile.php?username=$senderName&postid=$postId '>Post</a> markiert! - ".$extra->postbody."<hr />";
            }

        } else if ($n['type'] == 2) {
            $senderName = DB::query('SELECT username FROM list5 WHERE id=:senderid', array(':senderid'=>$n['sender']))[0]['username'];
            echo "<a href='profile.php?username=".$senderName ."'> @$senderName </a> hat deinen  <a href='profile.php?username=$user&postid=".$posts['id']."'>Post</a> geliked! <hr />" ;

            //postid muss noch geändert werden,  aber wenn jetzt der postid in der URL übergeben wird,


        }

    }


}
include('footer.php');

?>
</body>
</html>

