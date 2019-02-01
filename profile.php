<?php
session_start();


$pageTitle = "Mein Profil";


include('header.php'); // in "header.php" ist auch "user_data.php" inkludiert und $_SESSION["angemeldet"];
include('Post.php');
include('Comment.php');
?>

<br><br><br><br><br><br>



<?php

$username = "";
// je nachdem, auf welcher Profilseite wir sind, heißt die Profilseite z.B. "profile.php?username=dani"
$isFollowing = False; //bedeutet, dass man einem Benutzer noch nicht folgt


if (isset($_GET['username'])) {

    if (DB::query('SELECT username FROM list5 WHERE username=:username', array(':username'=>$_GET['username']))) {
        // Wir definieren zuerst die Variablen (bevor der Button geklickt wird) wie folgt:

        $username = DB::query('SELECT username FROM list5 WHERE username=:username', array(':username'=>$_GET['username']))[0]['username'];
        //$username = ":username", den in der URL angegeben ist, muss dem "username" in der Datenbank entsprechen

        $userid = DB::query('SELECT id FROM list5 WHERE username=:username', array(':username'=>$_GET['username']))[0]['id'];
        // "$userid" ist die "id" der Person, auf deren Profilseite wir sind (das kann auch unsere Profilseite sein, aber auch die Profilseite von einem anderen Benutzer)

        /* beim "$userid" wird die "id" gespeichert, die dem "username" in der Datenbank gehört, der wiederum dem ":username" in der URL entsprechen muss
          -> anders formuliert: die "id" aus der Datenbank auswählen, wo "username" in der Datenbank dem ":username" in der URL entspricht
           und diese "id" dann bei der Variable "$userid" speichern */

        $followerid = $user_loggedin; //"followerid" ist die "id" des Benutzers, der sich eingeloggt hat
        //'$user_loggedin' ist die "id" der eingeloggten Person (in header.php bzw. in "user_data.php" definiert: "$user_loggedin = $_SESSION['angemeldet'];"
        // wenn man auf seiner eigenen Profilseite ist, dann sind die "$userid=1" und die "$followerid=1" gleich
        // wenn man auf der Profilseite eines anderen Benutzers ist, dann ist z.B. die "$userid=3" und die eigene "followerid=1"


        if (isset($_POST['follow'])) { // wenn der Button "Follow" geklickt wird

            if ($userid != $followerid) { //folgender Code wird nur dann ausgeführt, wenn die eingeloggte Person nicht auf ihrer eigenen Profilseite ist
                if (!DB::query('SELECT follower_id FROM followers WHERE user_id=:userid AND follower_id=:followerid', array(':userid'=>$userid, ':followerid'=>$followerid))) {
                    /* die id der Person, die sich eingeloggt hat, muss in der Datenbank nicht neben der id der Person stehen, auf deren
                    Profilseite die eingeloggte Person ist;
                    d.h. es wird geprüft, ob neben z.B. user_id=3 (Profilseite anderes Benutzers)-> follower_id=1 steht (eingeloggter Benutzer)
                    wenn es nicht steht, dann darf man der Person folgen: */
                    DB::query('INSERT INTO followers VALUES (\'\', :userid, :followerid)', array(':userid'=>$userid, ':followerid'=>$followerid));
                }
                else {
                    echo 'Already following!';
                }
                /* wenn user_id=3 neben follower_id=1 steht, dann folgt die eingeloggte Person schon der Person, auf deren Profilseite wir sind  */

                $isFollowing = True; //bedeutet, dass man einem Benutzer schon folgt
            }
        }

        if (isset($_POST['unfollow'])) {
            if ($userid != $followerid) {
                if (DB::query('SELECT follower_id FROM followers WHERE user_id=:userid AND follower_id=:followerid', array(':userid'=>$userid, ':followerid'=>$followerid))) {
                    DB::query('DELETE FROM followers WHERE user_id=:userid AND follower_id=:followerid', array(':userid'=>$userid, ':followerid'=>$followerid));
                }
                $isFollowing = False;
            }
        }

        if (DB::query('SELECT follower_id FROM followers WHERE user_id=:userid AND follower_id=:followerid ', array(':userid'=>$userid, ':followerid'=>$followerid))) {
            //echo 'Already following!';
            $isFollowing = True;
        } /* Wir schreiben hier (außerhalb der Bedingung) fast den gleichen Code wie oben nochmals, sodass er ausgeführt wird, auch wenn der Follow-Button nicht geklickt wird:
          Siehe die Bedingung oben: "if (isset($_POST['follow'])) ..." */
    }

    if (isset($_POST['deletepost'])) {
        if (DB::query('SELECT id FROM posts WHERE id=:postid AND user_id=:userid', array(':postid'=>$_GET['postid'], ':userid'=>$followerid))) {
            DB::query('DELETE FROM posts WHERE id=:postid and user_id=:userid', array(':postid'=>$_GET['postid'], ':userid'=>$followerid));
            DB::query('DELETE FROM post_likes WHERE post_id=:postid', array(':postid'=>$_GET['postid']));
            DB::query('DELETE FROM comments WHERE post_id=:postid', array(':postid'=>$_GET['postid']));
            echo 'Post gelöscht!';
        }
    }

    if (isset($_POST['post'])) {

        if (isset($_FILES['file']['name'])) {

            if (!($_FILES['file']['name'] == "")) {

                $file = $_FILES['file'];
                $fileName = $_FILES['file']['name'];
                $fileTmpName = $_FILES['file']['tmp_name'];
                $fileSize = $_FILES['file']['size'];
                $fileError = $_FILES['file']['error'];
                $fileType = $_FILES['file']['type'];


                $fileExt = explode('.', $fileName);
                $fileActualExt = strtolower(end($fileExt));

                $allowed = array('jpg', 'jpeg', 'png');


                if (in_array($fileActualExt, $allowed)) {
                    if ($fileError === 0) {
                        if ($fileSize < 1000000) {
                            $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                            $fileDestination = "img_upload/post_pics/" . $fileNameNew;
                            move_uploaded_file($fileTmpName, $fileDestination);
                            $bild_id = $fileNameNew;

                        } else {
                            echo "Datei zu groß (max. Größe: 1 MB)";

                        }
                    } else {
                        echo "Upload Fehlgeschlagen";

                    }
                } else {
                    echo "Dateiformat nicht unterstützt";

                }
            }
        }

    }



    if (isset($_POST['post'])) {  //prüfen, ob  der Post-Button geklickt wurde und wenn ja:
        if ($_FILES['file']['size'] == 0) { // wenn der Post kein Bild enthält:
            Post::createPost($_POST['postbody'], $user_loggedin, $userid);
        } else { // wenn der Post ein Bild enthält
            $postid = Post::createImgPost($bild_id, $_POST['postbody'], $user_loggedin, $userid );
        }
    }
    /*  in "Post.php" sind die Variablen folgende: '$postbody', 'loggedIn_userid', '$profileUserId'
   --> die oben definierten Parameter: "$_POST['postbody'], $user_loggedin, $userid" werden dann an die Parameter in "Post.php" übergeben
    --> durch die Übertragung ($user_loggedin -> $loggedIn_userid etc.)  darf  die eingeloggte Person nur auf ihrer eigenen Profilseite posten
*/


    if (isset($_POST['like'])) {
        Post::likePost($_GET['postid'], $followerid);
    }

    if (isset($_POST['unlike'])) {
        Post::likePost($_GET['postid'], $followerid);
    }

    /*  in "Post.php" -> '$postid', '$likerId'
     --> die "$_GET['postid'], $followerid" werden dann an die Parameter in "Post.php" übergeben

    $followerid = die eingeloggte Person
    $likerid = die Person, die den Post geliked hat
    --> durch die Übertragung ($followerid -> $likerid)  kann man sehen, ob die eingeloggte Person den Post geliked hat
     */


    $profile_pic2 = DB::query('SELECT profile_pic FROM list5 WHERE id=:userid', array(':userid' => $userid))[0]['profile_pic'];

    $posts = Post::displayPosts($profile_pic2, $userid, $username, $followerid);

    /*
    $profile_pic2 = das ist das Profilbild der Person, auf deren Profilseite wir sind
    $profile_pic = das ist das Profilbild der eingeloggten Person

    $followerid -> $loggedIn_userid etc.  (Übertragung in Post.php)

    die Variable "$posts" ist gleich der "return-Wert" von dieser Methode

    in "Post.php" -> return $posts;
     "return" --> dies gibt die Variable '$posts = "";' zurück , die all den HTML-Code und alle Posts beinhaltet
    */


    if (isset($_POST['comment'])) {
        if (DB::query('SELECT id FROM posts WHERE id=:postid AND user_id=:userid', array(':postid' => $_GET['postid'], ':userid' => $followerid))) {
            Comment::createComment($_POST['commentbody'], $_GET['postid'], $followerid);
        }
    }

} else {
    die('User not found!');
}

