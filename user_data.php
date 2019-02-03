<?php
session_start();

$showTimeline = False;

if(!isset($_SESSION["angemeldet"]))
{
    echo"Bitte zuerst <a href=\"login.php\">einloggen</a>";
    die();
}
else {
    $user_loggedin = $_SESSION['angemeldet'];
    $showTimeline = True;
}


include('DB.php');
include ('db_pdo.php');

// Fetch von allen Variablen in unserer User-Datenbanktabelle (eingeloggte Person):

//$userid = DB::query('SELECT id FROM list5 WHERE id=:userid', array(':userid'=>$user_loggedin))[0]['id'];
$lname = DB::query('SELECT last_name FROM list5 WHERE id=:userid', array(':userid' => $user_loggedin))[0]['last_name'];
$fname = DB::query('SELECT first_name FROM list5 WHERE id=:userid', array(':userid' => $user_loggedin))[0]['first_name'];
$profile_pic = DB::query('SELECT profile_pic FROM list5 WHERE id=:userid', array(':userid' => $user_loggedin))[0]['profile_pic'];
$user_name = DB::query('SELECT username FROM list5 WHERE id=:userid', array(':userid' => $user_loggedin))[0]['username'];
$studiengang = DB::query('SELECT studiengang FROM list5 WHERE id=:userid', array(':userid'=>$user_loggedin))[0]['studiengang'];
$age = DB::query('SELECT age FROM list5 WHERE id=:userid', array(':userid' => $user_loggedin))[0]['age'];
$heimat = DB::query('SELECT heimat FROM list5 WHERE id=:userid', array(':userid' => $user_loggedin))[0]['heimat'];
$sprachen = DB::query('SELECT sprachen FROM list5 WHERE id=:userid', array(':userid' => $user_loggedin))[0]['sprachen'];
$semester = DB::query('SELECT semester FROM list5 WHERE id=:userid', array(':userid' => $user_loggedin))[0]['semester'];
$job = DB::query('SELECT job FROM list5 WHERE id=:userid', array(':userid'=>$user_loggedin))[0]['job'];
$interessen = DB::query('SELECT interessen FROM list5 WHERE id=:userid', array(':userid' => $user_loggedin))[0]['interessen'];
$zitat = DB::query('SELECT zitat FROM list5 WHERE id=:userid', array(':userid' => $user_loggedin))[0]['zitat'];
$website = DB::query('SELECT website FROM list5 WHERE id=:userid', array(':userid' => $user_loggedin))[0]['website'];
$kontakt = DB::query('SELECT kontaktnummer FROM list5 WHERE id=:userid', array(':userid' => $user_loggedin))[0]['kontaktnummer'];
$email = DB::query('SELECT email FROM list5 WHERE id=:userid', array(':userid' => $user_loggedin))[0]['email'];

$followerid = $user_loggedin;


// $profile_pic = das ist das Profilbild der eingeloggten Person
// $profile_pic2 = das ist das Profilbild der Person, auf deren Profilseite wir sind
// userid = das ist die id der Person, auf deren Profilseite wir sind

// Fetch der Variablen, Nutzerinfos der Person, auf deren Profilseite wir sind:
$username = DB::query('SELECT username FROM list5 WHERE username=:username', array(':username'=>$_GET['username']))[0]['username'];
$userid = DB::query('SELECT id FROM list5 WHERE username=:username', array(':username'=>$_GET['username']))[0]['id'];
$lname2 = DB::query('SELECT last_name FROM list5 WHERE id=:userid', array(':userid' => $userid))[0]['last_name'];
$fname2 = DB::query('SELECT first_name FROM list5 WHERE id=:userid', array(':userid' => $userid))[0]['first_name'];
$user_name2 = DB::query('SELECT username FROM list5 WHERE id=:userid', array(':userid' => $userid))[0]['username'];
$studiengang2 = DB::query('SELECT studiengang FROM list5 WHERE id=:userid', array(':userid' => $userid))[0]['studiengang'];
$age2 = DB::query('SELECT age FROM list5 WHERE id=:userid', array(':userid' => $userid))[0]['age'];
$profile_pic2 = DB::query('SELECT profile_pic FROM list5 WHERE id=:userid', array(':userid' => $userid))[0]['profile_pic'];
$heimat2 = DB::query('SELECT heimat FROM list5 WHERE id=:userid', array(':userid' => $userid))[0]['heimat'];
$sprachen2 = DB::query('SELECT sprachen FROM list5 WHERE id=:userid', array(':userid' => $userid))[0]['sprachen'];
$semester2 = DB::query('SELECT semester FROM list5 WHERE id=:userid', array(':userid' => $userid))[0]['semester'];
$job2 = DB::query('SELECT job FROM list5 WHERE id=:userid', array(':userid'=>$userid))[0]['job'];
$interessen2 = DB::query('SELECT interessen FROM list5 WHERE id=:userid', array(':userid' => $userid))[0]['interessen'];
$zitat2 = DB::query('SELECT zitat FROM list5 WHERE id=:userid', array(':userid' => $userid))[0]['zitat'];
$website2 = DB::query('SELECT website FROM list5 WHERE id=:userid', array(':userid' => $userid))[0]['website'];
$kontakt2 = DB::query('SELECT kontaktnummer FROM list5 WHERE id=:userid', array(':userid' => $userid))[0]['kontaktnummer'];
$email2 = DB::query('SELECT email FROM list5 WHERE id=:userid', array(':userid' => $userid))[0]['email'];



$pdo=new PDO ($dsn, $dbuser, $dbpass, $options);
$statement = $pdo->prepare('SELECT * FROM posts WHERE user_id=:userid ORDER BY id ASC');

if($statement->execute(array(':userid'=>$user_loggedin))) {
    while ($user = $statement->fetchObject()) {
        $body = $user->body;
        $img = $user->img_id;
        $post_id = $user->id;
        $post_likes = $user->likes;
        $post_time = $user->posted_at;
    }
}


