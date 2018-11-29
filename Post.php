<?php
include('Notifyclass.php');
class Post {

    public static function createPost($postbody, $loggedIn_userid, $profileUserId) {


        if (strlen($postbody) > 1000 || strlen($postbody) < 1) {
            die('Inkorrekte Länge!');
        }

        if ($loggedIn_userid == $profileUserId) {
            //wenn die eingeloggte Person auf ihrer eigenen Profilseite ist, dann darf sie Einträge posten


            if(count(Notify::createNotify($postbody)) !=0){
                foreach(Notify::createNotify($postbody) as $key => $n ) {
                    $s = $loggedIn_userid;
                    #s ist der eingeloggte User

                    $r = DB::query('SELECT id FROM list5 WHERE username=:username', array(':username' => $key))[0]['id'];
                    #r ist der User der markiert wird oder dessen Post geliked wird

                    if ($r != 0) {
                        #solange der User existiert, wird eine Benachrichtigung gesendet
                        DB::query('INSERT INTO notifications VALUES (\'\', :type, :reciever, :sender, :extra)', array(':type' => $n["type"], ':reciever' => $r, ':sender' => $s, ':extra'=> $n["extra"] ));
                    }
                }

            }



            DB::query('INSERT INTO posts VALUES (\'\', :postbody, \'\', NOW(), :userid, 0)', array(':postbody' => $postbody, ':userid' => $profileUserId));
        } // -> '\'= die erste Spalte in der Datenbanktabelle ("id"); NOW() = das ist eine Funktion, die das aktuelle Datum und Uhrzeit anzeigt; '0'= die Standardanzahl der "Likes"
        else {
            die('Falscher Benutzer!');
        }

    }


    public static function createPost2 ($postbody, $loggedIn_userid) {


        if (strlen($postbody) > 1000 || strlen($postbody) < 1) {
            die('Inkorrekte Länge!');
        }

        if ($loggedIn_userid) {
            if (count(Notify::createNotify($postbody)) != 0) {
                foreach (Notify::createNotify($postbody) as $key => $n) {
                    $s = $loggedIn_userid;
                    #s ist der eingeloggte User

                    $r = DB::query('SELECT id FROM list5 WHERE username=:username', array(':username' => $key))[0]['id'];
                    #r ist der User der markiert wird oder dessen Post geliked wird

                    if ($r != 0) {
                        #solange der User existiert, wird eine Benachrichtigung gesendet
                        DB::query('INSERT INTO notifications VALUES (\'\', :type, :reciever, :sender, :extra)', array(':type' => $n["type"], ':reciever' => $r, ':sender' => $s, ':extra' => $n["extra"]));
                    }
                }

            }

            DB::query('INSERT INTO posts VALUES (\'\', :postbody, \'\', NOW(), :userid, 0)', array(':postbody' => $postbody, ':userid' => $loggedIn_userid));
        } // -> '\'= die erste Spalte in der Datenbanktabelle ("id"); NOW() = das ist eine Funktion, die das aktuelle Datum und Uhrzeit anzeigt; '0'= die Standardanzahl der "Likes"
        else {
            die('Falscher Benutzer!');
        }

    }


    public static function createImgPost($img_id, $loggedIn_userid, $profileUserId) {

        if ($loggedIn_userid == $profileUserId) {
            if (count(Notify::createNotify($img_id)) != 0) {
                foreach (Notify::createNotify($img_id) as $key => $n) {
                    $s = $loggedIn_userid;
                    $r = DB::query('SELECT id FROM list5 WHERE username=:username', array(':username'=>$key))[0]['id'];
                    if ($r != 0) {
                        DB::query('INSERT INTO notifications VALUES (\'\', :type, :receiver, :sender, :extra)', array(':type'=>$n["type"], ':receiver'=>$r, ':sender'=>$s, ':extra'=>$n["extra"]));
                    }
                }
            }
            DB::query('INSERT INTO posts VALUES (\'\',\'\', :img_id, NOW(), :userid, 0)', array(':img_id'=>$img_id, ':userid'=>$profileUserId));
            $postid = DB::query('SELECT id FROM posts WHERE user_id=:userid ORDER BY ID DESC LIMIT 1;', array(':userid'=>$loggedIn_userid))[0]['id'];
            return $postid;
        } else {
            die('Incorrect user!');
        }
    }
    #funktion für bilder



