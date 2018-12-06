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
    <li><a class="active" href="index.php">Feed</a></li>
    <li><a href="profile.php">Profil </a></li>
    <li><a class="wi" href="messages.php">Messages</a></li>
    <li><a href="notify.php">Benachrichtigungen</a></li>
</ul>













<!--<div class="header"> <!-- kann auch einfach < header>   ..  < /header> sein -->-->
<!---->
<!--    <h2>.</h2>-->
<!--    <p>.</p>-->
<!--    <h2>.</h2>-->
<!--    <p>.</p>-->
<!--    <h2>.</h2>-->
<!--    <p>.</p>-->
<!---->
<!--</div>-->
<!---->
<!--<nav>-->
<!--    <ul>-->
<!--        <li><a class="active" href="index.php">Feed</a></li>-->
<!--        <li><a href="profile.php">Profil </a></li>-->
<!--        <li><a class="wi" href="my-messages.php">Nachrichten</a></li>-->
<!--        <li><a href="notify.php">Benachrichtigungen</a></li>-->
<!--    </ul>-->
<!--</nav>-->