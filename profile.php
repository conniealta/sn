<?php
session_start();
?>


<!DOCTYPE html> <!-- das ist HTML 5 -->
<html lang="de">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <title> Mein Profil </title>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    <style>
        body {
            font-size: 20px;
            margin: 0;
            padding: 0;
            font-family: sans-serif;
        }

        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
            position: -webkit-sticky; /* Safari */
            position: sticky;
            top: 0;
        }

        li {
            float: left;
        }

        li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        li a:hover {
            background-color: #111;
        }

        .active {
            background-color: #bd4147;
        }
    </style>

</head>



<body>

<div class="header">
    <h2>Scroll Down</h2>
    <p>Scroll down to see the sticky effect.</p>
    <h2>Scroll Down</h2>
    <p>Scroll down to see the sticky effect.</p>
    <h2>Scroll Down</h2>
    <p>Scroll down to see the sticky effect.</p>

</div>


<ul>
    <li><a class="active" href="index.php">Feed</a></li>
    <li><a href="profile.php">Profil </a></li>
    <li><a class="wi" href="messages.html">Messages</a></li>
    <li><a href="notify.php">Benachrichtigungen</a></li>
</ul>


<br><br><br><br>

<a href="logout.php">Log out!</a>








<?php
include('DB.php');
include('Post.php');
include('Comment.php');

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


<?php
/*$profile_pic = DB::query('SELECT profile_pic FROM list5 WHERE id=:userid', array(':userid' => $userid2))[0]['profile_pic'];
$lname = DB::query('SELECT last_name FROM list5 WHERE id=:userid', array(':userid' => $userid2))[0]['last_name'];
$fname = DB::query('SELECT first_name FROM list5 WHERE id=:userid', array(':userid' => $userid2))[0]['first_name'];
$user_name = DB::query('SELECT username FROM list5 WHERE id=:userid', array(':userid' => $userid2))[0]['username'];

//echo "<a href='img_upload/profile_pics/$profile_pic'></a>      <img src='img_upload/profile_pics/$profile_pic'>"
*/?>




<!--<h1> Das Profil von '--><?php //echo $user_name; ?><!--'</h1>-->
<!---->
<!---->
<!---->
<!--<div class="user_details column">-->
<!---->
<!--    <a href='img_upload/profile_pics/--><?php //echo $profile_pic;?><!--'>      <img src='img_upload/profile_pics/--><?php //echo $profile_pic;?><!--'></a>-->
<!---->
<!--    <div class="user_details_left_right">-->
<!--        <a href="--><?php //echo $userid2; ?><!--">-->
<!--            --><?php
//            echo $fname . " " . $lname;
//
//            ?>
<!--        </a>-->
<!--    </div>-->
<!---->
<!--</div>-->
<!---->
<!---->
<!--<br><br><br><br><br><br><br><br><br><br>-->
<!--<form action="upload_profile_pic.php" method="POST" enctype="multipart/form-data">-->
<!--    <input type="file" name="file">-->
<!--    <button type="submit" name="submit"> Upload Profile Pic </button>-->
<!---->
<!--</form>-->






<br><br>


<?php
//Das nicht:
//<div class="main_column column">
//    <form class="post_form" action="upload_pic.php" method="POST" enctype="multipart/form-data">
//        <input type="file" name="file">
//        <textarea name="postbody" rows="8" cols="80" placeholder="Got something to say?"></textarea>
//        <input type="submit" name="submit" value="Post">
//        <hr>
//
//    </form>
//
//    <div class="posts_area"></div>
//    <!-- <button id="load_more">Load More Posts</button> -->
//    <img id="loading" src="images/icons/loading.gif">
//</div>
//?>


<?php
//form action="upload_pic" --> dort muss die Funktion createPost und createImgPost geschrieben werden
// aber damit die anderen Funktionen funktionieren muss form action="profile.php" weil die hier wie Post:likePost etc. geschrieben werden
//bei der einen form --> ist der button "submit" (if isset['submit'])
//bei der anderen --> heißt er "post" (if isset['post'])
?>