    public static function createImgPost2 ($img_id, $loggedIn_userid) {

        if ($loggedIn_userid) {
            if (count(Notify::createNotify($img_id)) != 0) {
                foreach (Notify::createNotify($img_id) as $key => $n) {
                    $s = $loggedIn_userid;
                    $r = DB::query('SELECT id FROM list5 WHERE username=:username', array(':username'=>$key))[0]['id'];
                    if ($r != 0) {
                        DB::query('INSERT INTO notifications VALUES (\'\', :type, :receiver, :sender, :extra)', array(':type'=>$n["type"], ':receiver'=>$r, ':sender'=>$s, ':extra'=>$n["extra"]));
                    }
                }
            }
            DB::query('INSERT INTO posts VALUES (\'\',\'\', :img_id, NOW(), :userid, 0)', array(':img_id'=>$img_id, ':userid'=>$loggedIn_userid));
            $postid = DB::query('SELECT id FROM posts WHERE user_id=:userid ORDER BY ID DESC LIMIT 1;', array(':userid'=>$loggedIn_userid))[0]['id'];
            return $postid;
        } else {
            die('Incorrect user!');
        }
    }
    #funktion für bilder









    public static function likePost($postid, $likerId) {

        if (!DB::query('SELECT user_id FROM post_likes WHERE post_id=:postid AND user_id=:userid', array(':postid'=>$postid, ':userid'=>$likerId))) {
            //wenn folgendes nicht der Fall ist: der Benutzer hat den Post bereits geliked, dann wird der Code ausgeführt:
            DB::query('UPDATE posts SET likes=likes+1 WHERE id=:postid', array(':postid' => $postid));
            //wo die Post-"id" in der Datenbank gleich die ":postid" ist, die dem URL übergeben wird, wenn man auf den Like-Button klickt
            DB::query('INSERT INTO post_likes VALUES (\'\',:postid, :userid)', array(':postid' => $postid, ':userid' => $likerId));
            //das zeigt ob die eingeloggte Person (followerid) den Post geliked hat

                Notify::createNotify("", $postid);

        } else {
            DB::query('UPDATE posts SET likes=likes-1 WHERE id=:postid', array(':postid' => $postid));
            DB::query('DELETE FROM post_likes WHERE post_id=:postid AND user_id=:userid', array(':postid' => $postid, ':userid' => $likerId));
        }
    }





    public static function link_add($text){

        $text = explode(" ", $text);
        $newstring = "";

        foreach ($text as $word){
            if (substr($word, 0, 1) == "@"){
                $newstring .= "<a href='profile.php?username=".substr($word, 1)."'>".htmlspecialchars($word) . " </a> ";
            } else {
                $newstring .= htmlspecialchars($word ). " ";
            }
        }



        return ($newstring);



    }


