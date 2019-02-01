<?php
session_start();


$pageTitle = "Alcyone - Meine Nachrichten";


include('header.php');
?>






<?php
session_start();




if (isset($_GET['mid'])) {
    $message = DB::query('SELECT * FROM messages WHERE id=:mid AND (receiver=:receiver OR sender=:sender)', array(':mid'=>$_GET['mid'], ':receiver'=>$user_loggedin, ':sender'=>$user_loggedin))[0];

    echo '<h1>Nachrichten ansehen</h1>';
    echo  "<a  href='my-messages.php?username=$username'>Zurück</a> <br> <br>";

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
} else {

    ?>
<main class="container" style="padding-top: 100px;">
    <h1>Meine Nachrichten</h1>

 <div class="message-box">
    <?php
    include('Post.php');
    $messages = DB::query('SELECT messages.*, list5.username FROM messages, list5 WHERE (receiver=:receiver OR sender=:sender) AND list5.id = messages.sender ORDER BY messages.id DESC', array(':receiver'=>$user_loggedin, ':sender'=>$user_loggedin));


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


        if ($message['read'] == 0) { #hier wird festgestellt, ob die Nachricht bereits geöffnet wurde (1) oder nicht(0)
            echo "<a href='my-messages.php?mid=" . $message['id'] . "'><strong>" . $m . "</strong></a> wurde gesendet von <a href='profile.php?username=" . $message['username'] . "'>" . Post::link_add($message['username']) . "</a> <hr />";
        } else {
            echo "<a href='my-messages.php?mid=" . $message['id'] . "'>" . $m . "</a> wurde gesendet von <a href='profile.php?username=" . $message['username'] . "'>" . Post::link_add($message['username']) . "</a> <hr />";
        }


#mid = message id


    }


}
?>
 </div>


</main>

<?php
include('footer.php');
?>






