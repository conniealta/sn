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

if(DB::query('SELECT * FROM notifications WHERE receiver=:userid', array(':userid'=>$user_loggedin))){
    $notifications = DB::query('SELECT * FROM notifications WHERE receiver=:userid', array(':userid'=>$user_loggedin));

    foreach($notifications as $n) {

        if (['type'] == 1){
            $senderName = DB::query('SELECT username FROM list5 WHERE id=:senderid', array(':senderid'=>$n['sender']))[0]['username'];
            #hier wird der Name von dem User ermittelt der die Benachrichtung auslöst/versendet

            if($n['extra'] == ""){

                echo "Du hast eine Benachrichtigung! <hr />";

            }else{
                $extra = json_decode($n['extra']);
                echo $senderName."hat dich in einem Post markiert! - ".$extra->postbody." <hr />";


            }

        }
    }
}

?>