<?php
header('content-type:text/html;charset="utf-8"');
error_reporting(0);

$name = $_GET['username'];
// 用户名要中文、英文或数字（或关系）并且5-20个字符
$preg='/^[0-9a-zA-Z\x{4e00}-\x{9fa5}]{5,20}$/u';
$preg1='/^[0-9a-zA-Z\x{4e00}-\x{9fa5}]{0,4}$/u';
$preg2='/^[0-9a-zA-Z\x{4e00}-\x{9fa5}]{21,}$/u';
if(preg_match($preg,$name)){
    echo "输入正确";
}else if(preg_match($preg1,$name)){
    echo "不要少于5个字符";
}else if(preg_match($preg2,$name)){
    echo "不要超过20个字符";
}else{
    echo "输入有误";
}
?>