<!--<h1>Hier</h1>-->
<!--<div class="main_column column">-->
<!--    <form class="post_form" action="profile.php" method="POST" enctype="multipart/form-data">-->
<!--        <input type="file" name="file">-->
<!--        <textarea name="postbody" rows="8" cols="80" placeholder="Got something to say?"></textarea>-->
<!--        <input type="submit" name="submit" value="Post">-->
<!--        <hr>-->
<!---->
<!--    </form>-->
<!---->
<!--    <div class="posts_area"></div>-->
<!--    <!-- <button id="load_more">Load More Posts</button> -->-->
<!--    <img id="loading" src="images/icons/loading.gif">-->
<!--</div>-->





<!--<form action="profile.php" method="post">-->
<!--    <textarea name="postbody" rows="8" cols="80"></textarea>-->
<!--    <input type="submit" name="post" value="Post">-->
<!--</form>-->
<!---->
<!---->
<!--<br><br><br>-->





<?php

/* Das nicht:
 $pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de;dbname=u-ka034', 'ka034', 'zeeD6athoo',array('charset'=>'utf8'));

$statement = $pdo->prepare("SELECT * FROM img_upload ");

if($statement->execute()) {
    while ($user = $statement->fetchObject()) {
        $img_id = $user->img_id;
    }
}

echo "<a href='img_upload/post_pics/$img_id'></a>      <img src='img_upload/post_pics/$img_id'>";*/






/*if (isset($_POST['submit'])) {
    if ($_FILES['file']['size'] == 0) {
        Post::createPost($_POST['postbody'], $user_loggedin, $userid);
        $posts= Post::displayPosts2 ($username, $user_loggedin);
    } else {
        $postid = Post::createImgPost($_POST['postbody'], $user_loggedin, $userid);
    }
}*/
?>



<!-- Das nicht:
<div class="posts">
    <?php /*echo $posts; //$posts = Post::displayPosts2 */?>
</div>
-->



