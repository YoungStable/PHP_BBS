<?PHP
header("content-type:text/html;charset=utf-8");

define("DIR_ROOT", str_replace('\\','/',__DIR__).'/');
define("DIR_CONFIG", DIR_ROOT.'config/');
define("DIR_CORE",DIR_ROOT.'core/');
define("DIR_MODEL",DIR_ROOT.'model/');
define("DIR_VIEW",DIR_ROOT.'view/');
define("DIR_PUBLIC",'/public');
define("DIR_UPLOADS",DIR_ROOT.'uploads/');

function jump($url,$msg=NULL,$time=2){
    if($msg){
        header("refresh:$time;url=$url");
        die("$msg");    
    }
    else{
        header("location:$url");
        die;
    }
}

function escapeString($str){
    return addslashes(strip_tags(trim($str)));
}
    
function is_login(){
    @session_start();
    if(!isset($_SESSION['user_info'])){
        jump('./login.php', '请您先登陆后再进行操作');
    }
}