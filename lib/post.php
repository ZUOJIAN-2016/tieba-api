<?php
include "DB_Options.php";
include  "Request.php";
include "reply.php";
class post
{

    public function view_reply_post($theme_title)
    {
        $db = new DB_Options();
        $res = $db->from('theme_post')->where("post_id=$theme_title")->select('post_id');
        $res1 = $db->from('theme_to_reply')->where("post_id=$res[reply_id]")->select('post_id');
        $result=$db->from('reply_post')->where("post_id=$res1[reply_id]")->select('post_id');
        return json_encode($result);
    }

//浏览回复贴
    public function new_theme_post($title, $content, $post_number, $pictures, $user_name, $bar_name, $post_time)
    {
        fopen($title, $content);
        fopen($post_number . $title, $pictures);
        $request_dispose = new request_dispose();
        move_uploaded_file($title,'/content');
        move_uploaded_file($post_number.$title,'/pictures');
        $random=rand();
        $content_path = $request_dispose->pictures_uploader('theme_post_content'.$random, "/contents/$title");
        $pictures_path = $request_dispose->pictures_uploader('theme_post_pictures'.$random, "/pictures/$post_number . $title");
        $db = new DB_Options();
        $db->table('theme_post')->
        column('title', 'post_number', 'pictures', 'post_time', 'content')->insert($title, $post_number, $pictures_path . $post_number, $post_time, $content_path);
        $pdo=new PDO("mysql:host=sqld.duapp.com;port=4050;dbname=OlFgSNSuFAwTZJwqhVuU", "da49132671114ca2ae83f45b1614bf75", "5dd3981f872f4477b897cb63f1e43410");
        $id = $pdo->lastInsertId();
        $res = $db->from('themt_post')->where("post_id=$id")->select($id);
        $res1 = $db->table('bar_to_post')->column('bar_name', 'post_id')->insert($bar_name, $id);
        $res2 = $db->table('user_to_post')->column('user_name', 'post_id')->insert($user_name, $id);
        if ($res1 && $res2) {
            return json_encode("['status']=>['发布主题贴成功！'],['theme_post]=>[$res]");
        } else {
            return json_encode("['status']=>['网络繁忙']");
        }
    }

//新建主题帖
    public function new_reply_post($theme_title, $content, $post_number, $pictures, $user_name, $bar_name, $post_time)
    {
        fopen($theme_title . $post_number, $content);
        fopen($post_number, $pictures);
        $request_dispose = new request_dispose();
        move_uploaded_file($theme_title . $post_number,'/contents');
        move_uploaded_file($post_number,'/pictures');
        $random=rand();
        $content_path = $request_dispose->pictures_uploader('theme_post_content'.$random, "/contents/$theme_title . $post_number");
        $pictures_path = $request_dispose->pictures_uploader('theme_post_pictures'.$random, $post_number);
        $db = new DB_Options();
        $db->table('theme_post')->
        column('post_number', 'pictures', 'post_time', 'content')->insert($post_number, $pictures_path, $post_time, $content_path);
        $pdo = $pdo = new PDO("mysql:host=localhost;dbname='tieba'", "root", "");
        $reply_id = $pdo->lastInsertId();
        $theme_post = $db->from('theme_post')->where("title=$theme_title")->select($theme_title);
        $theme_id = $theme_post['post_id'];
        $res = $db->from('reply_post')->where("post_id=$reply_id")->select($reply_id);
        $res1 = $db->table('bar_to_post')->column('bar_name', 'post_id')->insert($bar_name, $reply_id);
        $res2 = $db->table('user_to_post')->column('user_name', 'post_id')->insert($user_name, $reply_id);
        $res3 = $db->table('theme_to_reply')->column('theme_id', 'reply_id')->insert($theme_id, $reply_id);
        if ($res1 && $res2 && $res3) {
            return json_encode("['status']=>['发布回复贴成功！'],['post_content]=>['$res']");
        } else {
            return json_encode("['status']=>['发布回复贴失败！']");
        }
    }

//新建回复贴
    public function user_to_theme_post($user_name)
    {
        $db = new DB_Options();
        $user_post = $db->from('user_to_post')->where("user_name=$user_name")->select($user_name);
        foreach ($user_post as $k => $v) {
            $res = $db->from('theme_post')->where("post_id=$user_post[$k]")->select($user_post[$k]);
            return json_encode($res);
        }
    }
}