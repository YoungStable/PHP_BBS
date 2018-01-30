<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../init.php';
include DIR_CORE.'MySQLDB.php';
include DIR_CORE.'upload.php';

$file = $_FILES['image'];
$allow = array('image/jpeg','image/png','image/gif');
$path = DIR_UPLOADS.'images';

$result = upload($file, $allow, $error, $path);
if($result){
    session_start();
    $user_name = $_SESSION['user_info']['user_name'];
    $old_sql  = "select user_image from user where user_name = $user_name";
    $old_row = fetchRow($old_sql);
    $old_name = $old_row['user_image'];
    $sql ="update user set user_image = '$result' where user_name = '$user_name'";
    $query_result = my_query($sql);
    if($query_result){
        unlink($path.'/'.$old_name);
        jump('./list_father_pages.php','头像入库成功'); 
    }
    else{
        jump('./upload_image.php','上传失败，请重新上传');
    }
}
else{
    jump('./upload_image.php','发生未知错误，上传失败！');
}