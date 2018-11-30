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
                        <a class="wi" href="my-messages.php">Messages</a>
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

if(!isset($_SESSION["angemeldet"]))
{
    echo"Bitte zuerst <a href=\"login.html\">einloggen</a>";
    die();
}
else {
    $user_loggedin = $_SESSION['angemeldet'];
    echo "Hallo User: " . $user_loggedin;
}

echo "<h1>Benachrichtigungen</h1>";

if (DB::query('SELECT * FROM notifications WHERE receiver=:userid', array(':userid'=>$user_loggedin))) {
    $notifications = DB::query('SELECT * FROM notifications WHERE receiver=:userid ORDER BY id DESC', array(':userid'=>$user_loggedin));
    foreach($notifications as $n) {
        if ($n['type'] == 1) {
            $senderName = DB::query('SELECT username FROM list5 WHERE id=:senderid', array(':senderid'=>$n['sender']))[0]['username'];
            #hier wird der name des users ermittelt der die Benachrichtigung auslöst
            if ($n['extra'] == "") {
                echo "Du hast eine neue Benachrichtigung!<hr />";
            } else {
                $extra = json_decode($n['extra']);
                echo $senderName." hat dich in einem Post markiert! - ".$extra->postbody."<hr />";
            }
        } else if ($n['type'] == 2) {
            $senderName = DB::query('SELECT username FROM list5 WHERE id=:senderid', array(':senderid'=>$n['sender']))[0]['username'];
            echo $senderName." hat deinen Post geliked!<hr />";
        }
    }
}
?>