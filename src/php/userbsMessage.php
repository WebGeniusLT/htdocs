<?php 
// 修改用户信息
session_start();
// 检测是否登录
if(!isset($_SESSION['userbsid'])){
    echo "<script type='text/javascript'>window.location.href='../sign_log/home.html#/log';</script>";
    exit();
}
$userbsid = $_SESSION['userbsid'];
$username = $_POST['user'];
$userbstype = $_POST['userbstype'];
$userbase = $_POST['userbase'];
$userperson = $_POST['userperson'];
$useremail = $_POST['useremail'];
$usertel = $_POST['usertel'];
$userdress = $_POST['userdress'];
// 连接数据库
include('conn.php');
// 修改数据
$sql = "update userbs set userbs_enterName='$username',userbs_type='$userbstype', userbs_bsName='$userbase',userbs_person='$userperson',userbs_email='$useremail',userbs_number='$usertel',userbs_dress='$userdress' where userbs_id='$userbsid'";
$result = mysqli_query($conn,$sql);
if ($result) {
	echo "<script type='text/javascript'>alert('修改成功!');window.location.href='../userbsCenter/userinfo.php';</script>";
    exit;
}else{
	echo "<script type='text/javascript'>alert('修改失败!');window.location.href='../userbsCenter/userinfo.php';</script>";
    exit;
}
mysqli_close($conn);
 ?>