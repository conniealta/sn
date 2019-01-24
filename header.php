<!DOCTYPE html> <!-- das ist HTML 5 -->
<html lang="de">
<head>
    <meta charset="utf-8">


    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
            integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
            integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
            crossorigin="anonymous"></script>
    <!-- Normalize.css  damit möglichst gleich in alle Browsern aussieht das noch includieren -->
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href=" " media="screen"/>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="js/register.js"></script>
    <!--=============================================================0



        <link rel="icon" type="image/png" href="/.......png"                                      HIER ÄNDERUNG DER GANZE BLOCK und die zeile hier drunter LORI 19.01>-->


    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes">


    <Title> Alcyone </Title>


    <style>                                                  /* Style der Navbar ist hier definiert! - Lori */

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
            background-color: #ffffff; /*Hintergrund hover nav bar war schwarz*/
        }

        .active {
            background-color: #69c6ec;
        }
    </style>

</head>

<body>
<nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light">
    <a class="navbar-brand" href="#">Alcyone</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>



<div class="header">
    <h2>Scroll Down</h2>
    <p>Scroll down to see the sticky effect.</p>
    <h2>Scroll Down</h2>
    <p>Scroll down to see the sticky effect.</p>
    <h2>Scroll Down</h2>
    <p>Scroll down to see the sticky effect.</p>

</div>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

<ul>

            <li class="nav-item active">
                <?php
                session_start();
                include('user_data.php');
                $user_loggedin = $_SESSION['angemeldet'];
                $username = DB::query('SELECT username FROM list5 WHERE id=:userid', array(':userid' => $user_loggedin))[0]['username'];
                echo "<a class='active' href='index.php?username=$username'>Home</a>"
                ?>
            </li>


            <li class="nav-item">
                <?php
                echo "<a href='profile.php?username=$username'>Profil</a>"
                ?>

            <li>
                <?php
                echo "<a  href='my-messages.php?username=$username'>Messages</a>"
                ?>

            </li>

            <!-- hier habe ich die Navbar alt integriert - warum kann ich hier die profilseite nitcht mit php integrieren?-->


            <li class="nav-item">
                <a class="nav-link " href="notify.php?username=$username">Benachrichtigungen</a>
            </li>

            <li>

            <li class="nav-item">
                <a class="nav-link" href="logout.php">Ausloggen</a>
            </li>

            </li>

            <!--                                                               Auskommentiert weil es mir komplett die Navbar verschiebt - Lori
            <li class="nav-item">
                <?php /*
                session_start();
                include('user_data.php');
                $user_loggedin = $_SESSION['angemeldet'];
                $username = DB::query('SELECT username FROM list5 WHERE id=:userid', array(':userid' => $user_loggedin))[0]['username'];
                echo "<a class='active' href='index.php?username=$username'>Feed</a>"*/
            ?>

                <a class="nav-link" href='profile.php?username=$username'>Mein Profil</a>
            </li>--->


            <!-- DAS IST DIE BOOTSTRAP SUCHLEISTE Icon anstelle von Search wäre cool - MUSS NOCH FORMULAR BEKOMMEN WIE ANDERE LEISTE UM AUCH DIE LEUTE ZU FINDEN CONNY FRAGEN - LORI-->
<!--
            <form action="suche.php" method="post">
                <input style="margin-left:190px;" type="text" name="searchbox" value="">
                <input type="submit" name="search" value="Suchen">
            </form>-->
        </ul>
           <!-- <form  action="suche.php" method="post" class="navbar-form navbar-left" role="search">
                <div class="form-group">
                    <input type="text" class="searchbox" placeholder="Search">
                </div>
                <button type="submit" class="btn bg-white" value="Suchen">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </form>-->
        <form action="suche.php" method="post" class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchbox" value="">
            <button class="btn btn-outline-primary my-2 my-sm-0" type="submit" name="Suchen" value="Suchen">Search</button>
        </form>
        <!--
        <form  action="suche.php" method="post">
            <input style="margin-left:190px;" type="text" name="searchbox" value="">
            <input type="submit" name="search" value="Suchen">
        </form>-->

<!-- Kommentar-->
    </div>

</nav>