<?php
session_start();
include('header.php');

?>

<br><br>
<h3>Benutzereinstellungen </h3>

<br><br>

<h4>Profilbild ändern</h4>

<div class="user_details column">

    <a href='img_upload/profile_pics/<?php echo $profile_pic;?>'>      <img src='img_upload/profile_pics/<?php echo $profile_pic;?>'></a>

    <div class="user_details_left_right">
        <a href="profile.php?username=<?php echo $username; ?>" >
            <?php
            echo $fname . " " . $lname;

            ?>
        </a>
    </div>

</div>


<br><br><br><br><br><br><br><br><br><br>


<?php
if ($user_loggedin) { //nur wenn die eingeloggte Person  auf ihrer eigenen Profilseite ist, wird der Prodilbild-Upload angezeigt
    echo '<form action="upload_profile_pic.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="file">
    <button type="submit" name="submit"> Profilbild hochladen </button>

</form>';
}

?>

<br><br>

<h4>Benutzerdaten ändern</h4>
    <form action="do-account-settings.php" method="post">

        <p>Username:
            <input type="text" size="40" maxlength="250" name="username" value="<?php echo $user_name; ?>"></p>

        <p>Email:
            <input type="text" size="40" maxlength="250" name="email" value="<?php echo $email; ?>"></p>


        <br>
        <input type="submit" name="update_account" value="Ändere deine Angaben">

    </form>

<br><br>

<h4>Passwort ändern</h4>
<form action="do-account-settings.php" method="post">
        <p>Altes Passwort:
            <input type="password" size="40"  maxlength="250" name="old_password" placeholder="••••••"></p>

        <p>Neues Passwort:
            <input type="password" size="40"  maxlength="250" name="new_password1" placeholder="••••••"></p>

        <p>Neues Passwort bestätigen:
            <input type="password" size="40"  maxlength="250" name="new_password2" placeholder="••••••"></p>

       <br>
        <input type="submit" name="update_password" value="Ändere deine Angaben">

    </form>


        <br><br>

<h4>Benutzerinformationen ändern</h4>
        <form action="do-account-settings.php" method="post">
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

            <?php if ($studiengang == "Online-Medien-Management") {
                echo '<option selected="selected"> Online-Medien-Management</option>';
            } else echo '<option value="Online-Medien-Management"> Online-Medien-Management</option>'; ?>;

            <?php if ($studiengang == "Audiovisuelle Medien") {
                echo '<option selected="selected"> Audiovisuelle Medien</option>';
            } else echo '<option value="Audiovisuelle Medien"> Audiovisuelle Medien</option>'; ?>;

            <?php if ($studiengang == "Wirtschaftsinformatik und digitale Medien") {
                echo '<option selected="selected">Wirtschaftsinformatik und digitale Medien</option>';
            } else echo '<option value="Audiovisuelle Medien">Wirtschaftsinformatik und digitale Medien</option>'; ?>;

            <?php if ($studiengang == "Informationsdesign") {
                echo '<option selected="selected">Informationsdesign</option>';
            } else echo '<option value="Informationsdesign">Informationsdesign</option>'; ?>;

            <?php if ($studiengang == "Bibliotheksmanagement") {
                echo '<option selected="selected">Bibliotheksmanagement</option>';
            } else echo '<option value="Bibliotheksmanagement">Bibliotheksmanagement</option>'; ?>;

            <?php if ($studiengang == "Crossmedia Redaktion/Public Relations") {
                echo '<option selected="selected">Crossmedia Redaktion/Public Relations</option>';
            } else echo '<option value="Crossmedia Redaktion/Public Relations">Crossmedia Redaktion/Public Relations</option>'; ?>;

            <?php if ($studiengang == "Deutsch-chinseischer Studiengang Medien und Technologie") {
                echo '<option selected="selected">Deutsch-chinseischer Studiengang Medien und Technologie</option>';
            } else echo '<option value="Deutsch-chinseischer Studiengang Medien und Technologie">Deutsch-chinseischer Studiengang Medien und Technologie</option>'; ?>;

            <?php if ($studiengang == "Informationswissenschaften") {
                echo '<option selected="selected">Informationswissenschaften</option>';
            } else echo '<option value="Informationswissenschaften">Informationswissenschaften</option>'; ?>;

            <?php if ($studiengang == "Integriertes Produktdesign") {
                echo '<option selected="selected">Integriertes Produktdesign</option>';
            } else echo '<option value="Integriertes Produktdesign">Integriertes Produktdesign</option>'; ?>;

            <?php if ($studiengang == "Mediapublishing") {
                echo '<option selected="selected">Mediapublishing</option>';
            } else echo '<option value="Mediapublishing">Mediapublishing</option>'; ?>;

            <?php if ($studiengang == "Medieninformatik") {
                echo '<option selected="selected">Medieninformatik</option>';
            } else echo '<option value="Medieninformatik">Medieninformatik</option>'; ?>;

            <?php if ($studiengang == "Medienwirtschaft") {
                echo '<option selected="selected">Medienwirtschaft</option>';
            } else echo '<option value="Medienwirtschaft">Medienwirtschaft</option>'; ?>;

            <?php if ($studiengang == "Mobile Medien") {
                echo '<option selected="selected">Mobile Medien</option>';
            } else echo '<option value="Mobile Medien">Mobile Medien</option>'; ?>;

            <?php if ($studiengang == "Mediapublishing") {
                echo '<option selected="selected">Mediapublishing</option>';
            } else echo '<option value="Mediapublishing">Mediapublishing</option>'; ?>;

            <?php if ($studiengang == "Mediapublishing") {
                echo '<option selected="selected">Mediapublishing</option>';
            } else echo '<option value="Mediapublishing">Mediapublishing</option>'; ?>;

            <?php if ($studiengang == "Print Media Technologies") {
                echo '<option selected="selected">Print Media Technologies</option>';
            } else echo '<option value="Print Media Technologies">Print Media Technologies</option>'; ?>;

            <?php if ($studiengang == "Verpackungstechnik") {
                echo '<option selected="selected">Verpackungstechnik</option>';
            } else echo '<option value="Mediapublishing">Verpackungstechnik</option>'; ?>;

            <?php if ($studiengang == "Wirtschaftsingenieurwesen Medien") {
                echo '<option selected="selected">Wirtschaftsingenieurwesen Medien</option>';
            } else echo '<option value="Wirtschaftsingenieurwesen Medien">Wirtschaftsingenieurwesen Medien</option>'; ?>;

            <?php if ($studiengang == "Werbung und Marktkommunikation") {
                echo '<option selected="selected">Werbung und Marktkommunikation</option>';
            } else echo '<option value="Werbung und Marktkommunikation">Werbung und Marktkommunikation</option>'; ?>;

        </select>
        </p>

        <p>Aktuelles Semester:
            <select name="semester" value="<?php echo $semester;?>">
                <option value="1. Semester">1. Semester</option>
                <option value="2. Semester">2. Semester</option>
                <option value="3. Semester">3. Semester</option>
                <option value="4. Semester">4. Semester</option>
                <option value="5. Semester">5. Semester</option>
                <option value="6. Semester">6. Semester</option>
                <option value="7. Semester">7. Semester</option>
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

        <br>
        <input type="submit" name="update_info" value="Ändere deine Angaben">

    </form>

<br><br><br><br><br><br><br><br><br><br>


</body>
</html>
