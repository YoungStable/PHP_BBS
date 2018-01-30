<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../init.php';
include DIR_CORE.'MySQLDB.php';

$rpl_content = escapeString($_POST['rpl_content']);
$rpl_post_id = $_GET['post_id'];
$rpl_quote_numth = $_GET['numth'];
$rpl_quote_id = $_GET['rpl_id'];

if(empty($rpl_content)){
    jump("./quote.php?numth=$rpl_quote_numth&post_id=$rpl_post_id&rpl_id=$rpl_quote_id","内容不能为空，请重新输入！");
}
session_start();
$rpl_user = $_SESSION['user_info']['user_name'];
$rpl_time = time();
$sql = "insert into reply values (null,'$rpl_post_id','$rpl_user','$rpl_content','$rpl_time','$rpl_quote_numth','$rpl_quote_id')";
$result = my_query($sql);

if($result){
    jump("./show.php?post_id=$rpl_post_id");
}
else{
    jump("./quote.php?numth=$rpl_quote_numth&post_id=$rpl_post_id&rpl_id=$rpl_quote_id","发生未知错误，请重新发帖！");
}