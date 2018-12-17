
<?php

class Notify2 {
    public static function createNotify($text = "", $postid = 0) {
        $text = explode(" ", $text);
        $notify = array();
        foreach ($text as $word) {
            if (substr($word, 0, 1) == "@") {
                $notify[substr($word, 1)] = array("type"=>1, "extra"=>' { "postbody": "'.htmlentities(implode($text, " ")).'" } ');
            }
        }
        if (count($text) == 1 && $postid != 0) {
            $temp = DB::query('SELECT posts.user_id AS receiver, post_likes.user_id AS sender FROM posts, post_likes WHERE posts.id = post_likes.post_id AND posts.id=:postid', array(':postid'=>$postid));
            $r = $temp[0]["receiver"];
            $s = $temp[0]["sender"];
            DB::query('INSERT INTO notifications VALUES (\'\', :type, :receiver, :sender, :extra, :post_id)', array(':type'=>2, ':receiver'=>$r, ':sender'=>$s, ':extra'=>"", ':post_id'=>$postid));
        }
        return $notify;
    }
}
?>
zgzg
ugzg
gfzg
uzguhjij
ugug
hguj
sdfghjk
asdfghjm
asdfg
retzuio
vbnm
oiuhg
oiuztfds
iuztrd
lkjhgvc
kjhgf
fghjkl
oiuztrds
oiuhg
oiuztrd
