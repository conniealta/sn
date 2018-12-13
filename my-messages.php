<?php
session_start();
?>

    <!DOCTYPE html> <!-- das ist HTML 5 -->
    <html lang="de">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css" media="screen"/>
        <title> Nachrichten </title>

        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>



    </head>

<body>


<?php
include('header.php');
?>

    <br><br><br><br>

    <a href="logout.php">Log out!</a>


<?php
session_start();


if(!isset($_SESSION["angemeldet"]))
{
    echo"Bitte zuerst <a href=\"login.html\">einloggen</a>";
    die();
}
else {
    $user_loggedin = $_SESSION['angemeldet'];
    echo "Hallo User: " . $user_loggedin;
}



if (isset($_GET['mid'])) {
    $message = DB::query('SELECT * FROM messages WHERE id=:mid AND receiver=:receiver OR sender=:sender', array(':mid'=>$_GET['mid'], ':receiver'=>$user_loggedin, ':sender'=>$user_loggedin))[0];
    echo '<h1>Nachrichten ansehen</h1>';
    echo htmlspecialchars($message['body']);
    echo '<hr />';
    if ($message['sender'] == $user_loggedin) {
        $id = $message['receiver'];
    } else {
        $id = $message['sender'];
    }

    DB::query('UPDATE messages SET `read`=1 WHERE id=:mid', array (':mid'=>$_GET['mid']));
    ?>
    <form action="messages.php?receiver=<?php echo $id; ?>" method="post">
        <textarea name="body" rows="8" cols="80"></textarea>
        <input type="submit" name="send" value="Send Message">
    </form>

<?php
}else{
    ?>

    <h1>Meine Nachrichten</h1>
    <?php
    include('Post.php');
    $messages = DB::query('SELECT messages.*, list5.username FROM messages, list5 WHERE (receiver=:receiver OR sender=:sender) AND list5.id = messages.sender', array(':receiver'=>$user_loggedin, ':sender'=>$user_loggedin));

    foreach ($messages as $message) {

        if ($message['sender'] == $user_loggedin) {
            $id = $message['receiver'];
        } else {
            $id = $message['sender'];
        }

        if (strlen($message['body']) > 20) {
            $m = substr($message['body'], 0, 20) . " ...";
        } else {
            $m = $message['body'];
        }

        if ($message['read'] == 0) {
            echo "<a href='my-messages.php?mid=" . $message['id'] . "'><strong>" . $m . "</strong></a> gesendet von " . $message['username'] . '<hr />';
        } else {
            echo "<a href='my-messages.php?mid=" . $message['id'] . "'>" . $m . "</a> gesendet von " . $message['username'] . '<hr />';
        }

    }



}
?>


<?php
include('footer.php');
?>

</body>
</html>

if ($message['read'] == 0) {

if ($message['username'] != $message['receiver']) {

echo "<a href='profile.php?username=" . $message['username'] . "'>" . Post::link_add($message['username'])."</a> hat dir eine Nachricht geschickt: <a href='my-messages.php?mid=" . $message['id'] . "'><strong>" . $m . "</strong></a> <hr />";

} else {
echo "Du hast <a href='profile.php?username=" . $message['username'] . "'>" . Post::link_add($message['username'])."</a> eine Nachricht geschickt: <a href='my-messages.php?mid=" . $message['id'] . "'>" . $m . "</a> <hr />";

}
} else if ($message['username'] == $message['receiver']) {

echo "<a href='profile.php?username=" . $message['username'] . "'>" . Post::link_add($message['username'])."</a> hat dir eine Nachricht geschickt: <a href='my-messages.php?mid=" . $message['id'] . "'>" . $m . "</a> <hr />";

} else {
echo "Du hast <a href='profile.php?username=" . $message['username'] . "'>" . Post::link_add($message['username'])."</a> eine Nachricht geschickt: <a href='my-messages.php?mid=" . $message['id'] . "'><strong>" . $m . "</strong></a> <hr />";

#mid = message id
}

if($message['read'] == 0){
echo "<strong>" . $m . "</strong><hr />";

}else{
echo  $m . "<hr />";
}


if ($message['read'] == 0) {

if ($message['username'] != $message['receiver']) {

echo "<a href='profile.php?username=" . $message['username'] . "'>" . Post::link_add($message['username'])."</a> hat dir eine Nachricht geschickt: <a href='my-messages.php?mid=" . $message['id'] . "'><strong>" . $m . "</strong></a> <hr />";

} else {
echo "Du hast <a href='profile.php?username=" . $message['username'] . "'>" . Post::link_add($message['username'])."</a> eine Nachricht geschickt: <a href='my-messages.php?mid=" . $message['id'] . "'>" . $m . "</a> <hr />";

}
} else if ($message['username'] == $message['receiver']) {

echo "<a href='profile.php?username=" . $message['username'] . "'>" . Post::link_add($message['username'])."</a> hat dir eine Nachricht geschickt: <a href='my-messages.php?mid=" . $message['id'] . "'>" . $m . "</a> <hr />";

} else {
echo "Du hast <a href='profile.php?username=" . $message['username'] . "'>" . Post::link_add($message['username'])."</a> eine Nachricht geschickt: <a href='my-messages.php?mid=" . $message['id'] . "'><strong>" . $m . "</strong></a> <hr />";

#mid = message id
}

if($message['read'] == 0){
echo "<strong>" . $m . "</strong><hr />";

}else{
echo  $m . "<hr />";
}

