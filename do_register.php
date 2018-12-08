
<?php
session_start();

include ('db_pdo.php');

$pdo=new PDO ($dsn, $dbuser, $dbpass, $options);

if(isset($_POST["email"]) AND isset($_POST["passwort"]) AND isset($_POST["username"]) AND isset($_POST["fname"]) AND isset($_POST["lname"]) AND isset($_POST["passwort2"]))
{
    $username= $_POST["username"];
    $email=$_POST["email"];
    $passwort=$_POST["passwort"];
    $passwort2 = $_POST['passwort2'];
    $lname = $_POST['lname'];
    $username = $_POST['username'];
}
else
{
    echo"Keine Daten";
    die();
}


if(isset($_POST["email"]) AND isset($_POST["passwort"])AND isset($_POST["username"]) AND isset($_POST["fname"]) AND isset($_POST["lname"]) AND isset($_POST["passwort2"])) {
    $error = false;
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $passwort = $_POST['passwort'];
    $passwort2 = $_POST['passwort2'];

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
        $error = true;
    }

    if(strlen($fname) == 0) {
        echo 'Bitte einen Vornamen angeben<br>';
        $error = true;
    }

    if(strlen($lname) == 0) {
        echo 'Bitte einen Nachnamen angeben<br>';
        $error = true;
    }

    if(strlen($fname) > 25 || strlen($fname) < 2) {
        echo "Vorname zwischen 3 and 25 Zeichen!<br>";
        $error = true;
    }

    if(strlen($lname) > 25 || strlen($lname) < 2) {
        echo "Nachname zwischen 3 und 25 Zeichen!<br>";
        $error = true;
    }

    if(strlen($username) == 0) {
        echo 'Bitte einen Usernamen angeben<br>';
        $error = true;
    }

    if(strlen($lname) > 30 || strlen($lname) < 3) {
        echo "Nachname zwischen 2 und 25 Zeichen!<br>";
        $error = true;
    }

    if(strlen($passwort) == 0) {
        echo 'Bitte ein Passwort angeben<br>';
        $error = true;
    }
    if($passwort != $passwort2) {
        echo 'Die Passwörter müssen übereinstimmen<br>';
        $error = true;
    } else {
        if(preg_match('/[^A-Za-z0-9]/', $passwort)) {
            echo "Nur englische Zeichen!<br>";
            $error = true;
        }
    }

    // !!!!!!!!

   /* if(strlen($passwort > 30 || strlen($passwort) < 1)) {
        echo "Passwort zwischen 3 und 30 Zeichen!<br>";
        $error = true;
    }*/


    //Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
    if(!$error) {
        $statement = $pdo->prepare("SELECT * FROM list5 WHERE email = :email");
        $result = $statement->execute(array(':email' => $email));
        $user = $statement->fetch();

        if($user !== false) {
            echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
            $error = true;
        }
    }

    //Überprüfe, dass der Username noch nicht registriert wurde
    if(!$error) {
        $statement = $pdo->prepare("SELECT * FROM list5 WHERE username = :username");
        $result = $statement->execute(array(':username' => $username));
        $user = $statement->fetch();

        if($user !== false) {
            echo 'Dieser Username ist bereits vergeben<br>';
            $error = true;
        }
    }

    //Profile picture assignment
    $rand = rand(1, 2); //Random number between 1 and 2

    if($rand == 1)
        $profile_pic = "head_deep_blue.png";
    else if($rand == 2)
        $profile_pic = "head_emerald.png";


    //Keine Fehler, wir können den Nutzer registrieren
    if(!$error) {

        //$passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);

        $statement = $pdo->prepare("INSERT INTO list5 (first_name, last_name, username, email, passwort, profile_pic) VALUES (:fname, :lname, :username, :email, :passwort, :profilepic)");

        $result = $statement->execute(array(':fname' => $fname, ':lname' => $lname, ':username' => $username, ':email' => $email, ':passwort'=> hash('sha256', $passwort, false), ':profilepic' => $profile_pic));

        if($result) {
            echo 'Du wurdest erfolgreich registriert. <a href="login.html">Zum Login</a>';
        }
        else {
            echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
            echo "Datenbank-Fehler:";
            echo $statement->errorInfo()[2];
            echo $statement->queryString;
            die();
        }
    }
}



/*
$statement = $pdo->prepare("SELECT * FROM list WHERE email=:email AND passwort=:passwort");

//"passwort" = das ist die Variable bei der Datenbak
//":passwort" = das ist der Parameter, den wir im Formular eingegeben haben


if($statement->execute(array(':email'=>$email, ':passwort'=>$passwort))) {
    if($row=$statement->fetch()) {
        //echo "angemeldet";
        $_SESSION["angemeldet"]=$row["id"];
        header('Location: index.php');
    }
    else
    {
        echo"nicht berechtigt";
    }
} else {
    echo "Datenbank-Fehler:";
    echo $statement->errorInfo()[2];
    echo $statement->queryString;
    die();
}


$statement = $pdo->prepare("INSERT INTO posts (content) VALUES (?)");
$statement->execute(array($content));

echo $content." "."mit id in der Datenbank: ".$id=$pdo->lastInsertId();*/