    public static function displayPosts($profilePic, $userid, $username, $loggedIn_userid) { //hier irgendwo profile_pic

        $dbposts = DB::query('SELECT * FROM posts WHERE user_id=:userid ORDER BY id DESC', array(':userid'=>$userid));
        //ich muss ein MySQL Befehl machen, sodass das Profilbild nur von der userid genommen wird -> jetzt wird das Profilbild der eingeloggten Person auch bei den Posts der anderen Benutzer angezeigt
        // entweder füge ich eine Spalte "profile_pic" zu "posts"-Tabelle --> sodass ich unten so sagen kann: "$p['profile_pic']"
        $posts = "";

        foreach($dbposts as $p) {

            if (!DB::query('SELECT post_id FROM post_likes WHERE post_id=:postid AND user_id=:userid', array(':postid' => $p['id'], ':userid' => $loggedIn_userid))) {

                $posts .= "<img src='img_upload/profile_pics/".$profilePic."'>.<img src='img_upload/post_pics/".$p['img_id']."'>".(self::link_add($p['body'])) . " 
                
              <form action='profile.php?username=$username&postid=" . $p['id']."' method='post'>
                 <input type='submit' name='like' value='Like'>
                 <span>".$p['likes']." likes</span>
                 
                 <form action='profile.php?postid=".$p['id']." 'method='post'>
              <textarea name='commentbody' rows='3' cols='50'></textarea>
              <input type='submit' name='comment' value='Kommentieren'>
              </form>
              ";



                if ($userid == $loggedIn_userid){
                    $posts .="<input type='submit' name='deletepost' value='Löschen'> ";
                }
                #damit die Löschen Buttons nur sichtbar auf dem eigenen Profil sind

                $posts .="
              </form><hr /></br />
                ";
            }
            else {
                $posts .= htmlspecialchars(self::link_add($p['body'])) . "
              <form action='profile.php?username=$username&postid=" . $p['id'] . "' method='post'>
                 <input type='submit' name='unlike' value='Unlike'>
                 <span>".$p['likes']." likes</span>
                 
                
                  <form action='profile.php?postid=".$p['id']." 'method='post'>
              <textarea name='commentbody' rows='3' cols='50'></textarea>
              <input type='submit' name='comment' value='Kommentieren'>
              </form>
                 
                 ";


                if ($userid == $loggedIn_userid){
                    $posts .="<input type='submit' name='deletepost' value='Löschen'> ";
                }
                #damit die Löschen Buttons nur sichtbar auf dem eigenen Profil sind
                #$userid == $loggedIn_userid

                $posts .="
              </form><hr /></br />
                ";

            }

        }

        return $posts;


    }










