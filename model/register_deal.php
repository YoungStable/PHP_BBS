<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include '../init.php';
include DIR_CORE.'MySQLDB.php';


$user_name= trim($_POST['user_name']);
$user_pwd = trim($_POST['user_pwd']);
$repeat_pwd = trim($_POST['repeat_pwd']);
$vcode = trim($_POST['vcode']);

session_start();
if(strtolower($vcode)!== strtolower($_SESSION['captcha'])){
    jump('./register.php','验证码不正确');
}

if(empty($user_name)||empty($user_pwd)||empty($repeat_pwd)){
    jump('./register.php', "密码或者用户名不能为空！");
}

if($repeat_pwd!==$user_pwd){
    jump('./register.php', "两次密码输入不同！请重新输入");
}
if(strlen($user_name)<6|| strlen($user_name)>10){
    jump('./register.php', "用户名长度不合法，请重新输入！");
}
if(strlen($user_pwd)<6|| strlen($user_pwd)>10){
    jump('./register.php', "用户密码长度不合法，请重新输入！");
}

$sql = "select * from user where user_name='{$user_name}'";
mysql_query($sql);
if(mysql_affected_rows() > 0){
   jump('./register.php', "您输入的用户名已经存在，请重新输入！");
}

$user_pwd = md5($user_pwd);
$sql = "insert into user values(null,'$user_name','$user_pwd',default);";
$result = mysql_query($sql);
if($result){
    jump('./login.php', "注册成功！");
}
else{
    jump('./register.php', "未知错误，注册失败");
}
