<?php

include "DB_Options.php";
include  "Request.php";
include "reply.php";

class bar
{
    public function post_count()
    {
        $db=new DB_Options();
        $theme_post_num=$db->table('theme_post')->count();
        $reply_post_num=$db->table('reply_post')->count();
        $totalpost=$theme_post_num+$reply_post_num;
        $db->table('bar')->column('bar_totalpost')->insert($totalpost);
    }
    public function bar()
    {
        $db=new DB_Options();
        $res=$db->table('bar')->fetch_table();
        return $res;
    }
//遍历bar表，返回所有信息
    public function follow($user_name,$bar_name)
    {
        $db=new DB_Options();
        $res=$db->table('user_to_bar')->column('user_name','bar_name')->insert($user_name,$bar_name);
        if($res)
        {
            return json_encode("['status']=>['关注成功！']");
        }else
        {
            return json_encode("['status']=>['网络繁忙']");
        }
    }
//关注贴吧
    public function view_theme_post($bar_name)
    {
        $db=new DB_Options();
        $res=$db->table('bar_to_post')->fetch_table();
        $result=$db->from('post')->where("post_id=$res[post_id]")->select('post_id');
        return json_encode($result);
    }
//浏览主题帖
    public function build_bar($bar_name,$bar_avatar)
    {
        $request_dispose=new request_dispose();
        fopen($bar_name,$bar_avatar);
        move_uploaded_file($bar_name,'/avatars');
        $random=rand();
        $path=$request_dispose->pictures_uploader('bar_avatar'.$random,"/avatars/$bar_name");
        $db=new DB_Options();
        $res = $db->table('bar')->column('bar_name', 'bar_avatar')->insert($bar_name, $path);
        $f_res=$request_dispose->string_fliter($bar_name);
        if($f_res) {
            if ($res) {
                return json_encode("['status']=>['建吧成功']");
            } else {
                return json_encode("['status']=>['建吧失败']");
            }
        }else
        {
            return json_encode("['status']=>['输入中含有非法字符']");
        }
    }
    //建吧
}