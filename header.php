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
    <script src="js/register.js"></script>


    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes">


    <Title><?php echo $pageTitle; ?> - Alcyone</Title>


</head>

<body>

<nav class="navbar navbar-expand-lg pos-fixed navbar-light bg-light" style="min-width: 100%">
    <a class="navbar-brand" href="index.php">Alcyone</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto header header_search">
                <li class="nav-item <?php if (strpos($_SERVER['REQUEST_URI'], "index") !== false){ echo "active";} ?>">
                    <?php
                    session_start();
                    include('user_data.php');
                    $user_loggedin = $_SESSION['angemeldet'];
                    $username = DB::query('SELECT username FROM list5 WHERE id=:userid', array(':userid' => $user_loggedin))[0]['username'];
                    echo "<a class=\"nav-link\" href='index.php?username=$username'>Home</a>"
                    ?>
                </li>


                <li class="nav-item <?php if (strpos($_SERVER['REQUEST_URI'], "profil") !== false){ echo "active";} ?>">
                    <?php
                    echo "<a  class=\"nav-link\" href='profile.php?username=$username'>Profil</a>"
                    ?>
                </li>
                <li class="nav-item <?php if (strpos($_SERVER['REQUEST_URI'], "messages") !== false){ echo "active";} ?>">
                    <?php
                    echo "<a class=\"nav-link\" href='my-messages.php?username=$username'>Messages</a>"
                    ?>

                </li>

                <li class="nav-item <?php if (strpos($_SERVER['REQUEST_URI'], "notify") !== false){ echo "active";} ?>">
                    <a class="nav-link" href="notify.php?username=$username">Benachrichtigungen</a>
                </li>

                <li>

                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Ausloggen</a>
                </li>
            <form action="suche.php" method="post" class="form-inline my-2  mt-2">
                <input class="form-control width-100 mr-sm-2" type="search" placeholder="Suchen nach.." aria-label="Suchen"
                       name="searchbox" value="">
                <button class="btn btn-outline-primary my-2 my-sm-0 width-100" type="submit" name="Suchen" value="Suchen">Suchen
                </button>
            </form>
            </ul>
    </div>

</nav>