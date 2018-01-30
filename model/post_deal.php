<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../init.php';

include DIR_CORE.'MySQLDB.php';

session_start();
$post_owner = $_SESSION['user_info']['user_name'];

$post_title = escapeString($_POST['post_title']);
$post_content = escapeString($_POST['post_content']);
if(empty($post_title)||empty($post_content)){
    jump('./post.php', '内容或标题不能为空！');
}


$post_time = time();
$sql = "insert into post values (null, '$post_title','$post_owner','$post_time','$post_content',0)";
$result = my_query($sql);
if(result){
    jump('./list_father_pages.php');
}
else{
    jump('./post.php', '发帖失败！');
}