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
    <h2>Scroll Down</h2>
    <p>Scroll down to see the sticky effect.</p>
    <h2>Scroll Down</h2>
    <p>Scroll down to see the sticky effect.</p>

</div>


<ul>


        <li>
            <?php
            session_start();
            include ('user_data.php');
            $user_loggedin = $_SESSION['angemeldet'];
            $username = DB::query('SELECT username FROM list5 WHERE id=:userid', array(':userid' => $user_loggedin))[0]['username'];
            echo "<a class='active' href='index.php?username=$username'>Feed</a>"
            ?>

        </li>

        <li>

            <?php
            echo "<a href='profile.php?username=$username'>Profil</a>"
            ?>
        </li>
        <li>
            <?php
            echo  "<a  href='my-messages.php?username=$username'>Messages</a>"
            ?>
        </li>

        <li class="dropdown">
            <?php
            echo "<a href='notify.php?username=$username'>Benachrichtigungen</a>"
            ?>
        </li>

    <li>
        <a href="logout.php">Log out!</a>
    </li>

    <br>
    <form  action="index.php" method="post">
        <input style="margin-left:190px;" type="text" name="searchbox" value="">
        <input type="submit" name="search" value="Suchen">
    </form>

    </ul>