<?php
//
//
//// je nachdem, auf welcher Profilseite wir sind, heißt die Profilseite z.B. "profile2.php?username=conniealta"
//$isFollowing = False; //bedeutet, dass man einem Benutzer noch nicht folgt
//
////PROBLEM !!! --> jetzt werden die neue Posts zwar angezeigt bei der Profilseite, aber sie werden  in der Datenbank nicht gespeichert obwohl alles stimmt...(siehe createPost --> INSERT into posts ...)
//
//if (isset($_SESSION['angemeldet'])) {
//
//    //if (DB::query('SELECT username FROM list5 WHERE username=:username', array(':username'=>$_GET['username']))) {
//
//        // Wir definieren zuerst die Variablen (bevor der Button geklickt wird) wie folgt:
//
//        //$username = DB::query('SELECT username FROM list5 WHERE username=:username', array(':username'=>$_GET['username']))[0]['username'];
//        //$username = ":username", den wir in die URL angeben, muss dem "username" in der Datenbank entsprechen
//
//    if (DB::query('SELECT username FROM list5 WHERE id=:userid', array(':userid'=>$userid2))) {
//        $username = DB::query('SELECT username FROM list5 WHERE id=:userid', array(':userid' => $userid2))[0]['username'];
//
//        $userid = DB::query('SELECT id FROM list5 WHERE username=:username', array(':username'=>$username))[0]['id'];
//        // "$userid" ist die "id" der Person, auf deren Profilseite wir sind (das kann auch unsere Profilseite sein, aber auch die Profilseite von einem anderen Benutzer)
//
//        /* beim "$userid" wird die "id" gespeichert, die dem "username" in der Datenbank gehört, der wiederum dem ":username" in der URL entsprechen muss
//          -> anders formuliert: die "id" aus der Datenbank auswählen, wo "username" in der Datenbank dem ":username" in der URL entspricht
//           und diese "id" dann bei der Variable "$userid" speichern */
//
//        $followerid = $userid2; //"followerid" ist die "id" des Benutzers, der sich eingeloggt hat
//        //'$userid2' ist die "id" der eingeloggten Person (oben definiert: "$userid2 = $_SESSION['angemeldet'];"
//        // wenn man auf seiner eigenen Profilseite ist, dann sind die "$userid=1" und die "$followerid=1" gleich
//        // wenn man auf der Profilseite eines anderen Benutzers ist, dann ist z.B. die "$userid=3" und die eigene "followerid=1"
//
//
//
//        if (isset($_POST['follow'])) {
//
//            if ($userid != $followerid) { //dieser Code wird nur dann ausgeführt, wenn die eingeloggte Person nicht auf ihrer eigenen Profilseite ist
//                if (!DB::query('SELECT follower_id FROM followers WHERE user_id=:userid AND follower_id=:followerid', array(':userid'=>$userid, ':followerid'=>$followerid))) {
//                    /* die id der Person, die sich eingeloggt hat, muss in der Datenbank nicht neben der id der Person stehen, auf deren
//                    Profilseite die eingeloggte Person ist;
//                    d.h. es wird geprüft, ob neben z.B. user_id=3 (Profilseite anderes Benutzers)-> follower_id=1 steht (eingeloggter Benutzer)
//                    wenn es nicht steht, dann darf man der Person folgen */
//                    DB::query('INSERT INTO followers VALUES (\'\', :userid, :followerid)', array(':userid'=>$userid, ':followerid'=>$followerid));
//                }
//                else {
//                    echo 'Already following!';
//                }
//                /* wenn user_id=3 neben follower_id=1 steht, dann folgt die eingeloggte Person schon der Person, auf deren Profilseite wir sind  */
//
//                $isFollowing = True; //bedeutet, dass man einem Benutzer schon folgt
//            }
//        }
//
//        if (isset($_POST['unfollow'])) {
//            if ($userid != $followerid) {
//                if (DB::query('SELECT follower_id FROM followers WHERE user_id=:userid AND follower_id=:followerid', array(':userid'=>$userid, ':followerid'=>$followerid))) {
//                    DB::query('DELETE FROM followers WHERE user_id=:userid AND follower_id=:followerid', array(':userid'=>$userid, ':followerid'=>$followerid));
//                }
//                $isFollowing = False;
//            }
//        }
//
//        if (DB::query('SELECT follower_id FROM followers WHERE user_id=:userid AND follower_id=:followerid ', array(':userid'=>$userid, ':followerid'=>$followerid))) {
//            //echo 'Already following!';
//            $isFollowing = True;
//        } /* Wir schreiben hier (außerhalb der Hauptbedingung) fast den gleichen Code wie oben nochmals, sodass er ausgeführt wird, auch wenn der Follow-Button nicht geklickt wird:
//          Siehe die Bedingung oben: "if (isset($_POST['follow'])) ..." */
//    }
//
//    if (isset($_POST['deletepost'])) {
//        if (DB::query('SELECT id FROM posts WHERE id=:postid AND user_id=:userid', array(':postid'=>$_GET['postid'], ':userid'=>$followerid))) {
//            DB::query('DELETE FROM posts WHERE id=:postid and user_id=:userid', array(':postid'=>$_GET['postid'], ':userid'=>$followerid));
//            DB::query('DELETE FROM post_likes WHERE post_id=:postid', array(':postid'=>$_GET['postid']));
//            DB::query('DELETE FROM comments WHERE post_id=:postid', array(':postid'=>$_GET['postid']));
//            echo 'Post gelöscht!';
//        }
//    }
//
//    if (isset($_POST['comment'])) {
//        if (DB::query('SELECT id FROM posts WHERE id=:postid AND user_id=:userid', array(':postid' => $_GET['postid'], ':userid' => $followerid))) {
//            Comment::createComment($_POST['commentbody'], $_GET['postid'], $followerid);
//            //wir ändern '$followerid' zu '$user_loggedin', weil in dieser Datei die Variable einfach umbenannt wurde
//        }
//    }
//
//
//
//    if(isset($_POST['submit'])){
//        $file = $_FILES['file'];
//
//        $fileName = $_FILES['file']['name'];
//        $fileTmpName = $_FILES['file']['tmp_name'];
//        $fileSize = $_FILES['file']['size'];
//        $fileError = $_FILES['file']['error'];
//        $fileType = $_FILES['file']['type'];
//
//
//        $fileExt = explode('.', $fileName);
//        $fileActualExt = strtolower(end($fileExt));
//
//        $allowed = array('jpg', 'jpeg', 'png');
//
//
//        if (in_array($fileActualExt, $allowed)){
//            if($fileError === 0){
//                if($fileSize< 1000000){
//                    $fileNameNew = uniqid('', true).".".$fileActualExt;
//                    $fileDestination = "img_upload/post_pics/".$fileNameNew;
//                    move_uploaded_file($fileTmpName,$fileDestination);
//                    $bild_id = $fileNameNew;
//
//                    /*$pdo = new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ka034', 'ka034', 'zeeD6athoo', array('charset' => 'utf8'));
//                    $sql = "INSERT INTO posts (user_id, img_id) VALUES (?, ?)";
//
//                    $statement = $pdo->prepare($sql);
//                    $statement->execute(array("$user_id", "$bild_id"));*/
//
//                    Post::createImgPost($bild_id, $userid2, $userid);
//
//                }else {
//                    echo"Deine Datei ist zu groß! (Max Größe 1MB)";
//
//                }
//            }else {
//                echo"Leider gab es ein Problem! :(";
//
//            }
//        }else {
//            echo"Dieses Dateiformat wird nicht unterstützt!";
//
//        }
//
//    }
//
//
//    if (isset($_POST['submit'])) {
//        if ($_FILES['file']['size'] == 0) {
//            Post::createPost($_POST['postbody'], $userid2, $userid);
//        } else {
//            $postid = Post::createImgPost($bild_id, $userid2, $userid);
//        }
//    }
//
//
//
//
//    if (isset($_POST['submit'])) { //prüfen, ob  der Post-Button geklickt wurde und wenn ja:
//
//        Post::createPost($_POST['postbody'], $userid2, $userid);
//        /*  in "Post.php" -> '$postbody', 'loggedIn_userid', '$profileUserId'
//
//        --> die "$_POST['postbody'], $userid2, $userid" werden dann an die Parameter in "Post.php" übergeben
//
//        "$userid2 = $_SESSION['angemeldet'];" (oben definiert) -> das ist die "id" der eingeloggten Person
//        $userid = die 'id' der Person, auf deren Profilseite die eingeloggte Person ist
//
//       --> durch die Übertragung ($userid2 -> $loggedIn_userid etc.)  darf  die eingeloggte Person nur auf ihrer eigenen Profilseite posten
//        */
//
//    }
//
//    if (isset($_GET['postid'])) {
//        Post::likePost($_GET['postid'], $followerid);
//    }
//    /*  in "Post.php" -> '$postid', '$likerId'
//     --> die "$_GET['postid'], $followerid" werden dann an die Parameter in "Post.php" übergeben
//
//    $followerid = die eingeloggte Person
//    $likerid = die Person, die den Post geliked hat
//    --> durch die Übertragung ($followerid -> $likerid)  kann man sehen, ob die eingeloggte Person den Post geliked hat
//     */
//
//
//
//    $posts = Post::displayPosts($userid, $username, $followerid);
//    /*
//    $followerid -> $loggedIn_userid etc.  (Übertragung in Post.php)
//
//    die Variable "$posts" ist gleich der "return-Wert" von dieser Methode
//
//    in Post.php -> return $posts;
//     "return" --> dies gibt die Variable '$posts = "";' zurück , die all den HTML-Code und alle Posts beinhaltet
//    */
//
//    Comment::displayComments($_GET['postid']);
//    Comment::displayComments($posts['id']); //-> damit werden die Kommentare nicht unter den Posts sondern ganz oben angezeigt
//
//    // PROBLEM ! --> Kommentare werden nicht angezeigt ... Die werden nur beim Feed angezeigt. Ich hab auch so probiert:
//    //$comments = Comment::displayComments($_GET['postid']);
//    // $comment = Comment::displayComments($_GET['postid']);
//    //Comment::displayComments($posts['id']);
//
//
//
//    if (isset($_POST['comment'])) {
//        Comment::createComment($_POST['commentbody'], $_GET['postid'], $followerid); //wir ändern '$followerid' zu '$user_loggedin', weil in dieser Datei die Variable einfach umbenannt wurde
//    }
//
//} else {
//    die('User not found!');
//}
//
//?>





























