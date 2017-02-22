<?php
include "DB_Options.php";
include  "Request.php";
include "reply.php";

class user
{
    public function login($user_name,$user_password)
    {
        $db=new DB_Options();
        $request_dispose=new request_dispose();
        $res=$db->from('user')->where("user_name=$user_name")->select('user_name');
        $f_res=$request_dispose->string_fliter($user_name,$user_password);
        if($f_res) {
            if ($res) {
                if ($res['user_password'] == $user_password) {
                    return json_encode($res);
                } else {
                    return json_encode("['status']=>['密码错误']");
                }
            } else {
                return json_encode("['status']=>['用户名不存在']");
            }
        }else {
            return json_encode("['status']=>['输入中含有非法字符']");
        }
    }
    //登陆
    public function register($user_name,$user_password,$user_avatar)
    {
        $request_dispose=new request_dispose();
        fopen($user_name,$user_avatar);
        move_uploaded_file($user_name,'/avatars');
        $random=rand();
        $path=$request_dispose->pictures_uploader('user_avatar'.$random,"/avatars/$user_name");
        $db=new DB_Options();
        $res = $db->table('user')->column('user_name', 'user_password', 'user_avatar')->insert($user_name, $user_password, $path);
        $f_res=$request_dispose->string_fliter($user_name,$user_password);
        if($f_res) {
            if ($res) {
                return json_encode("['status']=>['注册成功']");
            } else {
                return json_encode("['status']=>['注册失败']");
            }
        }else
        {
            return json_encode("['status']=>['输入中含有非法字符']");
        }
    }
//注册
    public function user_to_theme_post($user_name)
    {
        $db=new DB_Options();
        $user_post=$db->from('user_to_post')->where("user_name=$user_name")->select($user_name);
        foreach ($user_post as $k => $v) {
            $res=$db->from('theme_post')->where("post_id=$user_post[$k]")->select($user_post[$k]);
            return json_encode($res);
        }
    }
//用户查看主题贴
    public function user_to_reply_post($user_name)
    {
        $db=new DB_Options();
        $user_post=$db->from('user_to_post')->where("user_name=$user_name")->select($user_name);
        foreach ($user_post as $k => $v) {
            $res=$db->from('theme_post')->where("post_id=$user_post[$k]")->select($user_post[$k]);
            return json_encode($res);
        }
    }
//用户查看回复贴

}