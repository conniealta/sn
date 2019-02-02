<?php
session_start();

$pageTitle = "Benachrichtigungen";

include('header.php');
include('Post.php');


if (DB::query('SELECT * FROM notifications WHERE receiver=:userid', array(':userid' => $user_loggedin))) {
$notifications = DB::query('SELECT * FROM notifications WHERE receiver=:userid ORDER BY notifications.id DESC', array(':userid' => $user_loggedin));
echo '<h1>Meine Nachrichten</h1>';
?>





<main class="container" style="margin-top: 80px">

    <h1>Benachrichtigungen</h1>

    <div class="message-box" >



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

                echo "<a href='profile.php?username=" . $senderName . "'> @$senderName </a> hat deinen Post</a> geliked! " . "<hr />";




            }

        }


        }


        include('footer.php');










        ?>
    </div>

</main>

