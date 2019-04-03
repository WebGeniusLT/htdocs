<?php 
// 验证登录
session_start(); 
if(!isset($_SESSION['online'])){
    echo "<script type='text/javascript'>window.location.href='../admin/adminLog.html';</script>";
    exit();
}
$processid = $_GET['thisID'];
include('conn.php');
$sql = "delete from users where user_id='$processid'";
$result = mysqli_query($conn,$sql);
if ($result) {
	echo "<script type='text/javascript'>alert('删除成功!');window.location.href='../userCenter/userinfo.php';</script>";
	exit;
}else{
	echo "<script type='text/javascript'>alert('删除失败!');window.location.href='../userCenter/userinfo.php';</script>";
	exit;
}
mysqli_close($conn);


 ?>