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

/* Problem:
jetzt ist es so, dass die leere Eingabefelder als leere Datenbankeinträge mitgespeichert werden

Wahrscheinlich wäre es besser eine <form action...> für jedes einzelne Eingabefeld individuell zu machen, damit
nur die Daten verändert werden, die man verändern will
*/


/*if(isset($_POST['age'])) {
    $age=$_POST["age"];
    $result = DB::query('UPDATE list5 SET age=:age WHERE id=:userid', array(':age'=>$age, ':userid' => $user_loggedin));

    //echo 'Du hast erfolgreich deine Angaben geändert. <a href="profile.php">Weiter zum Profil</a>';
    header('Location: account-settings.php');

}*/


if(isset($_POST['update_account'])) {

    $error = false;

    $username = $_POST["username"];
    $email = $_POST["email"];

    $email_alt = DB::query('SELECT email FROM list5 WHERE id=:userid', array(':userid' => $user_loggedin))[0]['email'];
    $username_alt = DB::query('SELECT username FROM list5 WHERE id=:userid', array(':userid' => $user_loggedin))[0]['username'];


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
        $error = true;
    }

    if (strlen($username) == 0) {
        echo 'Bitte einen Usernamen angeben<br>';
        $error = true;
    }

    if ($email_alt != $email) { // nur wenn die E-Mail verändert wurde

        if (!$error) { //Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde

            $email_2 = DB::query('SELECT * FROM list5 WHERE email=:email', array(':email' => $email))[0]['email'];

            if ($email_2 !== false) {
                echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
                $error = true;
            }
        }
    }


    if ($username_alt != $username) { // nur wenn der Username verändert wurde
        if (!$error) { //Überprüfe, dass der Username noch nicht registriert wurde

            $username_2 = DB::query('SELECT * FROM list5 WHERE username=:username', array(':username' => $username))[0]['username'];

            if ($username_2 !== false) {
                echo 'Dieser Username ist bereits vergeben<br>';
                $error = true;
            }
        }
    }

//Keine Fehler, wir können die Daten ändern
    if (!$error) {

        $result3 = DB::query('UPDATE list5 SET username=:username, email=:email WHERE id=:userid', array(':username' => $username, ':email' => $email, ':userid' => $user_loggedin));

        echo 'Du hast erfolgreich deine Angaben geändert. <a href="profile.php">Weiter zum Profil</a>';
        header('Location: account-settings.php');
    }
}


if(isset($_POST['update_info'])) {
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


    $result = DB::query('UPDATE list5 SET studiengang=:studiengang, age=:age, semester=:semester, first_name=:fname, last_name=:lname, heimat=:heimat, sprachen=:sprachen, job=:job, interessen=:interessen, zitat=:zitat, website=:website, kontaktnummer=:handy WHERE id=:userid', array(':studiengang'=>$studiengang, ':age'=>$age, ':semester'=>$semester, ':fname'=>$vorname, ':lname'=>$nachname, ':heimat'=>$heimat, ':sprachen'=>$sprachen, ':job'=>$job, ':interessen'=>$interessen, ':zitat'=>$zitat, ':website'=>$website, ':handy'=>$handy, ':userid' => $user_loggedin));

        echo 'Du hast erfolgreich deine Angaben geändert. <a href="profile.php">Weiter zum Profil</a>';
    header('Location: account-settings.php');
}
/*else {
    echo"Keine Daten";
    die();
}
*/


if(isset($_POST['update_password'])) {

    $passwort = $_POST["old_password"];
    $passwort_neu = $_POST["new_password1"];
    $passwort_neu2 = $_POST["new_password2"];

    $passwort_alt = DB::query('SELECT passwort FROM list5 WHERE id=:userid', array(':userid' => $user_loggedin))[0]['passwort'];



    if (strlen($passwort) == 0) {
        echo 'Bitte ein Passwort angeben<br>';
        $error = true;
    }

    $passwort_hash = hash('sha256', $passwort, false);

    if ($passwort_hash != $passwort_alt) {
        echo 'Falsches Passwort! <br>';
        $error = true;
    }

   // ':passwort'=> hash('sha256', $passwort, false)
// wegen des hash --> wir geben 123 und es gibt zuruück falsches passwort weil es  verschlüsselt wurde

    if (strlen($passwort_neu) == 0) {
        echo 'Bitte ein Passwort angeben<br>';
        $error = true;
    }

    if (strlen($passwort_neu2) == 0) {
        echo 'Bitte ein Passwort angeben<br>';
        $error = true;
    }

    if ($passwort_neu != $passwort_neu2) {
        echo 'Die Passwörter müssen übereinstimmen<br>';
        $error = true;

    } else {
        if (preg_match('/[^A-Za-z0-9]/', $passwort_neu)) {
            echo "Nur englische Zeichen!<br>";
            $error = true;
        }
    }


//Keine Fehler, wir können die Daten ändern
    if (!$error) {

        $passwort_neu_hash = password_hash($passwort_neu, PASSWORD_DEFAULT);
        $result2 = DB::query('UPDATE list5 SET passwort=:new_password1 WHERE id=:userid', array(':new_password1' => hash('sha256', $passwort_neu, false), ':userid' => $user_loggedin));

        echo 'Du hast erfolgreich deine Angaben geändert. <a href="profile.php">Weiter zum Profil</a>';
        header('Location: account-settings.php');

        /*if ($result) {
            echo 'Du hast erfolgreich deine Angaben geändert. <a href="profile.php">Weiter zum Profil</a>';
            header('Location: account-settings.php');
        } else {
            echo "Keine Daten";
            die();
        }*/

    }
}







//':email'=>$email, ':passwort'=> hash('sha256', $passwort, false)


//Das ganze Formular:

/*if(isset($_POST["username"]) AND isset ($_POST["email"]) AND isset ($_POST["passwort"]) AND isset ($_POST["fname"]) AND isset ($_POST["lname"]) AND isset ($_POST["age"]) AND isset ($_POST["heimat"]) AND isset ($_POST["sprachen"]) AND isset ($_POST["studiengang"]) AND isset ($_POST["semester"]) AND isset ($_POST["job"]) AND isset ($_POST["interessen"]) AND isset ($_POST["zitat"]) AND isset ($_POST["website"]) AND isset ($_POST["handy"]) )
{
    $username = $_POST["username"];
    $email=$_POST["email"];
    $passwort_alt=$_POST["old_password"];
    $passwort_neu = $_POST["new_password1"];

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

}
else
{
    echo"Keine Daten";
    die();
}*/








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

