<?php
include 'BaiduBce.phar';
require 'myConf.php';
use BaiduBce\BceClientConfigOptions;
use BaiduBce\Util\Time;
use BaiduBce\Util\MimeTypes;
use BaiduBce\Http\HttpHeaders;
use BaiduBce\Services\Bos\BosClient;

class request_dispose
{

     public function string_fliter()
    {
        $request=func_get_args();
    // 定义不允许提交的SQL命令及关键字
    $words = array();
    $words[]    = " add ";
    $words[]    = " count ";
    $words[]    = " create ";
    $words[]    = " delete ";
    $words[]    = " drop ";
    $words[]    = " from ";
    $words[]    = " grant ";
    $words[]    = " insert ";
    $words[]    = " select ";
    $words[]    = " truncate ";
    $words[]    = " update ";
    $words[]    = " use ";
    $words[]    = "-- ";

    // 判断提交的数据中是否存在以上关键字
    foreach($request as $strGot) {
        $strGot = strtolower($strGot); // 转为小写
        foreach($words as $word) {
            if (strstr($strGot, $word)) {
                return 0;
            }else{return 1;}
        }
    }// foreach
}
    public function pictures_uploader($objectKey,$fileName)
    {
        global $BOS_CONFIG;
        $bucketName = "404notfound_yun";
        $client=new \BaiduBce\Services\Bos\BosClient($BOS_CONFIG);
        $exist = $client->doesBucketExist($bucketName);
        if(!$exist){
            $client->createBucket($bucketName);
        }
        $client->putObjectFromFile($bucketName, $objectKey, $fileName);
        $signOptions = array(
            SignOptions::TIMESTAMP=>new \DateTime(),
            SignOptions::EXPIRATION_IN_SECONDS=>-1,
        );
        $url = $client->generatePreSignedUrl($bucketName,
            $objectKey,
            array(BosOptions::SIGN_OPTIONS => $signOptions)
        );
        return $url;

    }
    //上传头像并返回头像存储的路径
}
