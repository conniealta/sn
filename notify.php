<?php
session_start();
?>



<?php
include('header.php');
?>



<?php


include('Post.php');





echo "<h1>Benachrichtigungen</h1>";
if (DB::query('SELECT * FROM notifications WHERE receiver=:userid', array(':userid'=>$user_loggedin))) {
    $notifications = DB::query('SELECT * FROM notifications WHERE receiver=:userid', array(':userid'=>$user_loggedin));
    $user = DB::query('SELECT username FROM list5 WHERE id=:userid', array(':userid' => $user_loggedin))[0]['username'];
    //$postID = DB::query('SELECT post_id FROM notifications, posts WHERE post_id=:posts.id', array(':posts.id'=> $post_id))[0]['id'];
    Notify2::createNotify($_GET['post_id']);

    foreach($notifications as $n) {
        if ($n['type'] == 1) {
            $senderName = DB::query('SELECT username FROM list5 WHERE id=:senderid', array(':senderid'=>$n['sender']))[0]['username'];
            #hier wird der name des users ermittelt der die Benachrichtigung auslöst
            if ($n['extra'] == "") {
                echo "Du hast eine Benachrichtigung!<hr />";
            } else {
                $extra = json_decode($n['extra']);
                echo "<a href='profile.php?username=".$senderName ."'> @$senderName </a> hat dich in einem  <a href='profile.php?username=$senderName&postid=$post_id '>Post</a> markiert! - ".$extra->postbody."<hr />";
            }

        } else if ($n['type'] == 2) {
            $senderName = DB::query('SELECT username FROM list5 WHERE id=:senderid', array(':senderid'=>$n['sender']))[0]['username'];
            echo "<a href='profile.php?username=".$senderName ."'> @$senderName </a> hat deinen  <a href='profile.php?username=$user&postid=$post_id'>Post</a> geliked! <hr />" ;
            //postid muss noch geändert werden,  aber wenn jetzt der postid in der URL übergeben wird,


        }

    }


}
include('footer.php');

?>

gfzgug
ghvzhg