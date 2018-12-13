<?php
session_start();
include('header.php'); // in "header.php" ist auch "user_data.php" inkludiert und $_SESSION["angemeldet"];

if(!isset($_SESSION["angemeldet"]))
{
    echo"Bitte zuerst <a href=\"login.html\">einloggen</a>";
    die();
}
else {
    $user_loggedin = $_SESSION['angemeldet'];

}


$userid = DB::query('SELECT id FROM list5 WHERE username=:username', array(':username'=>$_GET['username']))[0]['id'];
// "$userid" ist die "id" der Person, auf deren Profilseite wir sind (das kann auch unsere Profilseite sein, aber auch die Profilseite von einem anderen Benutzer)

/* beim "$userid" wird die "id" gespeichert, die dem "username" in der Datenbank gehört, der wiederum dem ":username" in der URL entsprechen muss
  -> anders formuliert: die "id" aus der Datenbank auswählen, wo "username" in der Datenbank dem ":username" in der URL entspricht
   und diese "id" dann bei der Variable "$userid" speichern */

$followerid = $user_loggedin; //"followerid" ist die "id" des Benutzers, der sich eingeloggt hat



if (DB::query('SELECT follower_id FROM followers WHERE user_id=:userid AND follower_id=:followerid', array(':userid'=>$userid, ':followerid'=>$followerid))) {

    echo $userid;
}



?>