<?php

$profile_pic = DB::query('SELECT profile_pic FROM list5 WHERE id=:userid', array(':userid' => $userid2))[0]['profile_pic'];
$lname = DB::query('SELECT last_name FROM list5 WHERE id=:userid', array(':userid' => $userid2))[0]['last_name'];
$fname = DB::query('SELECT first_name FROM list5 WHERE id=:userid', array(':userid' => $userid2))[0]['first_name'];
$user_name = DB::query('SELECT username FROM list5 WHERE id=:userid', array(':userid' => $userid2))[0]['username'];



$username = "";
// je nachdem, auf welcher Profilseite wir sind, heißt die Profilseite z.B. "profile2.php?username=conniealta"
$isFollowing = False; //bedeutet, dass man einem Benutzer noch nicht folgt


// $user_name
//$user_name = DB::query('SELECT username FROM list5 WHERE id=:userid', array(':userid' => $userid2))[0]['username'];
// if (isset($_SESSION["angemeldet"]))

if (isset($_GET['username'])) {

    if (DB::query('SELECT username FROM list5 WHERE username=:username', array(':username'=>$_GET['username']))) {
        // Wir definieren zuerst die Variablen (bevor der Button geklickt wird) wie folgt:

        $username = DB::query('SELECT username FROM list5 WHERE username=:username', array(':username'=>$_GET['username']))[0]['username'];
        //$username = ":username", den wir in die URL angeben, muss dem "username" in der Datenbank entsprechen

        $userid = DB::query('SELECT id FROM list5 WHERE username=:username', array(':username'=>$_GET['username']))[0]['id'];
        // "$userid" ist die "id" der Person, auf deren Profilseite wir sind (das kann auch unsere Profilseite sein, aber auch die Profilseite von einem anderen Benutzer)

        /* beim "$userid" wird die "id" gespeichert, die dem "username" in der Datenbank gehört, der wiederum dem ":username" in der URL entsprechen muss
          -> anders formuliert: die "id" aus der Datenbank auswählen, wo "username" in der Datenbank dem ":username" in der URL entspricht
           und diese "id" dann bei der Variable "$userid" speichern */

        $followerid = $userid2; //"followerid" ist die "id" des Benutzers, der sich eingeloggt hat
        //'$userid2' ist die "id" der eingeloggten Person (oben definiert: "$userid2 = $_SESSION['angemeldet'];"
        // wenn man auf seiner eigenen Profilseite ist, dann sind die "$userid=1" und die "$followerid=1" gleich
        // wenn man auf der Profilseite eines anderen Benutzers ist, dann ist z.B. die "$userid=3" und die eigene "followerid=1"



        if (isset($_POST['follow'])) {

            if ($userid != $followerid) { //dieser Code wird nur dann ausgeführt, wenn die eingeloggte Person nicht auf ihrer eigenen Profilseite ist
                if (!DB::query('SELECT follower_id FROM followers WHERE user_id=:userid AND follower_id=:followerid', array(':userid'=>$userid, ':followerid'=>$followerid))) {
                    /* die id der Person, die sich eingeloggt hat, muss in der Datenbank nicht neben der id der Person stehen, auf deren
                    Profilseite die eingeloggte Person ist;
                    d.h. es wird geprüft, ob neben z.B. user_id=3 (Profilseite anderes Benutzers)-> follower_id=1 steht (eingeloggter Benutzer)
                    wenn es nicht steht, dann darf man der Person folgen */
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
        } /* Wir schreiben hier (außerhalb der Hauptbedingung) fast den gleichen Code wie oben nochmals, sodass er ausgeführt wird, auch wenn der Follow-Button nicht geklickt wird:
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

    if (isset($_POST['comment'])) {
        if (DB::query('SELECT id FROM posts WHERE id=:postid AND user_id=:userid', array(':postid' => $_GET['postid'], ':userid' => $followerid))) {
            Comment::createComment($_POST['commentbody'], $_GET['postid'], $followerid);
            //wir ändern '$followerid' zu '$user_loggedin', weil in dieser Datei die Variable einfach umbenannt wurde
        }
    }


    if(isset($_POST['post'])){
        $file = $_FILES['file'];

        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];


        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png');


        if (in_array($fileActualExt, $allowed)){
            if($fileError === 0){
                if($fileSize< 1000000){
                    $fileNameNew = uniqid('', true).".".$fileActualExt;
                    $fileDestination = "img_upload/post_pics/".$fileNameNew;
                    move_uploaded_file($fileTmpName,$fileDestination);
                    $bild_id = $fileNameNew;

                    /*$pdo = new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ka034', 'ka034', 'zeeD6athoo', array('charset' => 'utf8'));
                    $sql = "INSERT INTO posts (user_id, img_id) VALUES (?, ?)";

                    $statement = $pdo->prepare($sql);
                    $statement->execute(array("$user_id", "$bild_id"));*/

//                    Post::createImgPost($bild_id, $userid2, $userid);

                }else {
                    echo"Deine Datei ist zu groß! (Max Größe 1MB)";

                }
            }else {
                echo"Leider gab es ein Problem! :(";

            }
        }else {
            echo"Dieses Dateiformat wird nicht unterstützt!";

        }

    }


    if (isset($_POST['post'])) {
        if ($_FILES['file']['size'] == 0) {
            Post::createPost($_POST['postbody'], $userid2, $userid);
        } else {
            $postid = Post::createImgPost($bild_id, $userid2, $userid); // Füg eine Variable "postbody" hinzu damit man auch Bilder mit Texte posten kann
        }
    }
    //Das PROBLEM: wenn man einen Text postet, ist alles ok --> wenn man ein Bild postet, wird dieses zweimal angezeigt




