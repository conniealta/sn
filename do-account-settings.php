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
?>



<?php
include('DB.php');


if(isset($_POST["username"]) AND isset ($_POST["email"]) AND isset ($_POST["passwort"]) AND isset ($_POST["fname"]) AND isset ($_POST["lname"]) AND isset ($_POST["age"]) AND isset ($_POST["heimat"]) AND isset ($_POST["sprachen"]) AND isset ($_POST["studiengang"]) AND isset ($_POST["semester"]) AND isset ($_POST["job"]) AND isset ($_POST["interessen"]) AND isset ($_POST["zitat"]) AND isset ($_POST["website"]) AND isset ($_POST["handy"]) )
{
    $username = $_POST["username"];
    $email=$_POST["email"];
    $passwort=$_POST["passwort"];

    $vorname=$_POST["fname"];
    $nachname = $_POST["lname"];
    $age=$_POST["age"];
    $heimat = $_POST ["heimat"];
    $sprachen=$_POST["sprachen"];
    $studiengang = $_POST ["studiengang"];
    $semester=$_POST["semester"];
    $job=$_POST["job"];
    $interessen = $_POST["interessen"];
    $zitat = $_POST ["zitat"];
    $website=$_POST["website"];
    $handy=$_POST["handy"];

//hier brauchst du wahrscheinlich auch so was:
// if(strlen($lname) > 30 || strlen($lname) < 3) {
//        echo "Nachname zwischen 2 und 25 Zeichen!<br>";
//        $error = true;
//    }


    $result = DB::query('UPDATE list5 SET studiengang=:studiengang, age=:age, semester=:semester, username=:username, email=:email, passwort=:passwort, first_name=:fname, last_name=:lname, heimat=:heimat, sprachen=:sprachen, job=:job, interessen=:interessen, zitat=:zitat, website=:website, kontaktnummer=:handy WHERE id=:userid', array(':studiengang'=>$studiengang, ':age'=>$age, ':semester'=>$semester, ':username'=>$username, ':email'=>$email, ':passwort'=> hash('sha256', $passwort, false), ':fname'=>$vorname, ':lname'=>$nachname, ':heimat'=>$heimat, ':sprachen'=>$sprachen, ':job'=>$job, ':interessen'=>$interessen, ':zitat'=>$zitat, ':website'=>$website, ':handy'=>$handy, ':userid' => $user_loggedin));

    if ($result) {
        echo 'Du hast erfolgreich deine Angaben geändert. <a href="profile.php">Weiter zum Profil</a>';
    }
    else {
        echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
    }

}
else
{
    echo"Keine Daten";
    die();
}





/*$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de;dbname=u-ka034', 'ka034', 'zeeD6athoo',array('charset'=>'utf8'));

$statement = $pdo->prepare("UPDATE list5 SET * WHERE id=:userid");

$result = $statement->execute(array(':studiengang'=>$studiengang, ':email'=>$email, ':userid'=>$user_loggedin, ':passwort'=> hash('sha256', $passwort, false)));

if($result) {
    echo 'Du hast erfolgreich deine Angaben geändert. <a href="profile.php">Weiter zum Profil</a>';
}
else {
    echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
    echo "Datenbank-Fehler:";
    echo $statement->errorInfo()[2];
    echo $statement->queryString;
    die();
}*/





?>

