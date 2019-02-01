<?php
session_start();

$pageTitle = "Alcyone Benachrichtigungen";

include('header.php');
include('Post.php');

echo "<h1>Benachrichtigungen</h1>";
?>


<main class="container">
<div class="message-box"
<?php



if (DB::query('SELECT * FROM notifications WHERE receiver=:userid', array(':userid'=>$user_loggedin))) {
    $notifications = DB::query('SELECT * FROM notifications WHERE receiver=:userid ORDER BY notifications.id DESC', array(':userid'=>$user_loggedin));

?>

<div class="notify-box">

     <?php
    foreach ($notifications as $n) {
        if ($n['type'] == 1) {
            $senderName = DB::query('SELECT username FROM list5 WHERE id=:senderid', array(':senderid' => $n['sender']))[0]['username'];
            #hier wird der name des users ermittelt der die Benachrichtigung auslöst
            if ($n['extra'] == "") {
                echo "Du hast eine Benachrichtigung!<hr />";
            } else {
                $extra = json_decode($n['extra']);
                echo "<a href='profile.php?username=" . $senderName . "'> @$senderName </a> hat dich in einem Post</a> markiert! - " . $extra->postbody . "<hr />";
            }

        } else if ($n['type'] == 2) {
            $senderName = DB::query('SELECT username FROM list5 WHERE id=:senderid', array(':senderid' => $n['sender']))[0]['username'];

                echo "<a href='profile.php?username=" . $senderName . "'> @$senderName </a> hat deinen Post</a> geliked! " ."<hr />";



        }

    }



}

include('footer.php');

?>
</div>
</main>

