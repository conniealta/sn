<?php
session_start();
include('header.php'); // in "header.php" ist auch "user_data.php" inkludiert und $_SESSION["angemeldet"];



$userid = DB::query('SELECT id FROM list5 WHERE username=:username', array(':username'=>$_GET['username']))[0]['id'];
// "$userid" ist die "id" der Person, auf deren Profilseite wir sind (das kann auch unsere Profilseite sein, aber auch die Profilseite von einem anderen Benutzer)

/* beim "$userid" wird die "id" gespeichert, die dem "username" in der Datenbank gehört, der wiederum dem ":username" in der URL entsprechen muss
  -> anders formuliert: die "id" aus der Datenbank auswählen, wo "username" in der Datenbank dem ":username" in der URL entspricht
   und diese "id" dann bei der Variable "$userid" speichern */




$follower = DB::query('SELECT follower_id FROM followers, list5 WHERE list5.id=:user_id', array(':user_id'=>$userid));


    print $follower;



?>
