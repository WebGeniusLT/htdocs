<?php 
// 修改用户信息
session_start();
// 检测是否登录
if(!isset($_SESSION['userid'])){
    echo "<script type='text/javascript'>window.location.href='../sign_log/home.html#/log';</script>";
    exit();
}
$userid = $_SESSION['userid'];
$username = $_POST['user'];
$userbase = $_POST['userbase'];
$userperson = $_POST['userperson'];
$useremail = $_POST['useremail'];
$usertel = $_POST['usertel'];
$userdress = $_POST['userdress'];
// 连接数据库
include('conn.php');
// 修改数据
$sql = "update users set user_enterName='$username',user_baseName='$userbase',user_person='$userperson',user_email='$useremail',user_number='$usertel',user_dress='$userdress' where user_id='$userid'";
$result = mysqli_query($conn,$sql);
if ($result) {
	echo "<script type='text/javascript'>alert('修改成功!');window.location.href='../userCenter/userinfo.php';</script>";
    exit;
}else{
	echo "<script type='text/javascript'>alert('修改失败!');window.location.href='../userCenter/userinfo.php';</script>";
    exit;
}
mysqli_close($conn);
 ?>