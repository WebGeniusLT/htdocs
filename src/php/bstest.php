<?php
// 验证登录
session_start(); 
if(!isset($_SESSION['userbsid'])){
    echo "<script type='text/javascript'>window.location.href='../sign_log/home.html#/log';</script>";
    exit();
}
$userbsid = $_SESSION['userbsid'];
header("Content-type:text/html;charset=utf-8");//字符编码设置  
include('conn.php');
$sql = "select bs_id,bs_type,creating_time from bs where userbs_id='$userbsid'";
$result = mysqli_query($conn,$sql);
$num = mysqli_num_rows($result);
if ($num == 0) {
    echo '{"sites":[{"creating_time":"没有数据"}]}';
    exit;
}else{
	$jarr = array();
	while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
		array_push($jarr,$row);
	}
	$str=json_encode($jarr,JSON_UNESCAPED_UNICODE);//将数组进行json编码
	$str1 = '{"sites":'.$str.'}';
	echo $str1;
}
mysqli_close($conn);
 ?>