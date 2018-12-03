<?php
class Comment {
    public static function createComment ($commentBody, $postId, $userId) {
        if (strlen($commentBody) > 100 || strlen($commentBody) < 1) {
            die('Inkorrekte Länge!');
        }
        if (!DB::query('SELECT id FROM posts WHERE id=:postid', array(':postid'=>$postId))) {
            //wenn die 'id' nicht valide ist:
            echo "Invalide Post-Id";
        }
        else {
            DB::query('INSERT INTO comments VALUES (\'\', :comment, :userid, NOW(), :postid)', array(':comment'=>$commentBody, ':userid'=>$userId, ':postid'=>$postId));
        }
    }



    public static function displayComments($postId) {
        $comments = DB::query('SELECT comments.comment, list5.username, list5.profile_pic FROM comments, list5 WHERE post_id = :postid AND comments.user_id = list5.id', array(':postid'=>$postId));
        // Join machen --> Fremdschlüssel mit den Primärschlüsseln zusammenfügen, sodass nur der Kommentar und der Name des Nutzers, der ihn geschrieben hat, angezeigt werden
        foreach ($comments as $comment) {
            $profile_pic = $comment['profile_pic'];
            echo $comment['username'].' '."<img style='width: 45px; height: 45px;' src='img_upload/profile_pics/$profile_pic'>".' '.' '.$comment['comment']."<hr />";

        }
        // ['comment'] = die Spalte in der Datenbank
    }



    public static function displayComments2 ($postId) {
        $comments = DB::query('SELECT comments.comment, list5.username FROM comments, list5 WHERE post_id = :postid AND comments.user_id = list5.id', array(':postid'=>$postId));
        // Join machen --> Fremdschlüssel mit den Primärschlüsseln zusammenfügen, sodass nur der Kommentar und der Name des Nutzers, der ihn geschrieben hat, angezeigt werden
        $com = "";
        foreach ($comments as $comment) {
            $profile_pic = $comment['profile_pic'];
            $com = $comment['username'].' '."<img src='img_upload/profile_pics/$profile_pic'>".$comment['comment']."<hr />";
        }
        // ['comment'] = die Spalte in der Datenbank
        return $com;
    }



//Bei "$com" --> das hinzufügen:
//$posts .= "<img src='img_upload/profile_pics/".$profilePic."'>.<img src='img_upload/post_pics/".$p['img_id']."'>".self::link_add($p['body']) . "
//              <form action='profile.php?username=$username&postid=" . $p['id'] . "' method='post'>
//                 <input type='submit' name='unlike' value='Unlike'>
//                 <span>".$p['likes']." likes</span>
//
//
//                ";
//
//if ($userid == $loggedIn_userid){
//$posts .="<input type='submit' name='deletepost' value='Löschen'> ";
//}
//#damit die Löschen Buttons nur sichtbar auf dem eigenen Profil sind
//#$userid == $loggedIn_userid
//
//$posts .= "<form action='profile.php?postid=".$p['id']." 'method='post'>
//              <textarea name='commentbody' rows='3' cols='50'></textarea>
//              <input type='submit' name='comment' value='Kommentieren'>
//              </form>";
//
//
//// $posts .= Comment::displayComments($p['id']);
//
//
//
//$posts .="
//              </form><hr /></br />
//                ";
}
?>