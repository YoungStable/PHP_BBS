<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../init.php';

setcookie('user_id','', time()-1,'/');
session_start();
$_SESSION = array();
session_destroy();
jump('../index.php');