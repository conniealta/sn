<?php
session_start();

//$user_id = "test"; //durch unsere Session ersetzen !!!!


$showTimeline = False;

if(!isset($_SESSION["angemeldet"]))
{
    echo"Bitte zuerst <a href=\"login.html\">einloggen</a>";
    die();
}
else {
    $user_id = $_SESSION['angemeldet'];
    echo "Hallo User: ".$user_id;
    $showTimeline = True;
}


include('db_pdo.php');

if(isset($_POST['submit'])){
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
                $fileDestination = "img_upload/profile_pics/".$fileNameNew;

                move_uploaded_file($fileTmpName,$fileDestination);
                $bild_id = $fileNameNew;

                $pdo=new PDO ($dsn, $dbuser, $dbpass, $options);
                $sql = "UPDATE list5 SET profile_pic='$bild_id' WHERE id='$user_id'";
                $statement = $pdo->prepare($sql);
                $statement->execute(array("$user_id", "$bild_id"));

            }else {
                echo"Deine Datei ist zu groß! (Max Größe 1MB)";
            }
        }else {
            echo"Fehler!";
        }
    }else {
        echo"Dieses Dateiformat wird nicht unterstützt!";
    }
}