    public static function displayPosts2 ($profilePic, $username, $loggedIn_userid) { //hier irgendwo profile_pic

        $dbposts = DB::query('SELECT * FROM posts WHERE user_id=:userid ORDER BY id DESC', array(':userid'=>$loggedIn_userid));
        //ich muss ein MySQL Befehl machen, sodass das Profilbild nur von der userid genommen wird -> jetzt wird das Profilbild der eingeloggten Person auch bei den Posts der anderen Benutzer angezeigt
        // entweder füge ich eine Spalte "profile_pic" zu "posts"-Tabelle --> sodass ich unten so sagen kann: "$p['profile_pic']"
        $posts = "";


        //.$id=$pdo->lastInsertId(); !!!!
        //$my_posts = DB::query('SELECT body FROM posts WHERE user_id=:userid', array(':userid' => $user_loggedin))[0]['body'];
        // echo $my_posts --> da wird der Post mit id "0" angezeigt und wir wollen dass der letzte angezeigt wird aber wie??? und wie fügen wir noch die Bilder hinzu? (siehe unten "img src ...")

        foreach($dbposts as $p) {

            if (!DB::query('SELECT post_id FROM post_likes WHERE post_id=:postid AND user_id=:userid', array(':postid' => $p['id'], ':userid' => $loggedIn_userid))) {

                $posts .= "<img src='img_upload/profile_pics/".$profilePic."'>.<img src='img_upload/post_pics/".$p['img_id']."'>".(self::link_add($p['body'])). "

              <form action='profile.php?username=$username&postid=" . $p['id']."' method='post'>
                 <input type='submit' name='like' value='Like'>
                 <span>".$p['likes']." likes</span>

                 <form action='profile.php?postid=".$p['id']." 'method='post'>
              <textarea name='commentbody' rows='3' cols='50'></textarea>
              <input type='submit' name='comment' value='Kommentieren'>
              </form>
              ";



                if ($loggedIn_userid){
                    $posts .="<input type='submit' name='deletepost' value='Löschen'> ";
                }
                #damit die Löschen Buttons nur sichtbar auf dem eigenen Profil sind

                $posts .="
              </form><hr /></br />
                ";
            }
            else {
                $posts .= htmlspecialchars(self::link_add($p['body'])) . "
              <form action='profile.php?username=$username&postid=" . $p['id'] . "' method='post'>
                 <input type='submit' name='unlike' value='Unlike'>
                 <span>".$p['likes']." likes</span>


                  <form action='profile.php?postid=".$p['id']." 'method='post'>
              <textarea name='commentbody' rows='3' cols='50'></textarea>
              <input type='submit' name='comment' value='Kommentieren'>
              </form>

                 ";


                if ($loggedIn_userid){
                    $posts .="<input type='submit' name='deletepost' value='Löschen'> ";
                }
                #damit die Löschen Buttons nur sichtbar auf dem eigenen Profil sind
                #$userid == $loggedIn_userid

                $posts .="
              </form><hr /></br />
                ";

            }

        }

        return $posts;


    }



//
//    public static function displayPosts2 ($profilePic, $username, $loggedIn_userid) { //hier irgendwo profile_pic
//
//        $dbposts = DB::query('SELECT * FROM posts WHERE user_id=:userid ORDER BY id DESC', array(':userid'=>$loggedIn_userid));
//        //ich muss ein MySQL Befehl machen, sodass das Profilbild nur von der userid genommen wird -> jetzt wird das Profilbild der eingeloggten Person auch bei den Posts der anderen Benutzer angezeigt
//        // entweder füge ich eine Spalte "profile_pic" zu "posts"-Tabelle --> sodass ich unten so sagen kann: "$p['profile_pic']"
//        $posts = "";
//
//
//        //.$id=$pdo->lastInsertId(); !!!!
//
//        foreach($dbposts as $p) {
//
//            if (!DB::query('SELECT post_id FROM post_likes WHERE post_id=:postid AND user_id=:userid', array(':postid' => $p['id'], ':userid' => $loggedIn_userid))) {
//
//                $posts .= "<img src='img_upload/profile_pics/".$profilePic."'>.<img src='img_upload/post_pics/".$p['img_id']."'>".(self::link_add($p->lastInsertId()['body'])). "
//
//              <form action='profile.php?username=$username&postid=" . $p['id']."' method='post'>
//                 <input type='submit' name='like' value='Like'>
//                 <span>".$p['likes']." likes</span>
//
//                 <form action='profile.php?postid=".$p['id']." 'method='post'>
//              <textarea name='commentbody' rows='3' cols='50'></textarea>
//              <input type='submit' name='comment' value='Kommentieren'>
//              </form>
//              ";
//
//
//
//                if ($loggedIn_userid){
//                    $posts .="<input type='submit' name='deletepost' value='Löschen'> ";
//                }
//                #damit die Löschen Buttons nur sichtbar auf dem eigenen Profil sind
//
//                $posts .="
//              </form><hr /></br />
//                ";
//            }
//            else {
//                $posts .= htmlspecialchars(self::link_add($p['body'])) . "
//              <form action='profile.php?username=$username&postid=" . $p['id'] . "' method='post'>
//                 <input type='submit' name='unlike' value='Unlike'>
//                 <span>".$p['likes']." likes</span>
//
//
//                  <form action='profile.php?postid=".$p['id']." 'method='post'>
//              <textarea name='commentbody' rows='3' cols='50'></textarea>
//              <input type='submit' name='comment' value='Kommentieren'>
//              </form>
//
//                 ";
//
//
//                if ($loggedIn_userid){
//                    $posts .="<input type='submit' name='deletepost' value='Löschen'> ";
//                }
//                #damit die Löschen Buttons nur sichtbar auf dem eigenen Profil sind
//                #$userid == $loggedIn_userid
//
//                $posts .="
//              </form><hr /></br />
//                ";
//
//            }
//
//        }
//
//        return $posts;
//
//
//    }




}
?>