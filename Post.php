<?php

include('Notify2.php');
class Post {

// Das ist wenn die eingeloggte Person bei der eigenen Profilseite ist und von dort aus posten will:

    public static function createPost($postbody, $loggedIn_userid, $profileUserId) {
        if (strlen($postbody) > 1000 || strlen($postbody) < 1) {

            die('Inkorrekte Länge!');
        }


        if ($loggedIn_userid == $profileUserId) { //wenn die eingeloggte Person auf ihrer eigenen Profilseite ist, dann darf sie Einträge posten
            if (count(Notify2::createNotify($postbody)) != 0) {

                foreach (Notify2::createNotify($postbody) as $key => $n) {
                    $s = $loggedIn_userid;
                    $r = DB::query('SELECT id FROM list5 WHERE username=:username', array(':username'=>$key))[0]['id'];

                    if ($r != 0) {
                        DB::query('INSERT INTO notifications VALUES (\'\', :type, :receiver, :sender, :extra)', array(':type'=>$n["type"], ':receiver'=>$r, ':sender'=>$s, ':extra'=>$n["extra"]));
                    }
                }
            }

            DB::query('INSERT INTO posts VALUES (\'\', :postbody, \'\', NOW(), :userid, 0)', array(':postbody' => $postbody, ':userid' => $profileUserId));

        } // -> '\'= die erste Spalte in der Datenbanktabelle ("id"); NOW() = das ist eine Funktion, die das aktuelle Datum und Uhrzeit anzeigt; '0'= die Standardanzahl der "Likes"
        else {

            die('Falscher Benutzer!');
        }
    }



// Das ist wenn die eingeloggte Person beim "Feed" ist und von dort aus posten will:

