<?php 
session_start(); 
if(!isset($_SESSION['userid'])){
    echo "<script type='text/javascript'>window.location.href='../sign_log/home.html#/log';</script>";
    exit();
}
$processid = $_GET["thisID"];
$_SESSION['nowid'] = $processid;
header("Content-type:text/html;charset=utf-8");//字符编码设置
include('conn.php');
$sql = "select * from process where process_id='$processid'";
$result = mysqli_query($conn,$sql);
if (!$result) {
    echo "<script type='text/javascript'>alert('请求数据失败');';</script>";
	    exit;
}
$jarr = array();
while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
	array_push($jarr,$row);
}
$str=json_encode($jarr,JSON_UNESCAPED_UNICODE);//将数组进行json编码
$str1 = '{"codes":'.$str.'}';
echo $str1;
mysqli_close($conn);

 ?>