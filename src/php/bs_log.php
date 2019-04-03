<?php 
// 登录
session_start([
    'cookie_lifetime' => 86400*7//session 存在7天
]);
// 注销登录
if($_GET['action'] == "logout"){
    unset($_SESSION['userbsid']);
    unset($_SESSION['userbs']);
    unset($_SESSION['nowbsid']);
    echo "<script type='text/javascript'>window.location.href='../sign_log/home.html#/log';</script>";
    exit;
}elseif (isset($_SESSION['userid'])) {
    echo "<script type='text/javascript'>alert('你已登录了基地帐号，不能继续登录商家帐号!');window.location.href='javascript:history.back(-1)';</script>";
    exit;

}
//获取用户输入
$user = $_POST['user'];
$password = $_POST['password'];
include('conn.php');
// 获取表单输入，防s q l注入
$user = mysqli_real_escape_string($conn,$user);
$password = mysqli_real_escape_string($conn,$password);
$password = MD5($_POST['password']);
$sql = "select * from userbs where userbs_enterName='$user' and userbs_password='$password'";
$result = mysqli_query($conn,$sql);// 解析数据查询语句
if (mysqli_num_rows($result) == 1) {
	// 获取id
	$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
	$_SESSION['userbs'] = $user;  //用户名
	$_SESSION['userbsid'] = $row['userbs_id'];  //用户id
	echo "<script type='text/javascript'>window.location.href='../userbsCenter/userinfo.php';</script>";
    exit;
}else{
	echo "<script type='text/javascript'>alert('用户名或密码错误!');window.location.href='javascript:history.back(-1)';</script>";
    exit;
}
mysqli_close($coon);
?>