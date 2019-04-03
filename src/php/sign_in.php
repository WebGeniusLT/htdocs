<?php
$user = $_POST['user'];
$password = $_POST['password'];
$baseName = $_POST['baseName'];
$person = $_POST['person'];
$email= $_POST['email'];
$tel = $_POST['tel'];
$dress = $_POST['dress'];
include('conn.php');
//检测用户名是否已经存在
$check_query = mysqli_query($conn,"select user_id from users where user_enterName='$user'");
$rows = mysqli_num_rows($check_query);
if ($rows>0) {
	echo "<script type='text/javascript'>alert('用户名已存在');window.location.href='javascript:history.back(-1)';</script>";
    exit;
}
$password = MD5($password);
$sql = "INSERT INTO users (user_enterName,user_password,user_baseName,user_person,user_email,user_number,user_dress)VALUES('$user','$password','$baseName','$person','$email','$tel','$dress')";
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