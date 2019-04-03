<?php 
// 验证管理员登录
session_start(); 
if(!isset($_SESSION['online'])){
    echo "<script type='text/javascript'>window.location.href='../admin/adminLog.html';</script>";
    exit();
}
$userstate = $_GET['thisID'];
include('conn.php');
$sql = "UPDATE users SET user_state=2
WHERE user_id='$userstate'";
$result = mysqli_query($conn,$sql);
if ($result) {
	echo "<script type='text/javascript'>alert('操作成功!');window.location.href='../admin/adminCenter.php';</script>";
	exit;
}else{
	echo "<script type='text/javascript'>alert('操作失败!');window.location.href='../admin/adminCenter.php';</script>";
	exit;
}
mysqli_close($conn);


 ?>