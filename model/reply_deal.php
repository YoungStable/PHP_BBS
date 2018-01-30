<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../init.php';

include DIR_CORE.'MySQLDB.php';

session_start();
$rpl_user = $_SESSION['user_info']['user_name'];

$rpl_post_id = $post_id = $_POST['post_id'];
$rpl_content = escapeString($_POST['rpl_content']);

if(empty($rpl_content)){
    jump("./reply.php?post_id=$post_id",'回复的内容不能为空');
}

$rpl_time = time();
$sql = "insert into reply values (null,'$rpl_post_id','$rpl_user','$rpl_content','$rpl_time',default, default);";
$result = my_query($sql);
if($result){
    jump("./show.php?post_id=$post_id");
}
else{
    jump('./reply.php','未知错误');
}