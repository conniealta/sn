<?php
session_start();

include('header.php'); // in "header.php" ist auch "user_data.php" inkludiert und $_SESSION["angemeldet"];
include('Post.php');
include('Comment.php');
?>

<br><br><br><br>


<h1> Hey, <?php echo $user_name; ?></h1> <!-- die markierten Variablen sind oben in "header.php" in "user_data.php" definiert-->


<div class="main_column column">

    <!-- Profil-Bild mit Infos -->
    <div class="user_details column">
        <a href='img_upload/profile_pics/<?php echo $profile_pic;?>'>      <img src='img_upload/profile_pics/<?php echo $profile_pic;?>'></a>

        <div class="user_details_left_right">
            <a href="profile.php?username=<?php echo $user_name; ?>" >
                <?php
                echo $fname . " " . $lname;
                ?>
            </a>
        </div>
    </div>
</div>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<h1 class="title"> Suche  </h1>



<?php

//$userid = DB::query('SELECT id FROM list5 WHERE username=:username', array(':username'=>$_GET['username']))[0]['id'];


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
    $user_search = $users['username'];
    print_r($user_search);

    $whereclause = "";
    $paramsarray = array(':body'=>'%'.$_POST['searchbox'].'%');
    for ($i = 0; $i < count($tosearch); $i++) {
        if ($i % 2) { // jedes zweite Wort
            $whereclause .= " OR body LIKE :p$i ";
            $paramsarray[":p$i"] = $tosearch[$i];
        }
    }
    $posts = DB::query('SELECT posts.body, list5.username, posts.posted_at FROM posts, list5 WHERE list5.id = posts.user_id AND posts.body LIKE :body '.$whereclause.'LIMIT 15', $paramsarray);
    echo json_encode($posts);

}
?>


