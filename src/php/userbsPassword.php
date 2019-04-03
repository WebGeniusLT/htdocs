<?php 
// 修改密码
session_start();
// 检测是否登录
if(!isset($_SESSION['userbsid'])){
    echo "<script type='text/javascript'>window.location.href='../sign_log/home.html#/log';</script>";
    exit();
}
$userid = $_SESSION['userbsid'];
$newPassword = MD5($_POST['newPassword']);
$oldPassword = MD5($_POST['oldPassword']);
include('conn.php');
$sql = "select userbs_password from userbs where userbs_id='$userid'";
$result = mysqli_query($conn,$sql);
$rows = mysqli_fetch_array($result,MYSQLI_ASSOC);
if ($rows['userbs_password'] == $oldPassword) {
	$result1 = mysqli_query($conn,"update userbs set userbs_password='$newPassword' where userbs_id='$userid'");
	if ($result1) {
		echo "<script type='text/javascript'>alert('修改成功!');window.location.href='../userbsCenter/userinfo.php';</script>";
	    exit;
	}else{
		echo "<script type='text/javascript'>alert('修改失败!');window.location.href='../userbsCenter/userinfo.php';</script>";
    exit;
	}
}else{
	echo "<script type='text/javascript'>alert('修改失败!');window.location.href='../userbsCenter/userinfo.php';</script>";
    exit;
}
mysqli_close($conn);

 ?>