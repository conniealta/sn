<?php
session_start();


$showTimeline = False;

if(!isset($_SESSION["angemeldet"]))
{
    echo"Bitte zuerst <a href=\"login.html\">einloggen</a>";
    die();
}
else {
    $user_loggedin = $_SESSION['angemeldet'];
    $showTimeline = True;
}


include('DB.php');

// Fetch von allen Variablen in unserer User-Datenbanktabelle:

$userid = DB::query('SELECT id FROM list5 WHERE id=:userid', array(':userid'=>$user_loggedin))[0]['id'];
$lname = DB::query('SELECT last_name FROM list5 WHERE id=:userid', array(':userid' => $userid))[0]['last_name'];
$fname = DB::query('SELECT first_name FROM list5 WHERE id=:userid', array(':userid' => $userid))[0]['first_name'];
$profile_pic = DB::query('SELECT profile_pic FROM list5 WHERE id=:userid', array(':userid' => $userid))[0]['profile_pic'];
$user_name = DB::query('SELECT username FROM list5 WHERE id=:userid', array(':userid' => $userid))[0]['username'];
$studiengang = DB::query('SELECT studiengang FROM list5 WHERE id=:userid', array(':userid'=>$userid))[0]['studiengang'];
$age = DB::query('SELECT age FROM list5 WHERE id=:userid', array(':userid' => $userid))[0]['heimat'];
$heimat = DB::query('SELECT heimat FROM list5 WHERE id=:userid', array(':userid' => $userid))[0]['heimat'];
$sprachen = DB::query('SELECT sprachen FROM list5 WHERE id=:userid', array(':userid' => $userid))[0]['sprachen'];
$semester = DB::query('SELECT semester FROM list5 WHERE id=:userid', array(':userid' => $userid))[0]['semester'];
$job = DB::query('SELECT job FROM list5 WHERE id=:userid', array(':userid'=>$userid))[0]['job'];
$interessen = DB::query('SELECT interessen FROM list5 WHERE id=:userid', array(':userid' => $userid))[0]['interessen'];
$zitat = DB::query('SELECT zitat FROM list5 WHERE id=:userid', array(':userid' => $userid))[0]['zitat'];
$website = DB::query('SELECT website FROM list5 WHERE id=:userid', array(':userid' => $userid))[0]['website'];
$kontakt = DB::query('SELECT kontaktnummer FROM list5 WHERE id=:userid', array(':userid' => $userid))[0]['kontaktnummer'];
$email = DB::query('SELECT email FROM list5 WHERE id=:userid', array(':userid' => $userid))[0]['email'];

$followerid = $user_loggedin;