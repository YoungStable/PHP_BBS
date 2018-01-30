<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*
 * 实现文件上传
 * @param array $file 上传文件的信息(即从$_FILE[]中获得的一维数组)
 * @param array $allow 允许上传的文件类型
 * @param string & $error 引用传递，记录错误信息
 * @param string $path 上传文件的到哪个路径
 * @param int $maxsize = 1048576 上传文件允许的最大大小
 * @return false|$newname 上传失败返回false，成功则返回文件新名字
 */

function upload($file, $allow, &$error, $path, $maxsize = 1048576) {
    switch ($file['error']) {
        case 1: $error = '文件大小超出限制！';
            return false();
        case 2: $error = '超出浏览器浏览器规定大小！';
            return false;
        case 3: $error = '文件上传不完整!';
            return false;
        case 4: $error = '没有文件被上传！请选择要上传的文件';
            return false;
        case 6:
        case 7: $error = '抱歉，服务器繁忙请稍候再试！';
            return false;
    }
    if ($file['size'] > 1048576) {
        $error = '上传文件大小超出业务限制！';
        return false;
    }

    if (!in_array($file['type'], $allow)) {
        $error = '文件类型不符合业务限制！';
        return false;
    }

    $newname = randName($file['name']);

    $destination =$path.'/' .$newname;
    $result = move_uploaded_file($file['tmp_name'], $destination);
    if ($result) {
        return $newname;
    } else {
        $error = '上传失败';
        return false;
    }
}

function randName($filename) {
    $newname = date('YmdHis');
    $str = '0987654321';
    for ($i = 0; $i < 6; $i++) {
        $newname .= $str[mt_rand(0, strlen($str) - 1)];
    }
    $newname .= strrchr($filename, '.');
    return $newname;
}
