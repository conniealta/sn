<?php
session_start();

include('header.php'); // in "header.php" ist auch "user_data.php" inkludiert und $_SESSION["angemeldet"];
include('Post.php');
include('Comment.php');

?>
<!--Das hier schiebt das Willkommen runter...-Lori-->
<!--

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Alcyone</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>

    </button>


    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">


            <li class="nav-item active">
                <a class="nav-link " href="index.php">Home</a>     <!-- HIER WÄRE EIN LOGO NICE MIT DEM MAN AUF DIE STARTSEITE KOMMT - LORI
           ACTIVE HIER WEIL WIR UNS AUF DER HOME BEFINDEN -->

<!--
            </li>


            <li class="nav-item">
                <?php /*
                include('user_data.php');
                $user_loggedin = $_SESSION['angemeldet'];
                $username = DB::query('SELECT username FROM list5 WHERE id=:userid', array(':userid' => $user_loggedin))[0]['username'];
                echo "<a class='nav-link' href='profile.php?username='$username'>Mein Profil</a>"
              */ ?>
                <!-- Eigentlich muss ich hier php einbinden damit profilname angezeigt wird...<ul>


        <li>
            <?php /*
                session_start();
                include ('user_data.php');
                $user_loggedin = $_SESSION['angemeldet'];
                $username = DB::query('SELECT username FROM list5 WHERE id=:userid', array(':userid' => $user_loggedin))[0]['username'];
                echo "<a class='active' href='index.php?username=$username'>Feed</a>"
                ?>

        </li>

        <li>

            <?php
                echo "<a href='profile.php?username=$username'>Profil</a>"
                */ ?>         <!-- hier habe ich die Navbar alt integriert - warum kann ich hier die profilseite nitcht mit php integrieren?-->
<!-- </li>
            <li>
                <?php /*
                echo "<a  href='my-messages.php?username=$username'>Messages</a>"
                ?>
            </li>

            <li class="dropdown">
                <?php
                echo "<a href='notify.php?username=$username'>Benachrichtigungen</a>"
                ?>
            </li>

            <li>


            </li>

            <!--                                                               Auskommentiert weil es mir komplett die Navbar verschiebt - Lori
            <li class="nav-item">
                <?php /*
                session_start();
                include('user_data.php');
                $user_loggedin = $_SESSION['angemeldet'];
                $username = DB::query('SELECT username FROM list5 WHERE id=:userid', array(':userid' => $user_loggedin))[0]['username'];
                echo "<a class='active' href='index.php?username=$username'>Feed</a>"*/
?>

                <a class="nav-link" href='profile.php?username=$username'>Mein Profil</a>
            </li>--->
<!--
            <li class="nav-item">
                <a class="nav-link" href="my-messages.php?username=$username">Messages</a>
                <!--hier link auf seite messages.php

            <li class="nav-item">
                <a class="nav-link " href="notify.php?username=$username">Benachrichtigungen</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="logout.php">Ausloggen</a>
            </li>


    </div>

    <!-- DAS IST DIE BOOTSTRAP SUCHLEISTE Icon anstelle von Search wäre cool - MUSS NOCH FORMULAR BEKOMMEN WIE ANDERE LEISTE UM AUCH DIE LEUTE ZU FINDEN CONNY FRAGEN - LORI

    <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">
            <span class="glyphicon glyphicon-search"></span>
        </button>
    </form>


</nav>
nav -->

