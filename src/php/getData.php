<?php 
// 验证管理员登录
session_start(); 
if(!isset($_SESSION['online'])){
    echo "<script type='text/javascript'>window.location.href='../admin/adminLog.html';</script>";
    exit();
}
header("Content-type:text/html;charset=utf-8");//字符编码设置 
$userstate = $_GET['state'];
include('conn.php');
$sql = "select * from users where user_state='$userstate'";
$result = mysqli_query($conn,$sql);
$num = mysqli_num_rows($result);
if ($num == 0) {
    echo '{"sites":[{"no_data":"没有数据"}]}';
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