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
$age = DB::query('SELECT age FROM list5 WHERE id=:userid', array(':userid' => $userid))[0]['age'];
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



//hier mach eine include-Datei von PDO !!!
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de;dbname=u-ka034', 'ka034', 'zeeD6athoo',array('charset'=>'utf8'));

$statement = $pdo->prepare('SELECT * FROM posts WHERE user_id=:userid ORDER BY id ASC');

if($statement->execute(array(':userid'=>$user_loggedin))) {
    while ($user = $statement->fetchObject()) {
        $body = $user->body;
        $img = $user->img_id;
        $post_id = $user->id;
        $post_likes = $user->likes;
    }
}
// Kann ich das  auch ohne PDO machen ($profile_pic = DB:: query(SELECT profile_pic FROM list5 WHERE ...[0] [profile_pic]...
// --> hat nicht geklappt







/*$profile_pic = DB::query('SELECT profile_pic FROM list5 WHERE id=:userid', array(':userid' => $user_loggedin))[0]['profile_pic'];
$lname = DB::query('SELECT last_name FROM list5 WHERE id=:userid', array(':userid' => $user_loggedin))[0]['last_name'];
$fname = DB::query('SELECT first_name FROM list5 WHERE id=:userid', array(':userid' => $user_loggedin))[0]['first_name'];
$user_name = DB::query('SELECT username FROM list5 WHERE id=:userid', array(':userid' => $user_loggedin))[0]['username'];*/