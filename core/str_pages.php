<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function str_pages($sum,$pageSize,$maxnum,$url){
    $pageNo = isset($_GET['pageNo']) ? $_GET['pageNo'] : 1;
    $pageTotal = ceil($sum / $pageSize);

    $pageStr = '';
    $pageStr .= '<a href="./list_father_pages.php?pageNo=1">首页</a>';
    $preNo = $pageNo == 1 ? 1 : $pageNo - 1;
    $pageStr .= '<a href="./list_father_pages.php?pageNo=' . $preNo . '">上一页</a>';

    if ($pageNo <= 3)
        $startNo = 1;
    else
        $startNo = $pageNo - 2;
    if ($startNo > $pageTotal - $maxnum+1)
        $startNo = $pageTotal - $maxnum+1;
    $endNo = $startNo + $maxnum-1 ;
    if ($endNo > $pageTotal)
        $endNo = $pageTotal;
    if ($startNo < 1)
        $startNo = 1;

    for ($i = $startNo; $i <= $endNo; $i++)
        if ($i == $pageNo)
            $pageStr .= '<a href="{$url}?pageNo=' . $i . '"><font color="red">' . $i . '</font></a>';
        else
            $pageStr .= '<a href="{$url}?pageNo=' . $i . '">' . $i . '</a>';

    $nextNo = $pageNo == $pageTotal ? $pageTotal : $pageNo + 1;
    $pageStr .= '<a href="./list_father_pages.php?pageNo=' . $nextNo . '">下一页</a>';
    $pageStr .= '<a href="./list_father_pages.php?pageNo=' . $pageTotal . '">尾页</a>';
    
    return $pageStr;
}
