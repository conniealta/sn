<?php
session_start();
?>




<?php

include('header.php');



if(!isset($_SESSION["angemeldet"]))
{
    echo"Bitte zuerst <a href=\"login.html\">einloggen</a>";
    die();
}
else {
    $user_loggedin = $_SESSION['angemeldet'];
    echo "Hallo User: ".$user_loggedin;

}
?>

<h1>Send a Message</h1>
<form action="messages.php?receiver=<?php echo htmlspecialchars($_GET['receiver']); ?>" method="post">
    <textarea name="body" rows="8" cols="80"></textarea>
    <input type="submit" name="send" value="Send Message">
</form>

<?php
if (isset($_POST['send'])) {
    if (DB::query('SELECT id FROM list5 WHERE id=:receiver', array(':receiver'=>$_GET['receiver']))) {
        DB::query("INSERT INTO messages VALUES ('', :body, :sender, :receiver, 0)", array(':body'=>$_POST['body'], ':sender'=>$user_loggedin, ':receiver'=>htmlspecialchars($_GET['receiver'])));
        echo "Nachricht gesendet!";
    } else {
        die('Ungültige Id!');
    }
}
?>