<?php
$user = $_POST['user'];
$password = $_POST['password'];
$baseName = $_POST['baseName'];
$bstype = $_POST['bstype'];
$person = $_POST['person'];
$email= $_POST['email'];
$tel = $_POST['tel'];
$dress = $_POST['dress'];
include('conn.php');
//检测用户名是否已经存在
$check_query = mysqli_query($conn,"select userbs_id from userbs where userbs_enterName='$user'");
$rows = mysqli_num_rows($check_query);
if ($rows>0) {
	echo "<script type='text/javascript'>alert('用户名已存在');window.location.href='javascript:history.back(-1)';</script>";
    exit;
}
$password = MD5($password);
$sql = "INSERT INTO userbs (userbs_enterName,userbs_password,userbs_type,userbs_bsName,userbs_person,userbs_email,userbs_number,userbs_dress)VALUES('$user','$password','$bstype','$baseName','$person','$email','$tel','$dress')";
//写入数据
if(mysqli_query($conn,$sql)){
	echo "<script type='text/javascript'>alert('注册成功,快去登录吧!');window.location.href='../sign_log/home.html#/log';</script>";
    exit;
} else {
    echo "<script type='text/javascript'>alert('注册失败,重新注册!');window.location.href='javascript:history.back(-1)';</script>";
    exit;
}
mysqli_close($conn);
?>