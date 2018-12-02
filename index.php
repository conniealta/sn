<?php
session_start();
?>

<!DOCTYPE html> <!-- das ist HTML 5 -->
<html lang="de">
<head>
    <meta charset="utf-8">

    <link rel="stylesheet" type="text/css" href=" " media="screen"/>
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <title> Feed </title>

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


</div>


<ul>
    <li><a class="active" href="index.php">Feed</a></li>
    <li><a href="profile.php">Profil </a></li>
    <li><a class="wi" href="my-messages.php">Nachrichten</a></li>
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
    $user_loggedin = $_SESSION['angemeldet'];
    echo "Hallo User: ".$user_loggedin;
    $showTimeline = True;
}
?>























<?php

$profile_pic = DB::query('SELECT profile_pic FROM list5 WHERE id=:userid', array(':userid' => $user_loggedin))[0]['profile_pic'];
$lname = DB::query('SELECT last_name FROM list5 WHERE id=:userid', array(':userid' => $user_loggedin))[0]['last_name'];
$fname = DB::query('SELECT first_name FROM list5 WHERE id=:userid', array(':userid' => $user_loggedin))[0]['first_name'];
$user_name = DB::query('SELECT username FROM list5 WHERE id=:userid', array(':userid' => $user_loggedin))[0]['username'];

//echo "<a href='img_upload/profile_pics/$profile_pic'></a>      <img src='img_upload/profile_pics/$profile_pic'>"

/*
Das hier ist die längere Variante (ohne Klassen) und führt das gleiche aus:
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de;dbname=u-ka034', 'ka034', 'zeeD6athoo',array('charset'=>'utf8'));

$statement = $pdo->prepare("SELECT * FROM list5 WHERE id=:userid");

if($statement->execute(array(':userid'=>$user_loggedin))) {
    while ($user = $statement->fetchObject()) {
        $profile_pic = $user->profile_pic;
        $fname = $user->first_name;
        $lname = $user->last_name;
    }
}
echo "<a href='img_upload/profile_pics/$profile_pic'></a>      <img src='img_upload/profile_pics/$profile_pic'>"
*/

?>



<?php


?>


<h1> Das Profil von '<?php echo $user_name; ?>'</h1>



<div class="user_details column">

    <a href='img_upload/profile_pics/<?php echo $profile_pic;?>'>      <img src='img_upload/profile_pics/<?php echo $profile_pic;?>'></a>

    <div class="user_details_left_right">
        <a href="<?php echo $user_loggedin; ?>">
            <?php
            echo $fname . " " . $lname;

            ?>
        </a>
    </div>

</div>


<!--<br><br><br><br><br><br><br><br><br><br>-->
<!--<form action="upload_profile_pic.php" method="POST" enctype="multipart/form-data">-->
<!--    <input type="file" name="file">-->
<!--    <button type="submit" name="submit"> Upload Profile Pic </button>-->
<!---->
<!--</form>-->











<br><br><br><br><br><br><br><br><br><br>
<h1 class="title"> Feed  </h1>

<div class="main_column column">
    <form class="post_form" action="index.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="file">
        <textarea name="postbody" rows="8" cols="80" placeholder="Got something to say?"></textarea>
        <input type="submit" name="post" value="Post">
        <hr>

    </form>

    <div class="posts_area"></div>
    <!-- <button id="load_more">Load More Posts</button> -->
    <img id="loading" src="images/icons/loading.gif">
</div>


<?php
/*

Die Variante mit PDO:
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de;dbname=u-ka034', 'ka034', 'zeeD6athoo',array('charset'=>'utf8'));

$statement = $pdo->prepare("SELECT * FROM img_upload ");

if($statement->execute()) {
    while ($user = $statement->fetchObject()) {
        $img_id = $user->img_id;
    }
}

echo "<a href='img_upload/post_pics/$img_id'></a>      <img src='img_upload/post_pics/$img_id'>";




if (isset($_POST['submit'])) {
    if ($_FILES['file']['size'] == 0) {
        Post::createPost($_POST['postbody'], $user_loggedin, $userid);
       $posts= Post::displayPosts2 ($username, $user_loggedin);
    } else {
        $postid = Post::createImgPost($_POST['postbody'], $user_loggedin, $userid);
    }
}
*/?>


<!--<div class="posts">-->
<!--    --><?php //echo $posts; //$posts = Post::displayPosts2 ?>
<!--</div>-->
<!---->












<?php

$userid = DB::query('SELECT id FROM list5 WHERE username=:username', array(':username'=>$_GET['username']))[0]['id'];

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

//                Post::createImgPost($bild_id, $user_loggedin, $userid);

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
        Post::createPost2($_POST['postbody'], $user_loggedin);
    } else {
        $postid = Post::createImgPost2($bild_id, $user_loggedin); // Füg eine Variable "postbody" hinzu damit man auch Bilder mit Texte posten kann
    }
}