    public static function createPost2 ($postbody, $loggedIn_userid) {
        if (strlen($postbody) > 1000 || strlen($postbody) < 1) {

            die('Inkorrekte Länge!');
        }

        if ($loggedIn_userid) {
            if (count(Notify2::createNotify($postbody)) != 0) {

                foreach (Notify2::createNotify($postbody) as $key => $n) {
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




// Das ist wenn die eingeloggte Person bei der eigenen Profilseite ist und von dort aus posten will:
    public static function createImgPost($img_id, $postbody, $loggedIn_userid, $profileUserId) {

        if (strlen($postbody) > 1000) {

            die('Inkorrekte Länge!');
        }

        if ($loggedIn_userid == $profileUserId) {

            if (count(Notify2::createNotify($img_id)) != 0) {

                foreach (Notify2::createNotify($img_id) as $key => $n) {
                    $s = $loggedIn_userid;
                    $r = DB::query('SELECT id FROM list5 WHERE username=:username', array(':username'=>$key))[0]['id'];

                    if ($r != 0) {
                        DB::query('INSERT INTO notifications VALUES (\'\', :type, :receiver, :sender, :extra)', array(':type'=>$n["type"], ':receiver'=>$r, ':sender'=>$s, ':extra'=>$n["extra"]));
                    }
                }
            }

            DB::query('INSERT INTO posts VALUES (\'\',:postbody, :img_id, NOW(), :userid, 0)', array(':img_id'=>$img_id, ':postbody' => $postbody, ':userid'=>$profileUserId));
            $postid = DB::query('SELECT id FROM posts WHERE user_id=:userid ORDER BY ID DESC LIMIT 1;', array(':userid'=>$loggedIn_userid))[0]['id'];

            return $postid;

        } else {

            die('Incorrect user!');
        }
    }





// Das ist wenn die eingeloggte Person beim "Feed" ist und von dort aus posten will:
    public static function createImgPost2 ($img_id, $postbody, $loggedIn_userid) {

        if (strlen($postbody) > 1000 ) {

            die('Inkorrekte Länge!');
        }

        if ($loggedIn_userid) {

            if (count(Notify2::createNotify($img_id)) != 0) {

                foreach (Notify2::createNotify($img_id) as $key => $n) {
                    $s = $loggedIn_userid;
                    $r = DB::query('SELECT id FROM list5 WHERE username=:username', array(':username'=>$key))[0]['id'];

                    if ($r != 0) {
                        DB::query('INSERT INTO notifications VALUES (\'\', :type, :receiver, :sender, :extra)', array(':type'=>$n["type"], ':receiver'=>$r, ':sender'=>$s, ':extra'=>$n["extra"]));
                    }
                }
            }

            DB::query('INSERT INTO posts VALUES (\'\',:postbody, :img_id, NOW(), :userid, 0)', array(':img_id'=>$img_id, ':postbody' => $postbody, ':userid'=>$loggedIn_userid));
            $postid = DB::query('SELECT id FROM posts WHERE user_id=:userid ORDER BY ID DESC LIMIT 1;', array(':userid'=>$loggedIn_userid))[0]['id'];

            return $postid;

        } else {

            die('Incorrect user!');
        }
    }






    public static function likePost($postId, $likerId) {
        if (!DB::query('SELECT user_id FROM post_likes WHERE post_id=:postid AND user_id=:userid', array(':postid'=>$postId, ':userid'=>$likerId))) {
            //Verneinung von : "Benutzer-id steht neben post_id in der Tabelle post_likes, d.h. Benutzer hat diesen bestimmten Post schon geliked"
            // = Wenn das nicht der Fall ist:
            DB::query('UPDATE posts SET likes=likes+1 WHERE id=:postid', array(':postid'=>$postId));
            DB::query('INSERT INTO post_likes VALUES (\'\', :postid, :userid)', array(':postid'=>$postId, ':userid'=>$likerId));
            Notify2::createNotify("", $postId);
        } else {
            DB::query('UPDATE posts SET likes=likes-1 WHERE id=:postid', array(':postid'=>$postId));
            DB::query('DELETE FROM post_likes WHERE post_id=:postid AND user_id=:userid', array(':postid'=>$postId, ':userid'=>$likerId));
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




    public static function displayPosts($profilePic, $userid, $username, $loggedIn_userid) {
        $dbposts = DB::query('SELECT * FROM posts WHERE user_id=:userid ORDER BY id DESC', array(':userid'=>$userid));

        $posts = "";


        foreach($dbposts as $p) {

            if (!DB::query('SELECT post_id FROM post_likes WHERE post_id=:postid AND user_id=:userid', array(':postid' => $p['id'], ':userid' => $loggedIn_userid))) {
                // damit überprüfen wir, ob der Post durch die eingeloggte Person schon geliked wurde, wenn die eingeloggte Person den Post noch nicht geliked hat, wird dieses Formular angezeigt:


                    if (!$p['img_id']== "") { // wenn es ein Bild gibt, dann führ das aus (zeig das Bild an!)


                        $posts .= "<div class='row post_box'>";
                        $posts .= "<div class='col-lg-3'>";
                        $posts .= "<img style='width: 75px; height: 75px; border-radius: 55px; margin-left:10px;' src='img_upload/profile_pics/".$profilePic."'>";
                        $posts .= "<a href='profile.php?username=".$username." ' >".$username."</a>";
                        $posts .= "</div>";
                        $posts .= "<div class='col-lg-9 post_body'>";
                        $posts .= "<img src='img_upload/post_pics/".$p['img_id']."'>".' '.' '.self::link_add($p['body']).' '.' '."<br><br>".$p['posted_at']

                       ."<form action='profile.php?username=$username&postid=" . $p['id']."' method='post'>
                 <input type='submit' name='like' value='Like'>
                 <span>".$p['likes']." likes</span>
                 ";

                        if ($userid == $loggedIn_userid){
                            $posts .="<input type='submit' name='deletepost' value='Löschen'> ";
                        }
                        //damit die Löschen Buttons nur sichtbar auf dem eigenen Profil sind


                        $posts .= "<form action='profile.php?postid=".$p['id']." 'method='post'>
              <textarea name='commentbody' rows='3' cols='50'></textarea>
              <input type='submit' name='comment' value='Kommentieren'>
              </form>";


                        $posts .= Comment::displayComments2($p['id']);
                        $posts .= "</form></div></div>
                ";
                    }

                    else { // wenn es kein Bild im Post gibt, dann führe das aus:
                        $posts .= "<div class='row post_box'>";
                        $posts .= "<div class='col-lg-3'>";
                        $posts .= "<img style='width: 75px; height: 75px; border-radius: 55px; margin-left:10px;' src='img_upload/profile_pics/".$profilePic."'>";
                        $posts .= "<a href='profile.php?username=".$username." ' >".$username."</a>";
                        $posts .= "</div>";
                        $posts .= "<div class='col-lg-9 post_body'>";
                        $posts .= self::link_add($p['body'])."<br><br>".$p['posted_at']

                        ."<form action='profile.php?username=$username&postid=" . $p['id']."' method='post'>
                 <input type='submit' name='like' value='Like'>
                 <span>".$p['likes']." likes</span>
                 ";

                        if ($userid == $loggedIn_userid){
                            $posts .="<input type='submit' name='deletepost' value='Löschen'> ";
                        }
                        //damit die Löschen Buttons nur sichtbar auf dem eigenen Profil sind


                        $posts .= "<form action='profile.php?postid=".$p['id']." 'method='post'>
              <textarea name='commentbody' rows='3' cols='50'></textarea>
              <input type='submit' name='comment' value='Kommentieren'>
              </form>";


                        $posts .= Comment::displayComments2($p['id']);
                        $posts .= "</div></div>";

                        // !!! So werden die Kommentare ganz oben gezeigt, obwohl alles stimmt:
                       // $posts .= Comment::displayComments($p['id'])."</form><hr /></br />";

                    }

            }
            else { // Der Unterschied zwischen dem Haupt-If und diesem Else ist der Unlike/Like-Button !!

                        //Comment::displayComments($p['id']).

                if (!$p['img_id']== "") {
                    $posts .= "<div class='row post_box'>";
                    $posts .= "<div class='col-lg-3'>";
                    $posts .= "<img style='width: 75px; height: 75px; border-radius: 55px; margin-left:10px;' src='img_upload/profile_pics/" . $profilePic . "'>";
                    $posts .= "<a href='profile.php?username=" . $username . " ' >" . $username . "</a>";
                    $posts .= "</div>";
                    $posts .= "<div class='col-lg-9 post_body'>";
                    $posts .= "<img src='img_upload/post_pics/" . $p['img_id'] . "'>" . self::link_add($p['body']).' '.' '."<br><br>".$p['posted_at']

                    ."<form action='profile.php?username=$username&postid=" . $p['id'] . "' method='post'>
                 <input type='submit' name='unlike' value='Unlike'>
                 <span>" . $p['likes'] . " likes</span>
              
                ";

                    if ($userid == $loggedIn_userid) {
                        $posts .= "<input type='submit' name='deletepost' value='Löschen'> ";
                    }
                #damit die Löschen Buttons nur sichtbar auf dem eigenen Profil sind
                #$userid == $loggedIn_userid

                $posts .= "<form action='profile.php?postid=" . $p['id'] . " 'method='post'>
              <textarea name='commentbody' rows='3' cols='50'></textarea>
              <input type='submit' name='comment' value='Kommentieren'>
              </form>";

                $posts .= Comment::displayComments2($p['id']);
                $posts .= "
             
              </form></br /></div></div>
                ";
                }

                else {
                    $posts .= "<div class='row post_box'>";
                    $posts .= "<div class='col-lg-3'>";
                    $posts .= "<img style='width: 75px; height: 75px; border-radius: 55px; margin-left:10px;' src='img_upload/profile_pics/".$profilePic."'>";
                    $posts .= "<a href='profile.php?username=".$username." ' >".$username."</a>";
                    $posts .= "</div>";
                    $posts .= "<div class='col-lg-9 post_body'>";
                    $posts .= self::link_add($p['body'])."<br><br>".$p['posted_at']

                    ."<form action='profile.php?username=$username&postid=" . $p['id'] . "' method='post'>
                 <input type='submit' name='unlike' value='Unlike'>
                 <span>" . $p['likes'] . " likes</span>
              
                ";

                    if ($userid == $loggedIn_userid) {
                        $posts .= "<input type='submit' name='deletepost' value='Löschen'> ";
                    }
                    #damit die Löschen Buttons nur sichtbar auf dem eigenen Profil sind
                    #$userid == $loggedIn_userid

                    $posts .= "<form action='profile.php?postid=" . $p['id'] . " 'method='post'>
              <textarea name='commentbody' rows='3' cols='50'></textarea>
              <input type='submit' name='comment' value='Kommentieren'>
              </form>";

                    $posts .= Comment::displayComments2($p['id']);
                    $posts .= "
             
              </form></br /></div></div>
                ";
                }

            }

        }


        return $posts;
    }


/*
    Erläuterung:
    mit "return" --> dies gibt die Variable '$posts = "";' zurück , die all den HTML-Code und alle Posts beinhaltet
    $p = ein Array mit den Datenbankeinträgen: z.B. --> Array ([id]=>1 [0]=>1 [body]=>Hello [1]=>Hello [posted_at]=>2018-11-08 17:37:23 ...)
    $p[body] = unser Post wird bei "body" in der Datenbanktabelle gespeichert --> mit dieser Funktion sehen wir nur den Inhalt des Posts (nicht id, Datum, etc.)
    $posts = "" -> zunächst leer Array
    "<hr />" = horizontale Linie
    ".=" (->  $txt1 = "Hello"; $txt2 = " world!"; $txt1 .= $txt2; --> Hello world)
    htmlspecialchars = wandelt Sonderzeichen in HTML-Codes um
    postid = das ist die "id" des jeweiligen Posteintrag
    if (isset($_GET['postid']) -> prüfen, ob der Like-Button geklickt wurde, wenn ja

*/

}
?>