<?php 
// 登录
session_start([
    'cookie_lifetime' => 86400*7,//session 存在7天
]);
// 注销登录
if($_GET['action'] == "logout"){
    unset($_SESSION['userid']);
    unset($_SESSION['user']);
    unset($_SESSION['state']);
    unset($_SESSION['nowid']);
    echo "<script type='text/javascript'>window.location.href='../sign_log/home.html#/log';</script>";
    exit;
}elseif (isset($_SESSION['userbsid'])) {
    echo "<script type='text/javascript'>alert('你已登录了商家帐号，不能继续登录基地帐号!');window.location.href='javascript:history.back(-1)';</script>";
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
$sql = "select * from users where user_enterName='$user' and user_password='$password'";
$result = mysqli_query($conn,$sql);// 解析数据查询语句
if (mysqli_num_rows($result) == 1) {
	// 获取id
	$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
	$_SESSION['user'] = $user;  //用户名
	$_SESSION['userid'] = $row['user_id'];  //用户id
	$_SESSION['state'] = $row['user_state']; //审核状态
	echo "<script type='text/javascript'>window.location.href='../userCenter/userinfo.php';</script>";
    exit;
}else{
	echo "<script type='text/javascript'>alert('用户名或密码错误!');window.location.href='javascript:history.back(-1)';</script>";
    exit;
}
mysqli_close($coon);
?>