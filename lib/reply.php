<?php
$source=array();
if($source)
{
    $reply=json_encode($source);
    return $reply;
}
else
{
    return '出问题了==';
}