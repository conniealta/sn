

<?php
$showTimeline = False;

if(!isset($_SESSION["angemeldet"]))
{
    echo"Bitte zuerst <a href=\"login.html\">einloggen</a>";
    die();
}
else {
    $userid2 = $_SESSION['angemeldet'];
    echo "Hallo User: ".$userid2;
    $showTimeline = True;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> </title>

</head>
<body>



    <form action="do_register.php" method="post">


        <p>Vorname:</p>
        <input type="text" size="40" maxlength="250" name="fname" placeholder="Vorname eingeben"><br><br>

        <p>Nachname:</p>
        <input type="text" size="40" maxlength="250" name="lname" placeholder="Nachname eingeben"><br><br>

        <p>Username:</p>
        <input type="text" size="40" maxlength="250" name="username" placeholder="Username eingeben"><br><br>

        <p>Alter:</p>
        <input type="text" size="40" maxlength="250" name="alter" placeholder="E-Mail eingeben"><br><br>

        <p>Studiengang:</p>
        <input type="text" size="40" maxlength="250" name="studiengang" placeholder="E-Mail eingeben"><br><br>

        <p>Aktuelles Semester:</p>
        <input type="text" size="40" maxlength="250" name="semester" placeholder="E-Mail eingeben"><br><br>

        <p>Interessen:</p>
        <input type="text" size="40" maxlength="250" name="email" placeholder="E-Mail eingeben"><br><br>


        <p>Email:</p>
        <input type="text" size="40" maxlength="250" name="email" placeholder="E-Mail eingeben"><br><br>

        <p>Passwort:</p>
        <input type="password" size="40"  maxlength="250" name="passwort" placeholder="••••••"><br>

        <input type="submit" name="update" value="Ändere deine Angaben">


    </form>


</body>
</html>
