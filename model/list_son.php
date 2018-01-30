<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include '../init.php';
include DIR_CORE.'MySQLDB.php';

$pageNo = isset($_GET['pageNo'])?$_GET['pageNo']:1;

$keyword = escapeString($_GET['keyword']);
$sql = "select count(*) as sum from post where post_title like '%{$keyword}%';";
$sum =my_query($sql);
$pageSize = 5;
$pageTotal = ceil($sum/$pageSize);

$pageStr = '';
$pageStr.='<a href="./list_father_pages.php?pageNo=1">首页</a>';
$preNo = $pageNo==1?1:$pageNo-1;
$pageStr.='<a href="./list_father_pages.php?pageNo='.$preNo.'">上一页</a>';

if($pageNo<=3)
    $startNo=1;
else
    $startNo=$pageNo-2;
if($startNo>$pageTotal-4)
    $startNo=$pageTotal-4;
$endNo=$startNo+4;
if($endNo>$pageTotal)
    $endNo=$pageTotal;
if($startNo<1)
    $startNo=1;
    
for($i=$startNo;$i<=$endNo;$i++)
    if($i==$pageNo)
        $pageStr.='<a href="./list_father_pages.php?pageNo='.$i.'"><font color="red">'.$i.'</font></a>';
    else
        $pageStr.='<a href="./list_father_pages.php?pageNo='.$i.'">'.$i.'</a>';

$nextNo = $pageNo==$pageTotal?$pageTotal:$pageNo+1;
$pageStr.='<a href="./list_father_pages.php?pageNo='.$nextNo.'">下一页</a>';
$pageStr.='<a href="./list_father_pages.php?pageNo='.$pageTotal.'">尾页</a>';

$offset = ($pageNo-1)*$pageSize;
$sql = "select * from post left join user on post_owner = user_name where post_title like '%{$keyword}%' order by post_time desc limit $offset,$pageSize";
$result = my_query($sql);

include DIR_VIEW.'list_son.html';