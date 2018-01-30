<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


include '../init.php';
include DIR_CORE.'MySQLDB.php';

$sql = 'select count(*) as sum from post';
$sum = fetchColumn($sql);

$config = include DIR_CONFIG.'config.php';
$pageSize = $config['page']['pageSize'];
$maxnum = $config['page']['maxnum'];
$url = './list_father_pages.php';

include DIR_CORE.'str_pages.php';

$pageStr= str_pages($sum, $pageSize, $maxnum, $url);

$pageNo = isset($_GET['pageNo']) ? $_GET['pageNo'] : 1;
$offset = ($pageNo-1)*$pageSize;
$sql = "select * from post left join user on post_owner = user_name order by post_time desc limit $offset,$pageSize";
$result = my_query($sql);


include DIR_VIEW.'list_father.html';