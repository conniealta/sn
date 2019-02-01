
<html>
<head>
    <title>Willkommen bei Alcyone!</title>
    <link rel="stylesheet" type="text/css" href="css/register_style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="js/register.js"></script>
</head>
<body>

<?php

$pageTitle = "Alcyone - Login";



if(isset($_POST['register_button'])) {
    echo '
		<script>

		$(document).ready(function() {
			$("#first").hide();
			$("#second").show();
		});

		</script>

		';
}


?>


<div class="wrapper">

    <div class="login_box">

        <div class="login_header">
            <h1>Alycone!</h1>
            Login or sign up below!
        </div>
        <br>
        <div id="first">

            <form action="do_login.php" method="POST">
                <input type="email" name="email" placeholder="Email">
                <br>
                <input type="password" name="passwort" placeholder="Passwort">
                <br>
                <div class="contact100-form-checkbox m-l-4">
                    <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                    <label class="label-checkbox100" for="ckb1">
                        Remember me
                    </label>
                </div>
                <input type="submit" name="login_button" value="Login">
                <br>
                <a href="#" id="signup" class="signup">Need an account? Register here!</a>

            </form>

        </div>



        <div id="second">

            <form action="do_register.php" method="POST">

                <p>Vorname:</p>
                <input type="text" size="40" maxlength="250" name="fname" placeholder="Vorname eingeben"><br><br>

                <p>Nachname:</p>
                <input type="text" size="40" maxlength="250" name="lname" placeholder="Nachname eingeben"><br><br>

                <p>Username:</p>
                <input type="text" size="40" maxlength="250" name="username" placeholder="Username eingeben"><br><br>

                <p>Email:</p>
                <input type="email" size="40" maxlength="250" name="email" placeholder="E-Mail eingeben"><br><br>

                <p>Passwort:</p>
                <input type="password" size="40"  maxlength="250" name="passwort" placeholder="••••••"><br>

                <p>Passwort bestätigen:</p>
                <input type="password" name="passwort2" placeholder="••••••"><br><br>

                <input type="submit" value="Registrieren">

                <br><br><br>
                <a>Schon registriert?</a>
                <a href="#" id="signin" class="signin"  >Jetzt einloggen</a>

            </form>
        </div>

    </div>

</div>

</body>
</html>