?>


<main class="container">
<div class="row">
    <div class="col-lg-3 profile_pic" style="margin-top: 0;">
        <a href='img_upload/profile_pics/<?php echo $profile_pic2;?>'>      <img src='img_upload/profile_pics/<?php echo $profile_pic2;?>'></a>

        <?php
        if ($userid == $followerid) { //nur wenn die eingeloggte Person  auf ihrer eigenen Profilseite ist, wird die Funktion "Profil bearbeiten" angezeigt
            echo '<a href="account-settings.php">Profil bearbeiten</a>';
        }
        ?>
        <div class="bgwhite profile_pic" style="margin-bottom: 20px; padding: 20px;">
            <h2>Profil von <?php echo $username; ?></h2>
            <div class="user_details_left_right">
                <?php
                echo $fname2 . " " . $lname2."<br>";
                echo $age2. " ". 'Jahre alt'."<br>";
                echo $studiengang2."<br>";
                echo $semester2. ". ". ' Semester '."<br>";
                echo ' Interessen: '.$interessen2. " "."<br>";
                // diese sind in "user_data.php" definiert --> das sind die Infos der Person, auf deren Profilseite wir sind


                echo"<a href='followers.php?username=".$username."'> Followers</a>";
                echo"<a href='following.php?username=".$username."'> Following</a> ";
                ?>

            </div><!-- user details -->

            <form action="profile.php?username=<?php echo $username; ?>" method="post">

                <?php

                if ($userid != $followerid) { //nur wenn die eingeloggte Person nicht auf ihrer eigenen Profilseite ist, wird der Button angezeigt
                    if ($isFollowing) {
                        echo '<input type="submit" name="unfollow" value="Unfollow">';
                    } else {
                        echo '<input type="submit" name="follow" value="Follow">';
                    }
                }
                //wenn "$isFollowing = True" wird der Unfollow-Button gezeigt
                //wenn "$isFollowing = False" wird der Follow-Button gezeigt

                echo"<a href='messages.php?receiver=".$userid."' style='display: block; padding: 16px 0;'> Schreibe eine Nachricht</a> ";
                ?>

            </form>
        </div>
    </div>
    <div class="col-lg-9">


        <div class="bgwhite" style="padding: 20px; margin-bottom: 20px;">

        <form class="post_form" action="profile.php?username=<?php echo $username; ?>" method="POST" enctype="multipart/form-data">

            <textarea name="postbody" rows="8" cols="80" placeholder="Schreibe etwas..."></textarea>
            <input type="file" name="file">
            <input type="submit" name="post" value="Post">

        </form>
        </div>

        <div class="bgwhite" style="padding: 20px;">

        <div class="posts_area"></div>
        <!-- <button id="load_more">Load More Posts</button>
        <img id="loading" src="images/icons/loading.gif">

        <!--Anzeigen von Posts (oben wird die Variable definiert: $posts = Post::displayPosts...)-->
        <div class="posts">
            <?php echo $posts;
            ?>
        </div>

    </div>
    </div>
</div>


</main>

<?php
include('footer.php');
?>


