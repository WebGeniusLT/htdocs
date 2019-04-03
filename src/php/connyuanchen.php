<?php
/*连接数据库*/
$mysql_server_name = "127.0.0.1"; 
$mysql_username = "longtao";
$mysql_password = "longtao";
$mysql_database = "bs";
$conn=mysqli_connect($mysql_server_name, $mysql_username,$mysql_password,$mysql_database);
if (!$conn) {
	die('数据库连接失败:'. mysqli_error());
}
?>