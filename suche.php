<?php
session_start();

include('header.php'); // in "header.php" ist auch "user_data.php" inkludiert und $_SESSION["angemeldet"];
include('Post.php');
include('Comment.php');
?>






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

   /* $users = DB::query('SELECT list5.username FROM list5 WHERE list5.username LIKE :username '.$whereclause.'', $paramsarray);
    $user_search = $users['username'];
    print_r($user_search);
    print_r($users);*/

   /*  So??
   foreach ($users as $user1) ...
   $user_search = $user1['username']
   */


    $pdo=new PDO ($dsn, $dbuser, $dbpass, $options);
    $statement = $pdo->prepare('SELECT list5.username, list5.profile_pic FROM list5 WHERE list5.username LIKE :username '.$whereclause.'');

    if($statement->execute($paramsarray )) {
        while ($user = $statement->fetchObject()) {
            $user_search= $user->username;
            $prof_pic = $user->profile_pic;
        }
    }
    print_r( "<img style='width: 75px; height: 75px; border-radius: 55px; margin-left:10px;' src='img_upload/profile_pics/" . $prof_pic . "'>". ' ' . ' ' . "<a href='profile.php?username=" . $user_search . " ' >" . $user_search . '</a>'  );


}

?>


<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

