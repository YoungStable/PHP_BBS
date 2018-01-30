<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$img = imagecreatetruecolor(170, 40);
$backcolor = imagecolorallocate($img, mt_rand(200, 255), mt_rand(150, 255), mt_rand(200, 255));
imagefill($img, 0, 0, $backcolor);

$str_cn = "把里面的代码复制进来由于验证码是在中产生又中进行验证所以需要不同脚本之间的数据共享应该在中将随机产生的验证码字符串放在变量汇总所谓干扰点就是像素";
$str='';

for($i=1;$i<=4;$i++){
    $num = strlen($str_cn)/3;
    $pos = 3*mt_rand(0, $num-1);
    $str.= substr($str_cn, $pos,3);
}

@session_start();
$_SESSION['captcha'] = $str;

$span = floor(170/(4+1));
for($i=1;$i<=4;$i++){
    $fore_color =  imagecolorallocate($img, mt_rand(200, 255), mt_rand(0, 100), mt_rand(0, 80));
    imagettftext($img, 20, mt_rand(-60, 60), $i*$span, 30, $fore_color, './STHUPO.ttf', substr($str, ($i-1)*3,3));
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






