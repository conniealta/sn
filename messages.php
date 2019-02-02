<?php
session_start();
?>




<?php


$pageTitle = "Schreibe eine Nachricht";

include('header.php');


if(!isset($_SESSION["angemeldet"]))
{
    echo"<a href=\"login.php\">einloggen</a>";
    die();
}
else {
    $user_loggedin = $_SESSION['angemeldet'];
    echo "Hallo User: ".$user_loggedin;

}
?>





<main class="container" style="padding-top: 70px;">

    <h1>Sende eine Nachricht</h1>

<div class="send-message-box">
<form action="messages.php?receiver=<?php echo htmlspecialchars($_GET['receiver']); ?>" method="post">
    <textarea name="body" rows="8" cols="80"></textarea>
    <input type="submit" name="send" value="Sende eine Nachricht">
</form>
</div>


<div class="message-sent-box">
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
</div>

    <?php
    include('footer.php');
    ?>
</main>

