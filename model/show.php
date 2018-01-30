<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include '../init.php';
include DIR_CORE.'MySQLDB.php';

$post_id = $_GET['post_id'];
if(isset($_GET['action'])&&$_GET['action'] === 'show'){
    $sql = "update post set post_hits = post_hits+1 where post_id=$post_id";
    my_query($sql);
}
$pageNo = isset($_GET['pageNo'])?$_GET['pageNo']:1;
$sql = "select count(*) as sum from reply where rpl_post_id='$post_id'";
$sum = fetchColumn($sql);

$pageSize = 5;
$pageTotal = ceil($sum/$pageSize);

$pageStr = '';
$pageStr.='<a href="./show.php?action=show&post_id='.$post_id.'&pageNo=1">首页</a>';
$preNo = $pageNo==1?1:$pageNo-1;
$pageStr.='<a href="./show.php?action=show&post_id='.$post_id.'&pageNo='.$preNo.'">上一页</a>';

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
        $pageStr.='<a href="./show.php?&post_id='.$post_id.'&pageNo='.$i.'"><font color="red">'.$i.'</font></a>';
    else
        $pageStr.='<a href="./show.php?&post_id='.$post_id.'&pageNo='.$i.'">'.$i.'</a>';

$nextNo = $pageNo==$pageTotal?$pageTotal:$pageNo+1;
$pageStr.='<a href="./show.php?&post_id='.$post_id.'action=show&pageNo='.$nextNo.'">下一页</a>';
$pageStr.='<a href="./show.php?&post_id='.$post_id.'action=show&pageNo='.$pageTotal.'">尾页</a>';

$offset = ($pageNo-1)*$pageSize;

$sql = "select * from post left join user on post_owner = user_name where post_id = $post_id";
$row = fetchRow($sql);

$sql = "select * from reply left join user on rpl_user = user_name where rpl_post_id='$post_id' order by rpl_time limit $offset,$pageSize ";
$rpl_result = my_query($sql);

$num_sql = "select count(*) as rpl_num from reply where rpl_post_id = {$row['post_id']};";
$rpl_num = fetchColumn($num_sql);

include DIR_VIEW.'show.html';