//
//    if (isset($_POST['post'])) { //prüfen, ob  der Post-Button geklickt wurde und wenn ja:
//
//        Post::createPost($_POST['postbody'], $userid2, $userid);
//        /*  in "Post.php" -> '$postbody', 'loggedIn_userid', '$profileUserId'
//
//        --> die "$_POST['postbody'], $userid2, $userid" werden dann an die Parameter in "Post.php" übergeben
//
//        "$userid2 = $_SESSION['angemeldet'];" (oben definiert) -> das ist die "id" der eingeloggten Person
//        $userid = die 'id' der Person, auf deren Profilseite die eingeloggte Person ist
//
//       --> durch die Übertragung ($userid2 -> $loggedIn_userid etc.)  darf  die eingeloggte Person nur auf ihrer eigenen Profilseite posten
//        */
//
//    }


    if (isset($_GET['postid'])) {
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

    in Post.php -> return $posts;
     "return" --> dies gibt die Variable '$posts = "";' zurück , die all den HTML-Code und alle Posts beinhaltet
    */

  Comment::displayComments($_GET['postid']);
    Comment::displayComments($posts['id']); //-> damit werden die Kommentare nicht unter den Posts sondern ganz oben angezeigt

  // PROBLEM ! --> Kommentare werden nicht angezeigt ... Die werden nur beim Feed angezeigt. Ich hab auch so probiert:
    //$comments = Comment::displayComments($_GET['postid']);
    // $comment = Comment::displayComments($_GET['postid']);
    //Comment::displayComments($posts['id']);



    if (isset($_POST['comment'])) {
        Comment::createComment($_POST['commentbody'], $_GET['postid'], $followerid); //wir ändern '$followerid' zu '$user_loggedin', weil in dieser Datei die Variable einfach umbenannt wurde
    }

} else {
    die('User not found!');
}





