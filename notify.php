<?php
session_start();
?>

    <!DOCTYPE html> <!-- das ist HTML 5 -->
    <html lang="de">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="style.css" media="screen"/>
        <title> Feed </title>

        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>



    </head>

    <body>


    <header>
        <A ID="toc"></A>

        <nav>
            <div id="erste">

                <ul class="list1">

                    <li>
                        <a  class="active" href="index.php">Feed</a>
                    </li>

                    <li>
                        <a href="profile.php">Profil </a>
                    </li>
                    <li>
                        <a class="wi" href="my-messages.php">Nachrichten</a>
                    </li>

                    <li class="dropdown">
                        <a href="notify.php">Benachrichtigungen</a>

                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <br><br><br><br>

    <a href="logout.php">Log out!</a>


    </body>
    </html>

<?php

include('DB.php');
include('Post.php');

if(!isset($_SESSION["angemeldet"]))
{
    echo"Bitte zuerst <a href=\"login.html\">einloggen</a>";
    die();
}
else {
    $user_loggedin = $_SESSION['angemeldet'];
    echo "Hallo User: " . $user_loggedin;
}

echo "<h1>Notifcations</h1>";

if (DB::query('SELECT * FROM notifications WHERE receiver=:userid', array(':userid'=>$userid))) {
    $notifications = DB::query('SELECT * FROM notifications WHERE receiver=:userid ORDER BY id DESC', array(':userid'=>$userid));

    foreach($notifications as $n) {

        if ($n['type'] == 1) {
            $senderName = DB::query('SELECT username FROM list5 WHERE id=:senderid', array(':senderid'=>$n['sender']))[0]['username'];

            if ($n['extra'] == "") {
                echo "You got a notification!<hr />";

            } else {
                $extra = json_decode($n['extra']);
                echo $senderName." mentioned you in a post! - ".$extra->postbody."<hr />";
            }

        } else if ($n['type'] == 2) {
            $senderName = DB::query('SELECT username FROM list5 WHERE id=:senderid', array(':senderid'=>$n['sender']))[0]['username'];
            echo $senderName." liked your post!<hr />";
        }
    }
}
?>