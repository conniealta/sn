<?php
session_start();
?>

<!DOCTYPE html> <!-- das ist HTML 5 -->
<html lang="de">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css" media="screen"/>
    <title> Nachrichten </title>

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
                    <a class="wi" href="my-messages.php">Messages</a>
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
        echo "Message Sent!";
    } else {
        die('Invalid ID!');
    }
}
?>
