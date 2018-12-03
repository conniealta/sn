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



    <form action="do-account-settings.php" method="post">


        <p>Vorname:
        <input type="text" size="40" maxlength="250" name="fname" placeholder="Vorname eingeben"></p>

        <p>Nachname:
        <input type="text" size="40" maxlength="250" name="lname" placeholder="Nachname eingeben"></p>

        <p>Username:
        <input type="text" size="40" maxlength="250" name="username" placeholder="Username eingeben"></p>

        <p>Alter:<input type="text" size="40" maxlength="250" name="alter" placeholder="E-Mail eingeben"></p>

        <p>Studiengang:
        <select name="studiengang">
            <option value="omm">Online-Medien-Management</option>
            <option value="wi">Wirtschaftsinformatik und digitale Medien</option>
            <option value="id">Informationsdesign</option>
            <option value="bm">Bibliotheksmanagement</option>
            <option value="am">Audiovisuelle Medien</option>
            <option value="cr">Crossmedia Redaktion/Public Relations</option>
            <option value="mt">Deutsch-chinseischer Studiengang Medien und Technologie</option>
            <option value="iw">Informationswissenschaften</option>
            <option value="ip">Integriertes Produktdesign</option>
            <option value="mp">Mediapublishing</option>
            <option value="mi">Medieninformatik</option>
            <option value="mw">Medienwirtschaft</option>
            <option value="mm">Mobile Medien</option>
            <option value="pmt">Print Media Technologies</option>
            <option value="vt">Verpackungstechnik</option>
            <option value="wm">Werbung und Marktkommunikation</option>
            <option value="wim">Wirtschaftsingenieurwesen Medien</option>
        </select>
        </p>

        <p>Aktuelles Semester:
        <input type="text" size="40" maxlength="250" name="semester" placeholder="E-Mail eingeben"></p>

        <p>Interessen:
        <input type="text" size="40" maxlength="250" name="email" placeholder="E-Mail eingeben"></p>


        <p>Email:
        <input type="text" size="40" maxlength="250" name="email" placeholder="E-Mail eingeben"></p>

        <p>Passwort:
        <input type="password" size="40"  maxlength="250" name="passwort" placeholder="••••••"></p>

        <input type="submit" name="update" value="Ändere deine Angaben">


    </form>


</body>
</html>
