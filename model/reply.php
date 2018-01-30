<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../init.php';

include DIR_CORE.'MySQLDB.php';

is_login();

$post_id = $_GET['post_id'];
$sql = "select * from post where post_id = '$post_id' ";
$row = fetchRow($sql);

include DIR_VIEW.'reply.html';