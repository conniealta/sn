<?php
session_start();

//$user_id = "test"; //durch unsere Session ersetzen !!!!


$showTimeline = False;

if(!isset($_SESSION["angemeldet"]))
{
    echo"Bitte zuerst <a href=\"login.php\">einloggen</a>";
    die();
}
else {
    $user_id = $_SESSION['angemeldet'];
    echo "Hallo User: ".$user_id;
    $showTimeline = True;
}


if(isset($_POST['submit'])){
    $uploadOk = 1;
    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];


    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');


    if (in_array($fileActualExt, $allowed)){
        if($fileError === 0){
            if($fileSize< 1000000){
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = "img_upload/post_pics/".$fileNameNew;
                move_uploaded_file($fileTmpName,$fileDestination);
                $bild_id = $fileNameNew;

                $pdo = new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ka034', 'ka034', 'zeeD6athoo', array('charset' => 'utf8'));
                $sql = "INSERT INTO img_upload (user_id, img_id) VALUES (?, ?)";

                $statement = $pdo->prepare($sql);
                $statement->execute(array("$user_id", "$bild_id"));
                $uploadOk = 1;

            }else {
                echo"Deine Datei ist zu groß! (Max Größe 1MB)";
                $uploadOk = 0;
            }
        }else {
            echo"Leider gab es ein Problem! :(";
            $uploadOk = 0;
        }
    }else {
        echo"Dieses Dateiformat wird nicht unterstützt!";
        $uploadOk = 0;
    }


   /* if ($uploadOk) {
        Post::createImgPost($_POST['postbody'], $user_loggedin, $imageName); //--> $imageName fehlt in der Klasse?

        //$post = new Post($con, $userLoggedIn);
        // $post->submitPost($_POST['post_text'], 'none', $imageName);
    } else {
        echo "<div style='text-align:center;' class='alert alert-danger'>
    $errorMessage
</div>";
    }*/
}
?>





