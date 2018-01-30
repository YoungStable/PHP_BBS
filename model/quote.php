<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../init.php';
is_login();

include DIR_CORE.'MySQLDB.php';

$numth = $_GET['numth'];
$post_id = $_GET['post_id'];
$rpl_id = $_GET['rpl_id'];

$sql = "select * from post where post_id = $post_id";
$row = fetchRow($sql);

$sql = "select * from reply where rpl_id = $rpl_id";
$rpl_row  = fetchRow($sql);

include DIR_VIEW.'quote.html';
