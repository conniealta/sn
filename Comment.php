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
            $username = $comment ['username'];
            //$userid = $comment ['user_id'];

            echo "<div class='comment_box'><img style='width: 35px; height: 35px; border-radius: 55px;' src='img_upload/profile_pics/$profile_pic'>".' '.' '."<a href='profile.php?username=".$username." ' >".$comment['username'].'</a>'.' '.' '.' '.Post::link_add($comment['comment'])."</div>";

        }
        // ['comment'] = die Spalte in der Datenbank
    }


//damit werden die Kommentare bei "profile.php" nicht ganz oben angezeigt, sondern unter den jeweiligen Posts:
    public static function displayComments2 ($postId) {
        $comments = DB::query('SELECT comments.comment, list5.username, list5.profile_pic FROM comments, list5 WHERE post_id = :postid AND comments.user_id = list5.id', array(':postid'=>$postId));
        // Join machen --> Fremdschlüssel mit den Primärschlüsseln zusammenfügen, sodass nur der Kommentar und der Name des Nutzers, der ihn geschrieben hat, angezeigt werden
        $com = "";
        foreach ($comments as $comment) {
            $profile_pic = $comment['profile_pic'];
            $username = $comment ['username'];
            $com = $com."<div class='comment_box'><img style='width: 35px; height: 35px; border-radius: 55px;' src='img_upload/profile_pics/$profile_pic'>".' '.' '."<a href='profile.php?username=".$username." ' >".$comment['username'].'</a>'.' '.' '.' '.Post::link_add($comment['comment'])."</div>";

        }
        // ['comment'] = die Spalte in der Datenbank
        return $com;
    }
}
?>