<?php
session_start();
?>

<!DOCTYPE html> <!-- das ist HTML 5 -->
<html lang="de">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css" media="screen"/>
    <title> Feed </title>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>



</head>

<body>


<header>
    <A ID="toc"></A>

    <nav>
        <div id="erste">

            <ul class="list1">

                <li>
                    <a  class="active" href="index.php">Feed</a>
                </li>

                <li>
                    <a href="profile.php">Profil </a>
                </li>
                <li>
                    <a class="wi" href="messages.html">Messages</a>
                </li>

                <li class="dropdown">
                    <a href="notify.php">Benachrichtigungen</a>

                </li>
            </ul>
        </div>
    </nav>
</header>

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


$username = DB::query('SELECT username FROM list5 WHERE username=:username', array(':username'=>$_GET['username']))[0]['username'];
?>



<h1> Das Profil von '<?php echo $user_loggedin; ?>'</h1>


<h1><?php echo $username; ?>'s Profile</h1>


<h1 class="title"> Feed  </h1>
<div id="zweite">
<form action="index.php" method="post">
    <textarea name="postbody" rows="8" cols="80"></textarea>
    <input type="submit" name="post" value="Post">
</form>
</div>



<?php

if (isset($_POST['post'])) { //prüfen, ob  der Post-Button geklickt wurde und wenn ja:

    Post::createPost2($_POST['postbody'], $user_loggedin);
    /*  in "Post.php" -> '$postbody', 'loggedIn_userid'

    --> die "$_POST['postbody'], $user_loggedin werden dann an die Parameter in "Post.php" übergeben
   --> Übertragung ($user_loggedin -> $loggedIn_userid etc.)
    */

    Post::displayPosts2 ($username, $user_loggedin);
}





if (isset($_GET['postid'])) {
    Post::likePost($_GET['postid'], $user_loggedin); //wir ändern '$followerid' zu '$user_loggedin', weil in dieser Datei die Variable einfach umbenannt wurde
}

if (isset($_POST['comment'])) {
    Comment::createComment($_POST['commentbody'], $_GET['postid'], $user_loggedin); //wir ändern '$followerid' zu '$user_loggedin', weil in dieser Datei die Variable einfach umbenannt wurde
}

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

<?php


$followingposts = DB::query('SELECT posts.id, posts.body, posts.likes, list5.username FROM list5, posts, followers 
                             WHERE posts.user_id = followers.user_id 
                             AND list5.id = posts.user_id 
                             AND follower_id = :userid
                             ORDER BY posts.likes DESC;', array(':userid'=>$user_loggedin));


foreach ($followingposts as $post) {

    echo $post['body'] . "~ " . $post['username'];
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
