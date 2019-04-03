<?php
/*连接数据库*/
$mysql_server_name = "localhost"; 
$mysql_username = "root";
$mysql_password = "root";
$mysql_database = "test_lontao";
$conn=mysqli_connect($mysql_server_name, $mysql_username,$mysql_password,$mysql_database);
if (!$conn) {
	die('数据库连接失败:'. mysqli_error());
}
?>