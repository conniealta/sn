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
            <input type="text" size="40" maxlength="250" name="username" value="<?php echo $user_name; ?>"></p>

        <p>Email:
            <input type="text" size="40" maxlength="250" name="email" value="<?php echo $email; ?>"></p>

        <p>Altes Passwort:
            <input type="password" size="40"  maxlength="250" name="passwort" placeholder="••••••"></p>

        <p>Neues Passwort:
            <input type="password" size="40"  maxlength="250" name="passwort" placeholder="••••••"></p>

        <p>Neues Passwort bestätigen:
            <input type="password" size="40"  maxlength="250" name="passwort" placeholder="••••••"></p>

        <br><br>

        <p>Vorname:
        <input type="text" size="40" maxlength="250" name="fname" value="<?php echo $fname; ?>"</p>

        <p>Nachname:
        <input type="text" size="40" maxlength="250" name="lname" value="<?php echo $lname; ?>"></p>


        <p>Alter:
            <input type="text" size="40" maxlength="10" name="age" value="<?php echo $age; ?>"</p>

        <p>Heimatstadt/-land:
            <input type="text" size="40" maxlength="1000" name="heimat" value="<?php echo $heimat; ?>"></p>

        <p>Sprachkenntnisse:
            <input type="text" size="40" maxlength="1000" name="sprachen" value="<?php echo $sprachen; ?>"></p>

        <p>Studiengang:
        <select name="studiengang" value="<?php echo $studiengang; ?>">
            <option "<?php echo $studiengang;?>">Online-Medien-Management</option>
            <option "<?php echo $studiengang;?>">Wirtschaftsinformatik und digitale Medien</option>
            <option value="Informationsdesign">Informationsdesign</option>
            <option value="Bibliotheksmanagement">Bibliotheksmanagement</option>
            <option value="Audiovisuelle Medien">Audiovisuelle Medien</option>
            <option value="Crossmedia Redaktion/Public Relations">Crossmedia Redaktion/Public Relations</option>
            <option value="Deutsch-chinseischer Studiengang Medien und Technologie">Deutsch-chinseischer Studiengang Medien und Technologie</option>
            <option value="Informationswissenschaften">Informationswissenschaften</option>
            <option value="Integriertes Produktdesign">Integriertes Produktdesign</option>
            <option value="Mediapublishing">Mediapublishing</option>
            <option value="Medieninformatik">Medieninformatik</option>
            <option value="Medienwirtschaft">Medienwirtschaft</option>
            <option value="Mobile Medien">Mobile Medien</option>
            <option value="Print Media Technologies">Print Media Technologies</option>
            <option value="Verpackungstechnik">Verpackungstechnik</option>
            <option value="Werbung und Marktkommunikation">Werbung und Marktkommunikation</option>
            <option value="Wirtschaftsingenieurwesen Medien">Wirtschaftsingenieurwesen Medien</option>
        </select>
        </p>

        <p>Aktuelles Semester:
            <select name="semester" value="<?php echo $semester;?>">
                <option value="<?php echo $semester;?>">1. Semester</option>
                <option value="<?php echo $semester;?>">2. Semester</option>
                <option value="<?php echo $semester;?>">3. Semester</option>
                <option value="<?php echo $semester;?>">4. Semester</option>
                <option value="<?php echo $semester;?>">5. Semester</option>
                <option value="<?php echo $semester;?>">6. Semester</option>
                <option value="<?php echo $semester;?>">7. Semester</option>
            </select>

        <p>Job:
            <input type="text" size="40" maxlength="1000" name="job" value="<?php echo $job; ?>"></p>

        <p>Interessen:
        <input type="text" size="40" maxlength="1000" name="interessen" value="<?php echo $interessen; ?>"></p>

        <p>Lieblingszitat:
            <input type="text" size="40" maxlength="1000" name="zitat" value="<?php echo $zitat; ?>"></p>

        <p>Website:
            <input type="text" size="40" maxlength="1000" name="website" value="<?php echo $website; ?>"></p>

        <p>Handynummer:
            <input type="text" size="40" maxlength="1000" name="handy" value="<?php echo $kontakt; ?>"></p>

        <br><br>
        <input type="submit" name="update" value="Ändere deine Angaben">


    </form>


</body>
</html>
