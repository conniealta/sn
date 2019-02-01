<?php
session_start();


$pageTitle = "Alcyone - Meine Follower";


include('header.php'); // in "header.php" ist auch "user_data.php" inkludiert und $_SESSION["angemeldet"];
?>

<main class="container" style="padding-top:20px;">
<h1> Followers - Wer folgt mir? </h1>
<br><br>




<?php

$username = "";
// je nachdem, auf welcher Profilseite wir sind, heißt die Profilseite z.B. "profile2.php?username=dani"



if (isset($_GET['username'])) {

    if (DB::query('SELECT username FROM list5 WHERE username=:username', array(':username' => $_GET['username']))) {
        // Wir definieren zuerst die Variablen (bevor der Button geklickt wird) wie folgt:

        $username = DB::query('SELECT username FROM list5 WHERE username=:username', array(':username' => $_GET['username']))[0]['username'];
        //$username = ":username", den in der URL angegeben ist, muss dem "username" in der Datenbank entsprechen

        $userid = DB::query('SELECT id FROM list5 WHERE username=:username', array(':username' => $_GET['username']))[0]['id'];
        // "$userid" ist die "id" der Person, auf deren Profilseite wir sind (das kann auch unsere Profilseite sein, aber auch die Profilseite von einem anderen Benutzer)

        /* beim "$userid" wird die "id" gespeichert, die dem "username" in der Datenbank gehört, der wiederum dem ":username" in der URL entsprechen muss
          -> anders formuliert: die "id" aus der Datenbank auswählen, wo "username" in der Datenbank dem ":username" in der URL entspricht
           und diese "id" dann bei der Variable "$userid" speichern */

        $followerid = $user_loggedin; //"followerid" ist die "id" des Benutzers, der sich eingeloggt hat
        //'$user_loggedin' ist die "id" der eingeloggten Person (in header.php bzw. in "user_data.php" definiert: "$user_loggedin = $_SESSION['angemeldet'];"
        // wenn man auf seiner eigenen Profilseite ist, dann sind die "$userid=1" und die "$followerid=1" gleich
        // wenn man auf der Profilseite eines anderen Benutzers ist, dann ist z.B. die "$userid=3" und die eigene "followerid=1"

    }

    $dbfollowers = DB::query('SELECT list5.username, list5.profile_pic FROM list5, followers
                             WHERE list5.id = followers.follower_id
                             AND user_id = :userid', array(':userid' => $userid));// $userid = die "id" der Person, auf deren Profilseite wir sind
                      // -> d.h. je nachdem auf welcher Profilseite man ist, kann man sowohl seine Followers als auch die Followers der anderen Benutzer sehen


    foreach ($dbfollowers as $f) {

        $username = $f['username'];

        echo "<img style='width: 75px; height: 75px; border-radius: 55px; margin-left:10px;' src='img_upload/profile_pics/" . $f['profile_pic'] . "'>" . ' ' . ' ' . "<a href='profile.php?username=" . $username . " ' >" . $f['username'] . '</a>';
        echo "<hr>";
    }

}
else {
    die('User not found!');
}

?>


<form action="followers.php?username=<?php echo $username; ?>" method="post">
</main>

</form>