$profile_pic2 = DB::query('SELECT profile_pic FROM list5 WHERE id=:userid', array(':userid' => $user_loggedin))[0]['profile_pic'];
$my_posts = Post::displayPosts2 ($profile_pic2, $username, $user_loggedin);

// --> PROBLEM:  Die eigenen Posts werden im Feed nicht angezeigt (nur die Posts von den anderen Benutzern)















//Liking-Funktion:
if (isset($_GET['postid'])) {
    Post::likePost($_GET['postid'], $user_loggedin); //wir ändern '$followerid' zu '$user_loggedin', weil in dieser Datei die Variable einfach umbenannt wurde
}

//Kommentar-Funktion:
if (isset($_POST['comment'])) {
    Comment::createComment($_POST['commentbody'], $_GET['postid'], $user_loggedin); //wir ändern '$followerid' zu '$user_loggedin', weil in dieser Datei die Variable einfach umbenannt wurde
}



// Suchfunktion:
if(isset($_POST['searchbox'])) {
    $tosearch = explode(" ", $_POST['searchbox']); //wir splittern es in einzelnen Leerfeldern (in Buchstaben) auf
    if (count($tosearch) == 1) { // wenn es ein Wort ist
        $tosearch = str_split($tosearch[0], 2); // z.B. "Robert" -> "Ro be rt"
    }
    $whereclause = "";
    $paramsarray = array(':username'=>'%'.$_POST['searchbox'].'%');
    for ($i = 0; $i < count($tosearch); $i++) {
        $whereclause .= " OR username LIKE :u$i ";
        $paramsarray[":u$i"] = $tosearch[$i];
    }

    $users = DB::query('SELECT list5.username FROM list5 WHERE list5.username LIKE :username '.$whereclause.'', $paramsarray);
    print_r($users);

    $whereclause = "";
    $paramsarray = array(':body'=>'%'.$_POST['searchbox'].'%');
    for ($i = 0; $i < count($tosearch); $i++) {
        if ($i % 2) { // jedes zweite Wort
            $whereclause .= " OR body LIKE :p$i ";
            $paramsarray[":p$i"] = $tosearch[$i];
        }
    }
    $posts = DB::query('SELECT posts.body FROM posts WHERE posts.body LIKE :body '.$whereclause.'', $paramsarray);
    echo '<pre>';
    print_r($posts);
    echo '</pre>';

}


?>











<br><br><br>
<form action="index.php" method="post">
    <input type="text" name="searchbox" value="">
    <input type="submit" name="search" value="Suchen">
</form>
<br><br><br>


















<div class="posts">
    <?php echo $my_posts; ?>
</div>

<?php

// Anazeigen der Posts mit den Kommentaren:
$followingposts = DB::query('SELECT posts.id, posts.body, posts.likes, list5.username, posts.img_id, list5.profile_pic FROM list5, posts, followers
                             WHERE posts.user_id = followers.user_id
                             AND list5.id = posts.user_id
                             AND follower_id = :userid
                             ORDER BY posts.id DESC;', array(':userid'=>$user_loggedin));


foreach ($followingposts as $post) {

    echo "<img src='img_upload/profile_pics/".$post['profile_pic']."'>".$post['username'].$post['body'] ."<img src='img_upload/post_pics/".$post['img_id']."'>". "~ "; //profile_pic muss hier irgendwo sein
    echo "<form action='index.php?postid=" . $post['id'] . "' method='post'>";

    if (!DB::query('SELECT post_id FROM post_likes WHERE post_id=:postid AND user_id=:userid', array(':postid' => $post['id'], ':userid' => $user_loggedin))) {
        /*damit überprüfen wir, ob der Post durch die eingeloggte Person schon geliked wurde
          wenn die eingeloggte Person den Post noch nicht geliked hat, wird dieses Formular angezeigt: */

        echo "<input type='submit' name='like' value='Like'>";
    }else {
        echo "<input type='submit' name='unlike' value='Unlike'>";

    }
    echo "<span>" . $post['likes'] . " likes</span>
              </form>



              <form action='index.php?postid=".$post['id']." 'method='post'>
              <textarea name='commentbody' rows='3' cols='50'></textarea>
              <input type='submit' name='comment' value='Kommentieren'>
              </form>
              ";
    Comment::displayComments($post['id']);

    echo"

              <hr /></br />";


}

/* joints -> WHERE posts.user_id = followers.user_id
= zusammenfügen, wo die "id" der Person, deren Post angezeigt werden soll, mit der "id" der Person übereinstimmt, der von der eingeloggten Person gefolgt ist
*/

?>








</body>
</html>