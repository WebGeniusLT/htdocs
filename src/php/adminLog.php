<?php 
// 管理员登录
session_start();
if($_GET['action'] == "logout"){
    unset($_SESSION['online']);
    echo "<script type='text/javascript'>window.location.href='../admin/adminLog.html';</script>";
    exit;
}
$user = $_POST['user'];
$password = $_POST['password'];
$user = md5($user);
$password = md5($password);
if ($user != "f3c91556f2e2e238ef59b6c67ceda913") {
	echo "<script type='text/javascript'>alert('用户名错误!');window.location.href='javascript:history.back(-1)';</script>";
    exit;
}
if ($password != "91d0a659364c8902ff3352594da6e1da") {
	echo "<script type='text/javascript'>alert('密码错误!');window.location.href='javascript:history.back(-1)';</script>";
    exit;
}else{
	$_SESSION['online'] =1;
	echo "<script type='text/javascript'>window.location.href='../admin/adminCenter.php';</script>";
	exit;
}

 ?>