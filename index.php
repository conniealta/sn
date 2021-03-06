<?php
session_start();
$pageTitle = "Startseite";
include('header.php'); // in "header.php" ist auch "user_data.php" inkludiert und $_SESSION["angemeldet"];
include('Post.php');
include('Comment.php');
?>


    <main class="container" style="padding-top: 70px">
        <!--mit container mittig gesetzt - mit container fluid ist es auf komplette bildbreite verteilt-->
        <h1 class="py-4"> Hallo <a style="font-size: 40px;" href="profile.php?username=<?php echo $username; ?>">
                <?php
                echo $username;
                ?>
            </a>!</h1>


        <div class="container bgwhite">
            <div class="row">

                <div class="col-lg-3 profile_pic">
                    <a href='img_upload/profile_pics/<?php echo $profile_pic; ?>'>
                        <img src='img_upload/profile_pics/<?php echo $profile_pic; ?>'></a>

                    <div class="user_details_left_right" style="text-align: center">
                        <a href="profile.php?username=<?php echo $user_name; ?>">
                            <?php
                            echo $fname . " " . $lname;
                            ?>
                        </a>
                    </div>
                </div>

                <div class="col-lg-9 bgwhite post_form" style="padding-left: 50px;">
                    <h2 style="margin-top: 30px; margin-bottom: 30px;">Was möchtest du mitteilen?</h2>
                    <form action="index.php" method="POST" enctype="multipart/form-data">

                    <textarea name="postbody" class="form-control" rows="1" cols="80"
                              placeholder="Schreibe hier um etwas zu posten.."></textarea>


                        <input style="padding-left:20px; margin-right: 100px; font-size: 16px;" type="file" name="file">
                        <input type="submit" name="post" value="Post">

                        <hr>

                    </form>

                </div>
            </div>
        </div>

        <!-- <h1 class="title py-5"> Home </h1>-->

        <div class="post-content-box home">

            <?php
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
                                echo "Upload fehlgeschlagen";
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
            }

            if (isset($_POST['unlike'])) {
                Post::likePost($_GET['postid'], $user_loggedin);
            }

            //Kommentar-Funktion:
            if (isset($_POST['comment'])) {
                Comment::createComment($_POST['commentbody'], $_GET['postid'], $user_loggedin);
            }

            ?>


            <?php
            //Anzeigen des letzten Posts der eingeloggten Person --> Variablen sind in include('user_data.php'):
            if (!$img == "") { //wenn der Post ein Bild enthält, wird der Post mit dem Bild angezeigt:
                echo "<div class='container my-2 bg-white'>"; // container mit margin auf der y-Achse von 2 (Bootstrap angabe) und einem weisen hintergrung (kann geändert werden) - Lori
                echo "<div class='row'>";
                echo "<div class='col-lg-3'>";
                echo "<img style='width: 75px; height: 75px; border-radius: 55px;' src='img_upload/profile_pics/$profile_pic'><a style='font-size:20px; padding-left: 20px;' href='profile.php?username=" . $user_name . "'  > $user_name  </a>";
                echo "</div>";
                echo "<div class='col-lg-9 bgwhite post_body'>";
                echo "<img src='img_upload/post_pics/$img'>";
                echo "<span style='font-size: 30px;'>".Post::link_add($post['body'])."</span>";

                echo "<form action='index.php?postid=" . $post_id . "' method='post'>";


                if (!DB::query('SELECT post_id FROM post_likes WHERE post_id=:postid AND user_id=:userid', array(':postid' => $post_id, ':userid' => $user_loggedin))) {
                    /* damit überprüfen wir, ob der Post durch die eingeloggte Person schon geliked wurde
                      wenn die eingeloggte Person den Post noch nicht geliked hat, wird dieses Formular angezeigt: */
                    echo "<input type='submit' name='like' value='Like' class='like-button'>";
                } else { // wenn die eingeloggte Person den Post schon geliked hat, dann führ das aus:
                    echo "<input type='submit' name='unlike' value='Unlike' class='like-button'>";
                }

                echo "<span style='font-size: 14px;'>" . $post_likes . " likes</span>
              </form>
              <form action='index.php?postid=" . $post_id . " 'method='post' class='comment_form'>
              <textarea name='commentbody' class='form-control' rows='2' cols='50'></textarea>
              <input type='submit' name='comment' value='Kommentieren'>
              </form>
              ";

                Comment::displayComments($post_id);
                echo "</div></div></div><!-- Ende Container -->";
            } else { // wenn der Post kein Bild enthält, wird das gleiche ausgeführt, aber ohne Platzhalter für "$img":
                echo "<div class='container mt-4 bg-white'>";
                echo "<div class='row'>";
                echo "<div class='col-lg-3'>";
                echo "<img style='width: 75px; height: 75px; border-radius: 55px; margin-left:10px;' src='img_upload/profile_pics/$profile_pic'>  <a style='font-size:20px; padding-left: 20px;' href='profile.php?username=" . $user_name . " ' > $user_name  </a> "/*. Post::link_add($body)*/;
                echo "</div>";
                echo "<div class='col-lg-9 bgwhite post_body'>";
                echo "<img src='img_upload/post_pics/$img'>";
                echo "<span style='font-size: 30px;'>".Post::link_add($post['body'])."</span>";

                echo "<form action='index.php?postid=" . $post_id . "' method='post'>";

                if (!DB::query('SELECT post_id FROM post_likes WHERE post_id=:postid AND user_id=:userid', array(':postid' => $post_id, ':userid' => $user_loggedin))) {
                    echo "<input type='submit' name='like' value='Like' class='like-button'>";
                } else {
                    echo "<input type='submit' name='unlike' value='Unlike' class='like-button'>";
                }

                echo "<span style='font-size: 14px;'>" . $post_likes . " likes</span>
             
              </form>
              <form action='index.php?postid=" . $post_id . " 'method='post' class='comment_form'>
              <textarea name='commentbody' class='form-control' rows='2' cols='50'></textarea>
              <input type='submit' name='comment' value='Kommentieren'>
              </form>
              ";

                Comment::displayComments($post_id);
                echo "</div></div></div>";
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
                    echo "<div class='row'>";
                    echo "<div class='col-lg-3'>";
                    echo "<img style='width: 75px; height: 75px; border-radius: 55px; margin-left:10px;' src='img_upload/profile_pics/" . $post['profile_pic'] . "'>" . ' ' . ' ' . "<a style='font-size:20px; padding-left: 20px;'href='profile.php?username=" . $username . " ' >" . $post['username'] . '</a>';
                    echo "</div>";
                    echo "<div class='col-lg-9 bgwhite post_body'>";
                    echo "<img src='img_upload/post_pics/" . $post['img_id'] . "'>";
                    echo "<span style='font-size: 30px;'>".Post::link_add($post['body'])."</span>";
                    echo "<form action='index.php?postid=" . $post['id'] . "' method='post'>";

                    if (!DB::query('SELECT post_id FROM post_likes WHERE post_id=:postid AND user_id=:userid', array(':postid' => $post['id'], ':userid' => $user_loggedin))) {
                        /*damit überprüfen wir, ob der Post durch die eingeloggte Person schon geliked wurde
                          wenn die eingeloggte Person den Post noch nicht geliked hat, wird dieses Formular angezeigt: */
                        echo "<input type='submit' name='like' value='Like' class='like-button'>";
                    } else {
                        echo "<input type='submit' name='unlike' value='Unlike' class='like-button'>";
                    }

                    echo "<span style='font-size: 14px;'>" . $post['likes'] . " likes</span>
             
              </form>
              <form action='index.php?postid=" . $post['id'] . " 'method='post' class='comment_form'>
              <textarea name='commentbody' class='form-control' rows='2' cols='50'></textarea>
              <input type='submit' name='comment' value='Kommentieren'>
              </form>
              ";
                    Comment::displayComments($post['id']);
                    echo "</div></div></div>";
                } else { // wenn der Post kein Bild enthält, wird das ausgeführt:
                    echo "<div class='container my-5 bg-white'>";
                    echo "<div class='row'>";
                    echo "<div class='col-lg-3'>";
                    echo "<img style='width: 75px; height: 75px; border-radius: 55px; margin-left:10px;' src='img_upload/profile_pics/" . $post['profile_pic'] . "'>" . ' ' . ' ' . "<a style='font-size:20px; padding-left: 20px;' href='profile.php?username=" . $username . " ' >" . $post['username'] . '</a>';
                    echo "</div>";
                    echo "<div class='col-lg-9 bgwhite post_body'>";
                    echo "<span style='font-size: 30px;'>".Post::link_add($post['body'])."</span>";
                    echo "<form action='index.php?postid=" . $post['id'] . "' method='post'>";

                    if (!DB::query('SELECT post_id FROM post_likes WHERE post_id=:postid AND user_id=:userid', array(':postid' => $post['id'], ':userid' => $user_loggedin))) {
                        echo "<input type='submit' name='like' value='Like' class='like-button'>";
                    } else {
                        echo "<input type='submit' name='unlike' value='Unlike' class='like-button'>";
                    }

                    echo "<span style='font-size: 14px;'>" . $post['likes'] . " likes</span>
             
              </form>
              <form action='index.php?postid=" . $post['id'] . " 'method='post' class='comment_form'>
              <textarea name='commentbody' class='form-control' rows='2' cols='50'></textarea>
              <input type='submit' name='comment' value='Kommentieren'>
              </form>
              ";

                    Comment::displayComments($post['id']);
                    echo "</div></div></div>";
                }
            }
            ?>
        </div>

    </main>

<?php
include('footer.php');
?>