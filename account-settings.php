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


include('user_data.php'); // Fetch von allen Variablen in unserer User-Datenbanktabelle  --> include('DB.php') ist drin


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> </title>

</head>
<body>

<div class="user_details column">

    <a href='img_upload/profile_pics/<?php echo $profile_pic;?>'>      <img src='img_upload/profile_pics/<?php echo $profile_pic;?>'></a>

    <div class="user_details_left_right">
        <a href="<?php echo $userid; ?>">
            <?php
            echo $fname . " " . $lname;

            ?>
        </a>
    </div>

</div>



<?php
if ($userid == $followerid) { //nur wenn die eingeloggte Person  auf ihrer eigenen Profilseite ist, wird der Prodilbild-Upload angezeigt
    echo '<form action="upload_profile_pic.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="file">
    <button type="submit" name="submit"> Upload Profile Pic </button>

</form>';
}
?>

<br><br>



<!--<form action="do-account-settings.php" method="post">-->
<!--    <p>Alter:-->
<!--        <input type="text" size="40" maxlength="10" name="age" placeholder="Alter eingeben">-->
<!--    <input type="submit" name="update" value="Ändere deine Angaben"></p>-->
<!--</form>-->
<!---->
<!---->
<!--<form action="do-account-settings.php" method="post">-->
<!--    <p>Interessen:-->
<!--        <input type="text" size="40" maxlength="10" name="interessen" placeholder="Interessen eingeben">-->
<!--    <input type="submit" name="update" value="Ändere deine Angaben"></p>-->
<!--</form>-->






<br><br><br><br><br><br><br><br>

    <form action="do-account-settings.php" method="post">


        <p>Username:
            <input type="text" size="40" maxlength="250" name="username" placeholder="Username eingeben"></p>

        <p>Email:
            <input type="text" size="40" maxlength="250" name="email" placeholder="E-Mail eingeben"></p>

        <p>Passwort:
            <input type="password" size="40"  maxlength="250" name="passwort" placeholder="••••••"></p>

        <br><br>

        <p>Vorname:
        <input type="text" size="40" maxlength="250" name="fname" placeholder="Vorname eingeben"></p>

        <p>Nachname:
        <input type="text" size="40" maxlength="250" name="lname" placeholder="Nachname eingeben"></p>


        <p>Alter:
            <input type="text" size="40" maxlength="10" name="age" placeholder="Alter eingeben"></p>

        <p>Heimatstadt/-land:
            <input type="text" size="40" maxlength="1000" name="heimat" placeholder="Heimatstadt/-land eingeben"></p>

        <p>Sprachkenntnisse:
            <input type="text" size="40" maxlength="1000" name="sprachen" placeholder="Sprachen eingeben"></p>

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
            <select name="semester">
                <option value="1">1. Semester</option>
                <option value="2">2. Semester</option>
                <option value="3">3. Semester</option>
                <option value="4">4. Semester</option>
                <option value="5">5. Semester</option>
                <option value="6">6. Semester</option>
                <option value="7">7. Semester</option>
            </select>

        <p>Job:
            <input type="text" size="40" maxlength="1000" name="job" placeholder="Job eingeben"></p>

        <p>Interessen:
        <input type="text" size="40" maxlength="1000" name="interessen" placeholder="Interessen eingeben"></p>

        <p>Lieblingszitat:
            <input type="text" size="40" maxlength="1000" name="zitat" placeholder="Zitat eingeben"></p>

        <p>Website:
            <input type="text" size="40" maxlength="1000" name="website" placeholder="Website eingeben"></p>

        <p>Handynummer:
            <input type="text" size="40" maxlength="1000" name="handy" placeholder="Handynummer eingeben"></p>

        <br><br>
        <input type="submit" name="update" value="Ändere deine Angaben">


    </form>


</body>
</html>