?>




<h1>Das Profil von '<?php echo $username; ?>'</h1>


<form action="profile.php?username=<?php echo $username; ?>" method="post">

    <?php

    $lname2 = DB::query('SELECT last_name FROM list5 WHERE id=:userid', array(':userid' => $userid))[0]['last_name'];
    $fname2 = DB::query('SELECT first_name FROM list5 WHERE id=:userid', array(':userid' => $userid))[0]['first_name'];
    $user_name2 = DB::query('SELECT username FROM list5 WHERE id=:userid', array(':userid' => $userid))[0]['username'];

    if ($userid != $followerid) { //nur wenn die eingeloggte Person nicht auf ihrer eigenen Profilseite ist, wird der Button angezeigt
        if ($isFollowing) {
            echo '<input type="submit" name="unfollow" value="Unfollow">';
        } else {
            echo '<input type="submit" name="follow" value="Follow">';
        }
    }
    //wenn "$isFollowing = True" wird der Unfollow-Button gezeigt
    //wenn "$isFollowing = False" wird der Follow-Button gezeigt
    ?>

    <div class="user_details column">

        <a href='img_upload/profile_pics/<?php echo $profile_pic2;?>'>      <img src='img_upload/profile_pics/<?php echo $profile_pic2;?>'></a>

        <div class="user_details_left_right">
            <a href="<?php echo $userid; ?>">
                <?php
                echo $fname2 . " " . $lname2;

                ?>
            </a>
        </div>

    </div>


