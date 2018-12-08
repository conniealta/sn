<?php
session_start();
if(isset($_POST["email"]) AND isset($_POST["passwort"]))
{
    $email=$_POST["email"];
    $passwort=$_POST["passwort"];
}
else
{
    echo"Keine Daten";
    die();
}

include ('db_pdo.php');

$pdo=new PDO ($dsn, $dbuser, $dbpass, $options);

//echo $passwort;
$statement = $pdo->prepare("SELECT * FROM list5 WHERE email=:email AND passwort=:passwort");

if($statement->execute(array(':email'=>$email, ':passwort'=> hash('sha256', $passwort, false)))) {
    if($user=$statement->fetch()) {
        echo "geklappt";
        $_SESSION["angemeldet"] = $user["id"];
        header('Location: index.php');
    } else {
        echo "nicht berechtigt";
    }
}
else {
    echo "Datenbank-Fehler:";
    echo $statement->errorInfo()[2];
    echo $statement->queryString;
    die();

}


//"passwort" = das ist die Variable bei der Datenbak
//":passwort" = das ist der Parameter, den wir im Formular eingegeben haben