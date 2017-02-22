<?php
include 'user.php';
include 'bar.php';
include 'post.php';
$pathinfo=explode('/',$_SERVER['PATH_INFO']);
$method=$_SERVER['REQUEST_METHOD'];
if($pathinfo[1]=='user')
{
    $user=new user();
    if($method=="POST")
    {
        $user->register($_post['user_name'],$_POST['user_password'],$_FILES['user_avatar']);
    }
    elseif($method=="GET")
    {
        $user->login($_GET['user_name'],$_GET['user_password']);
    }
    elseif($pathinfo[2]=='theme_post')
    {
        $user->user_to_theme_post($_GET['user_name']);
    }
    elseif($pathinfo[2]=='reply_post')
    {
        $user->user_to_reply_post($_GET['user_name']);
    }
    else
    {
        return json_encode("['status']=>['403']");
    }
}
if($pathinfo[1]=='bar')
{
    $bar=new bar();
    if($method=='POST')
    {
        $bar->build_bar($_GET['bar_name'],$_FILES['bar_avatar']);
    }
    elseif($pathinfo[2]=='bar_info')
    {
        $bar->post_count();
        $bar->bar();
    }
    elseif($pathinfo[2]=='theme_post')
    {
        $bar->view_theme_post($_GET['bar_name']);
    }
    elseif($pathinfo[2]=='follower')
    {
        $bar->follow($_GET['user_name'],$_GET['bar_name']);
    }
    else
    {
        return json_encode("['status']=>['403']");
    }
}
if($pathinfo[1]=='post')
{
    $post=new post();
    if($pathinfo[2]=='reply_post')
    {
        if($method=='POST')
        {
          $post->new_reply_post($_POST['them_title'],$_POST['content'],$_POST['post_number'],$_POST['pictures'],$_POST['user_name'],$_POST['bar_name'],$_POST['post_time']);
        }
        elseif($method=='GET')
        {
            $post->view_reply_post($_GET['themt_title']);
        }
    }
    elseif($pathinfo[2]=='theme_post')
    {
        if($method=='POST')
        {
            $post->new_theme_post($_POST['title'],$_POST['content'],$_POST['post_number'],$_POST['pictures'],$_POST['user_name'],$_POST['bar_name'],$_POST['post_time']);
        }
        if($method=='GET')
        {
            $post->user_to_theme_post($_GET['user_name']);
        }
    }

}
