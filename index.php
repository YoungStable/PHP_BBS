<?PHP
include './init.php';

session_start();
if(isset($_COOKIE['user_id'])){
    include DIR_CORE.'MySQLDB.php';
    $user_id = $_COOKIE['user_id'];
    $sql = "select * from user where user_id = $user_id";
    $result = my_query($sql);
    $row = mysql_fetch_assoc($result);
    $_SESSION['user_info'] = $row;
}
include DIR_VIEW.'index.html';