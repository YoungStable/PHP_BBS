<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../init.php';
session_start();
if(isset($_COOKIE['user_id'])&&isset($_SESSION['user_info'])){
    jump('./post.php');
}
include DIR_VIEW.'login.html';