<main class="container">
    <!--mit container mittig gesetzt - mit container fluid ist es auf komplette bildbreite verteilt-->
    <h1 class="py-5"> Willkommen, <?php echo $user_name; ?></h1>    <!-- die markierten Variablen sind oben in "header.php" in "user_data.php" definiert









                                                              Fände es irgendwie cooler wenn da der Name stehen würde - Lori-->
    <div class="container höhe-postbox bg-white ">
        <div class="row">


            <div class="col-lg-3 user_details column py-2">
                <a href='img_upload/profile_pics/<?php echo $profile_pic; ?>'>
                    <img src='img_upload/profile_pics/<?php echo $profile_pic; ?>'></a>

                <div class="user_details_left_right">
                    <a href="profile.php?username=<?php echo $user_name; ?>">
                        <?php
                        echo $fname . " " . $lname;
                        ?>
                    </a>
                </div>
            </div>
            <form class=" col-lg-9 py-2 post_form" action="index.php" method="POST" enctype="multipart/form-data">

                    <textarea name="postbody" rows="8" cols="80"
                              placeholder="Schreibe hier um etwas zu posten.."></textarea>
                <input type="submit" name="post" value="Post">
                <br><br>
                <input type="file" name="file">

                <hr>

            </form>


        </div>
    </div>
    <!-- <div class="main_column column">

         <!-- Profil-Bild mit Infos -->
    <!--
        <div class="user_details column">
            <a href='img_upload/profile_pics/<?php echo $profile_pic; ?>'>
                <img src='img_upload/profile_pics/<?php echo $profile_pic; ?>'></a>

            <div class="user_details_left_right">
                <a href="profile.php?username=<?php echo $user_name; ?>">
                    <?php
    echo $fname . " " . $lname;
    ?>
                </a>
            </div>
        </div>                                         <!-- schließt das gesamte div des containers - Lori-->
    <!--

            <form class="post_form" action="index.php" method="POST" enctype="multipart/form-data">

                <textarea name="postbody" rows="8" cols="80" placeholder="Schreibe hier um etwas zu posten.."></textarea>
                <input type="submit" name="post" value="Post">
                <br><br>
                <input type="file" name="file">

                <hr>

            </form>


            <div class="posts_area"></div>
            <!-- <button id="load_more">Load More Posts</button> -->
    <!--
     <img id="loading" src="images/icons/loading.gif">
 </div>

