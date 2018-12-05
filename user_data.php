<?php
session_start();


$showTimeline = False;

if(!isset($_SESSION["angemeldet"]))
{
    echo"Bitte zuerst <a href=\"login.html\">einloggen</a>";
    die();
}
else {
    $userid2 = $_SESSION['angemeldet'];
    $showTimeline = True;
}


include('DB.php');

$userid = DB::query('SELECT id FROM list5 WHERE id=:userid', array(':userid'=>$userid2))[0]['id'];
$lname2 = DB::query('SELECT last_name FROM list5 WHERE id=:userid', array(':userid' => $userid))[0]['last_name'];
$fname2 = DB::query('SELECT first_name FROM list5 WHERE id=:userid', array(':userid' => $userid))[0]['first_name'];
$profile_pic2 = DB::query('SELECT profile_pic FROM list5 WHERE id=:userid', array(':userid' => $userid))[0]['profile_pic'];
$user_name = DB::query('SELECT username FROM list5 WHERE id=:userid', array(':userid' => $userid2))[0]['username'];
$followerid = $userid2;