</form>


<!--<br><br><br><br><br><br><br><br>-->
<!---->
<!--<h1> Das Profil von '--><?php //echo $user_name; ?><!--'</h1>-->
<!---->
<!---->
<!---->
<!--<div class="user_details column">-->
<!---->
<!--    <a href='img_upload/profile_pics/--><?php //echo $profile_pic;?><!--'>      <img src='img_upload/profile_pics/--><?php //echo $profile_pic;?><!--'></a>-->
<!---->
<!--    <div class="user_details_left_right">-->
<!--        <a href="--><?php //echo $userid2; ?><!--">-->
<!--            --><?php
//            echo $fname . " " . $lname;
//
//            ?>
<!--        </a>-->
<!--    </div>-->
<!---->
<!--</div>-->


<br><br><br><br><br><br><br><br><br><br>
<form action="upload_profile_pic.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="file">
    <button type="submit" name="submit"> Upload Profile Pic </button>

</form>





<!--<form action="profile.php?username=--><?php ///*echo $username; */?><!--" method="post">-->
<!--    <textarea name="postbody" rows="8" cols="80"></textarea>-->
<!--    <input type="submit" name="post" value="Post">-->
<!--</form>-->

<br><br>

<div class="main_column column">
    <form class="post_form" action="profile.php?username=<?php echo $username; ?>" method="POST" enctype="multipart/form-data">
        <input type="file" name="file">
        <textarea name="postbody" rows="8" cols="80" placeholder="Got something to say?"></textarea>
        <input type="submit" name="post" value="Post">
        <hr>

    </form>

    <div class="posts_area"></div>
    <!-- <button id="load_more">Load More Posts</button> -->
    <img id="loading" src="images/icons/loading.gif">
</div>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>




<!--Anzeigen von Posts ($posts = Post::displayPosts...)-->
<div class="posts">
    <?php echo $posts; ?>
</div>


</body>

</html>

