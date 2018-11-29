

<?php
session_start();
?>

<!DOCTYPE html> <!-- das ist HTML 5 -->
<html lang="de">
<head>
    <meta charset="utf-8">

    <link rel="stylesheet" type="text/css" href=" " media="screen"/>
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <!-- Javascript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootbox.min.js"></script>
    <script src="js/demo.js"></script>
    <script src="js/jquery.Jcrop.js"></script>
    <script src="js/jcrop_bits.js"></script>


    <!-- CSS -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="css/jquery.Jcrop.css" type="text/css" />

    <title> Feed </title>


</head>

<body>


<div class="top_bar">

    <div class="logo">
        <a href="index.php">Swirlfeed!</a>
    </div>


    <div class="search">

        <form action="search.php" method="GET" name="search_form">
            <input type="text" onkeyup="getLiveSearchUsers(this.value, '<?php echo $userLoggedIn; ?>')" name="q" placeholder="Search..." autocomplete="off" id="search_text_input">

            <div class="button_holder">
                <img src="assets/images/icons/magnifying_glass.png">
            </div>

        </form>

        <div class="search_results">
        </div>

        <div class="search_results_footer_empty">
        </div>



    </div>



    <a href="<?php echo $userLoggedIn; ?>">
        <?php echo $user['first_name']; ?>
    </a>
    <a href="index.php">
        <i class="fa fa-home fa-lg"></i>
    </a>
    <a href="javascript:void(0);" onclick="getDropdownData('<?php echo $userLoggedIn; ?>', 'message')">
        <i class="fa fa-envelope fa-lg"></i>
        <?php
        if($num_messages > 0)
            echo '<span class="notification_badge" id="unread_message">' . $num_messages . '</span>';
        ?>
    </a>
    <a href="javascript:void(0);" onclick="getDropdownData('<?php echo $userLoggedIn; ?>', 'notification')">
        <i class="fa fa-bell fa-lg"></i>
        <?php
        if($num_notifications > 0)
            echo '<span class="notification_badge" id="unread_notification">' . $num_notifications . '</span>';
        ?>
    </a>
    <a href="requests.php">
        <i class="fa fa-users fa-lg"></i>
        <?php
        if($num_requests > 0)
            echo '<span class="notification_badge" id="unread_requests">' . $num_requests . '</span>';
        ?>
    </a>
    <a href="settings.php">
        <i class="fa fa-cog fa-lg"></i>
    </a>
    <a href="includes/handlers/logout.php">
        <i class="fa fa-sign-out fa-lg"></i>
    </a>

    </nav>

    <div class="dropdown_data_window" style="height:0px; border:none;"></div>
    <input type="hidden" id="dropdown_data_type" value="">


</div>


<script>
    var userLoggedIn = '<?php echo $userLoggedIn; ?>';

    $(document).ready(function() {

        $('.dropdown_data_window').scroll(function() {
            var inner_height = $('.dropdown_data_window').innerHeight(); //Div containing data
            var scroll_top = $('.dropdown_data_window').scrollTop();
            var page = $('.dropdown_data_window').find('.nextPageDropdownData').val();
            var noMoreData = $('.dropdown_data_window').find('.noMoreDropdownData').val();

            if ((scroll_top + inner_height >= $('.dropdown_data_window')[0].scrollHeight) && noMoreData == 'false') {

                var pageName; //Holds name of page to send ajax request to
                var type = $('#dropdown_data_type').val();


                if(type == 'notification')
                    pageName = "ajax_load_notifications.php";
                else if(type == 'message')
                    pageName = "ajax_load_messages.php"


                var ajaxReq = $.ajax({
                    url: "includes/handlers/" + pageName,
                    type: "POST",
                    data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
                    cache:false,

                    success: function(response) {
                        $('.dropdown_data_window').find('.nextPageDropdownData').remove(); //Removes current .nextpage
                        $('.dropdown_data_window').find('.noMoreDropdownData').remove(); //Removes current .nextpage


                        $('.dropdown_data_window').append(response);
                    }
                });

            } //End if

            return false;

        }); //End (window).scroll(function())


    });

</script>


<div class="wrapper">




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
