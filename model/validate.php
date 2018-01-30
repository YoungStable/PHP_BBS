<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../init.php';

include DIR_CORE.'MySQLDB.php';

if(isset($_COOKIE['user_id'])){
    jump('./post.php');
}
$user_name = trim($_POST['user_name']);
$user_pwd = trim($_POST['user_pwd']);

if(empty($user_name)||empty($user_pwd)){
    jump('./login.php', "用户名密码不能为空");
}

$sql = "select * from user where user_name='$user_name'";
$result = my_query($sql); // 资源结果集
if(mysql_affected_rows() == 0) {
	// 说明用户名不存在
	jump('./login.php', '用户名不存在！');
}

$row = mysql_fetch_assoc($result);
$true_pwd = $row['user_pwd'];
if(md5($user_pwd) === $true_pwd){
    if(isset($_POST['remember'])){
        setCookie('user_id',$row['user_id'],time()+604800,'/');
    }
    session_start();
    $_SESSION['user_info'] = $row;

    jump('./post.php', '登录成功！');
}
else{
    jump('./login.php', '密码错误！');
}