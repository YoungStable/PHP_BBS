<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include '../init.php';
include DIR_CORE.'MySQLDB.php';

$sql = 'select * from post';
$sum_result = my_query($sql);
$sum_arr = mysql_fetch_assoc($sum_result);
$sum = $sum_arr['sum'];

$pageSize = 5;
$pageTotal = ceil($sum/$pageSize);

$pageStr = '';


$sql = 'select * from post';
$result = my_query($sql);


include DIR_VIEW.'list_father.html';
