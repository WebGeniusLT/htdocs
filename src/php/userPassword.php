<?php 
// 修改密码
session_start();
// 检测是否登录
if(!isset($_SESSION['userid'])){
    echo "<script type='text/javascript'>window.location.href='../sign_log/home.html#/log';</script>";
    exit();
}
$userid = $_SESSION['userid'];
$newPassword = MD5($_POST['newPassword']);
$oldPassword = MD5($_POST['oldPassword']);
include('conn.php');
$sql = "select user_password from users where user_id='$userid'";
$result = mysqli_query($conn,$sql);
$rows = mysqli_fetch_array($result,MYSQLI_ASSOC);
if ($rows['user_password'] == $oldPassword) {
	$result1 = mysqli_query($conn,"update users set user_password='$newPassword' where user_id='$userid'");
	if ($result1) {
		echo "<script type='text/javascript'>alert('修改成功!');window.location.href='../userCenter/userinfo.php';</script>";
	    exit;
	}else{
		echo "<script type='text/javascript'>alert('修改失败!');window.location.href='../userCenter/userinfo.php';</script>";
    exit;
	}
}else{
	echo "<script type='text/javascript'>alert('修改失败!');window.location.href='../userCenter/userinfo.php';</script>";
    exit;
}
mysqli_close($conn);

 ?>