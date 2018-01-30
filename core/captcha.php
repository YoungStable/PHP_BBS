<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$img = imagecreatetruecolor(170, 40);
$backcolor = imagecolorallocate($img, mt_rand(200, 255), mt_rand(150, 255), mt_rand(200, 255));
imagefill($img, 0, 0, $backcolor);

$arr = array_merge(range(0,9),range('a','z'),range('A','Z'));
shuffle($arr);
$rand_key = array_rand($arr,4);
$str='';

foreach ($rand_key as $key){
    $str.=$arr[$key];
}

@session_start();
$_SESSION['captcha'] = $str;

$span = floor(170/(4+1));
for($i=1;$i<=4;$i++){
    $fore_color =  imagecolorallocate($img, mt_rand(200, 255), mt_rand(0, 100), mt_rand(0, 80));
    imagestring($img, 5, $i*$span, 12, $str[$i-1], $fore_color);
}

for($i=1;$i<=6;$i++){
    $line_color = imagecolorallocate($img, mt_rand(0, 150), mt_rand(30, 250), mt_rand(200, 255));
    imageline($img, mt_rand(0, 169), mt_rand(0, 39), mt_rand(0, 169),mt_rand(0, 39), $line_color);
}

for($i=1;$i<=170*40*0.02;$i++){
    $pix_color = imagecolorallocate($img, mt_rand(100, 150), mt_rand(0, 120), mt_rand(0, 255));
    imagesetpixel($img, mt_rand(0, 169), mt_rand(0, 39), $pix_color);
}

header('content-type:image/png');
ob_clean();
imagepng($img);

imagedestroy($img);