-->


    <h1 class="title py-5"> Feed </h1>     <!-- Hier ein Synonym für Feed finden - Lori -->


    <?php

    //$userid = DB::query('SELECT id FROM list5 WHERE username=:username', array(':username'=>$_GET['username']))[0]['id'];


    // WARUM IST DAS AUSKOMMENTIERT? KANN DAS WEG? - LORI


    if (isset($_POST['post'])) {

        if (isset($_FILES['file']['name'])) {

            if (!($_FILES['file']['name'] == "")) {


                $file = $_FILES['file'];
                echo "Hey";
                echo $_FILES['file']['name'];

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

    // Text-Post-Funktion und Bild-Post-Funktion:
    if (isset($_POST['post'])) {
        if ($_FILES['file']['size'] == 0) { //wenn der Post kein Bild enthält bzw. keine Datei
            Post::createPost2($_POST['postbody'], $user_loggedin, $post_id);
        } else { // wenn der Post eine Bild-Datei enthält
            $postid = Post::createImgPost2($bild_id, $_POST['postbody'], $user_loggedin, $post_id);
        }
    }


    //Liking-Funktion:

    if (isset($_POST['like'])) {
        Post::likePost($_GET['postid'], $user_loggedin);

        //header('Location: index.php?postid=$_GET["postid"]');
    }

    if (isset($_POST['unlike'])) {
        Post::likePost($_GET['postid'], $user_loggedin);

        // header('Location: index.php?postid=$_GET["postid"]');
    }


    //Kommentar-Funktion:
    if (isset($_POST['comment'])) {
        Comment::createComment($_POST['commentbody'], $_GET['postid'], $user_loggedin);

        //header('Location: index.php?postid=."$post['id']"');

        //echo "<form action='index.php?postid=" . $post['id'] . "' method='post'>";
    }


    // Suchfunktion:
    if (isset($_POST['searchbox'])) {
        $tosearch = explode(" ", $_POST['searchbox']); //wir splittern es in einzelnen Leerfeldern (in Buchstaben) auf
        if (count($tosearch) == 1) { // wenn es ein Wort ist
            $tosearch = str_split($tosearch[0], 2); // z.B. "Robert" -> "Ro be rt"
        }
        $whereclause = "";
        $paramsarray = array(':username' => '%' . $_POST['searchbox'] . '%');
        for ($i = 0; $i < count($tosearch); $i++) {
            $whereclause .= " OR username LIKE :u$i ";
            $paramsarray[":u$i"] = $tosearch[$i];
        }

        $users = DB::query('SELECT list5.username FROM list5 WHERE list5.username LIKE :username ' . $whereclause . '', $paramsarray);
        print_r($users);

        $whereclause = "";
        $paramsarray = array(':body' => '%' . $_POST['searchbox'] . '%');
        for ($i = 0; $i < count($tosearch); $i++) {
            if ($i % 2) { // jedes zweite Wort
                $whereclause .= " OR body LIKE :p$i ";
                $paramsarray[":p$i"] = $tosearch[$i];
            }
        }
        $posts = DB::query('SELECT posts.body, list5.username, posts.posted_at FROM posts, list5 WHERE list5.id = posts.user_id AND posts.body LIKE :body ' . $whereclause . 'LIMIT 15', $paramsarray);
        echo json_encode($posts);

    }
    ?>







    <?php
    // Löschen von Kommentaren:                                          Warum Auskommentiert? - Lori
    /*if (isset($_POST['deletecomment'])) {
    if (DB::query('SELECT id FROM posts WHERE id=:postid AND user_id=:userid', array(':postid'=>$_GET['postid'], ':userid'=>$followerid))) {
    DB::query('DELETE FROM posts WHERE id=:postid and user_id=:userid', array(':postid'=>$_GET['postid'], ':userid'=>$followerid));
    DB::query('DELETE FROM post_likes WHERE post_id=:postid', array(':postid'=>$_GET['postid']));
    DB::query('DELETE FROM comments WHERE post_id=:postid', array(':postid'=>$_GET['postid']));
    echo 'Post gelöscht!';
    }
    }
    */ ?>





    <?php

    //Anzeigen des letzten Posts der eingeloggten Person --> Variablen sind in include('user_data.php'):

    if (!$img == "") { //wenn der Post ein Bild enthält, wird der Post mit dem Bild angezeigt:
        echo "<div class='container my-2 bg-white'>"; // container mit margin auf der y-Achse von 2 (Bootstrap angabe) und einem weisen hintergrung (kann geändert werden) - Lori
        echo "<img style='width: 75px; height: 75px; border-radius: 55px;' src='img_upload/profile_pics/$profile_pic'>  <a href='profile.php?username=" . $user_name . "'  > $user_name  </a> <img src='img_upload/post_pics/$img'>" . Post::link_add($body);

        echo "<form action='index.php?postid=" . $post_id . "' method='post'>";

        if (!DB::query('SELECT post_id FROM post_likes WHERE post_id=:postid AND user_id=:userid', array(':postid' => $post_id, ':userid' => $user_loggedin))) {
            /* damit überprüfen wir, ob der Post durch die eingeloggte Person schon geliked wurde
              wenn die eingeloggte Person den Post noch nicht geliked hat, wird dieses Formular angezeigt: */

            echo "<input type='submit' name='like' value='Like'>";
        } else { // wenn die eingeloggte Person den Post schon geliked hat, dann führ das aus:
            echo "<input type='submit' name='unlike' value='Unlike'>";
        }
        echo "<span>" . $post_likes . " likes</span>
              </form>

              <form action='index.php?postid=" . $post_id . " 'method='post'>
              <textarea name='commentbody' rows='3' cols='50'></textarea>
              <input type='submit' name='comment' value='Kommentieren'>
              </form>
              ";
// Wie kann ich folgendes Problem lösen: Wenn man etwas kommentiert, liked, postet wird die Seite neu geladen (und es bleibt nicht z.B. beim jeweiligen Kommentar, wo die Maus ist)
// header('Location: index.php?postid=".$post_id."');

        Comment::displayComments($post_id);
        echo "</div>";
    } else { // wenn der Post kein Bild enthält, wird das gleiche ausgeführt, aber ohne Platzhalter für "$img":
        echo "<div class='container m-2 bg-white'>";
        echo "<img style='width: 75px; height: 75px; border-radius: 55px; margin-left:10px;' src='img_upload/profile_pics/$profile_pic'>  <a href='profile.php?username=" . $user_name . " ' > $user_name  </a> " . Post::link_add($body);

        echo "<form action='index.php?postid=" . $post_id . "' method='post'>";

        if (!DB::query('SELECT post_id FROM post_likes WHERE post_id=:postid AND user_id=:userid', array(':postid' => $post_id, ':userid' => $user_loggedin))) {

            echo "<input type='submit' name='like' value='Like'>";
        } else {
            echo "<input type='submit' name='unlike' value='Unlike'>";
        }
        echo "<span>" . $post_likes . " likes</span>
              </form>



              <form action='index.php?postid=" . $post_id . " 'method='post'>
              <textarea name='commentbody' rows='3' cols='50'></textarea>
              <input type='submit' name='comment' value='Kommentieren'>
              </form>
              ";

        Comment::displayComments($post_id);

        echo "</div>";
    }


    // Anazeigen der Posts der anderen Benutzer mit den jeweiligen Kommentaren:
    $followingposts = DB::query('SELECT posts.id, posts.body, posts.likes, list5.username, posts.img_id, list5.profile_pic FROM list5, posts, followers
                             WHERE posts.user_id = followers.user_id
                             AND list5.id = posts.user_id
                             AND follower_id = :userid
                             ORDER BY posts.id DESC;', array(':userid' => $user_loggedin));

    /*
    joints -> WHERE posts.user_id = followers.user_id
    = zusammenfügen, wo die "id" der Person, deren Post angezeigt werden soll, mit der "id" der Person übereinstimmt, die von der eingeloggten Person gefolgt ist
    */

    foreach ($followingposts as $post) {

        $username = $post['username']; // Fetch von der Spalte "username" in unserer Datenbanktabelle

        if (!$post['img_id'] == "") { //wenn der Post ein Bild enthält, wird der Post mit dem Bild angezeigt:
            echo "<div class='container my-2 bg-white'>";
            echo "<img style='width: 75px; height: 75px; border-radius: 55px; margin-left:10px;' src='img_upload/profile_pics/" . $post['profile_pic'] . "'>" . ' ' . ' ' . "<a href='profile.php?username=" . $username . " ' >" . $post['username'] . '</a>' . ' ' . ' ' . Post::link_add($post['body']) . "<img src='img_upload/post_pics/" . $post['img_id'] . "'>";


            echo "<form action='index.php?postid=" . $post['id'] . "' method='post'>";

            if (!DB::query('SELECT post_id FROM post_likes WHERE post_id=:postid AND user_id=:userid', array(':postid' => $post['id'], ':userid' => $user_loggedin))) {
                /*damit überprüfen wir, ob der Post durch die eingeloggte Person schon geliked wurde
                  wenn die eingeloggte Person den Post noch nicht geliked hat, wird dieses Formular angezeigt: */

                echo "<input type='submit' name='like' value='Like'>";
            } else {
                echo "<input type='submit' name='unlike' value='Unlike'>";

            }
            echo "<span>" . $post['likes'] . " likes</span>
              </form>


              <form action='index.php?postid=" . $post['id'] . " 'method='post'>
              <textarea name='commentbody' rows='3' cols='50'></textarea>
              <input type='submit' name='comment' value='Kommentieren'>
              </form>
              ";
            Comment::displayComments($post['id']);

            echo "</div>";

        } else { // wenn der Post kein Bild enthält, wird das ausgeführt:
            echo "<div class='container my-5 bg-white'>";
            echo "<img style='width: 75px; height: 75px; border-radius: 55px; margin-left:10px;' src='img_upload/profile_pics/" . $post['profile_pic'] . "'>" . ' ' . ' ' . "<a href='profile.php?username=" . $username . " ' >" . $post['username'] . '</a>' . ' ' . ' ' . Post::link_add($post['body']);


            echo "<form action='index.php?postid=" . $post['id'] . "' method='post'>";

            if (!DB::query('SELECT post_id FROM post_likes WHERE post_id=:postid AND user_id=:userid', array(':postid' => $post['id'], ':userid' => $user_loggedin))) {

                echo "<input type='submit' name='like' value='Like'>";
            } else {
                echo "<input type='submit' name='unlike' value='Unlike'>";

            }
            echo "<span>" . $post['likes'] . " likes</span>
              </form>



              <form action='index.php?postid=" . $post['id'] . " 'method='post'>
              <textarea name='commentbody' rows='3' cols='50'></textarea>
              <input type='submit' name='comment' value='Kommentieren'>
              </form>
              ";

            Comment::displayComments($post['id']);

            echo "</div>";

        }
    }
    ?>

    <?php
    include('footer.php');
    ?>
</main>


