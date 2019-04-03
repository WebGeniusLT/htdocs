<?php
session_start(); 
if(!isset($_SESSION['userbsid'])){
    echo "<script type='text/javascript'>window.location.href='../sign_log/home.html#/log';</script>";
    exit();
}
include('conn.php');
$nowbsid = $_SESSION['nowbsid'];
$userbsid = $_SESSION['userbsid'];
$bssource = $_POST['bssource'];//商品来源
$bstype = $_POST['bstype'];//商品种类
$bsindate = $_POST['bsindate'];//商品购买时间
$bsdress = $_POST['bsdress'];//商品销售地点
$bsoutdate = $_POST['bsoutdate'];//商品售卖时间
$bsprice = $_POST['bsprice'];//商品售卖价格
$bsimg = $_FILES['bsimg'];//获取图片对象
$bsimgName = $bsimg['name'];//图片名称
$sql = "select bs_image from bs where bs_id='$nowbsid'";
$result = mysqli_query($conn,$sql);
if ($result) {
	$rows = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$img1 = $rows['bs_image'];
}else{
	echo "<script type='text/javascript'>alert('编辑失败!');</script>";
	exit;
}
//图片上传函数
function uploadImg($imgObj){
// 允许上传的图片后缀
	global $userbsid;
	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$temp = explode(".", $imgObj["name"]);
	$extension = end($temp);     // 获取文件后缀名
	if ((($imgObj["type"] == "image/gif")
	|| ($imgObj["type"] == "image/jpeg")
	|| ($imgObj["type"] == "image/jpg")
	|| ($imgObj["type"] == "image/pjpeg")
	|| ($imgObj["type"] == "image/x-png")
	|| ($imgObj["type"] == "image/png"))
	&& ($imgObj["size"] < 204800)   // 小于 200 kb
	&& in_array($extension, $allowedExts))
	{
		if ($imgObj["error"] > 0)
		{
		    echo "<script type='text/javascript'>alert('错误:" . $imgObj["error"] . "');window.location.href='javascript:history.back(-1)';</script>";
		    exit;
		}
		else
		{
			// 判断当期目录下的 upload 目录是否存在该文件
			// 如果没有 upload 目录，你需要创建它，upload 目录权限为 777
			if (file_exists("../upload/img/" .$userbsid."/". $imgObj["name"]))
			{
				echo "<script type='text/javascript'>alert('" . $imgObj["name"] . "文件已经存在。');</script>";
			}
			else
			{
				// 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
				move_uploaded_file($imgObj["tmp_name"], "../upload/img/" .$userbsid."/". $imgObj["name"]);
			}
		}
	}
	else
	{
		echo "<script type='text/javascript'>alert('图片类型不正确或者图片过大!');window.location.href='javascript:history.back(-1)';</script>";
	    exit;
	}
}
if ($bsimgName) {
    uploadImg($bsimg);
    $img1 = $bsimgName;
}
$sql = "UPDATE bs SET bs_source='$bssource', bs_type='$bstype', bs_indate='$bsindate', bs_dress='$bsdress', bs_outdate='$bsoutdate', bs_price='$bsprice', bs_image='$img1' WHERE bs_id='$nowbsid'";
// 如果卖给了商机，给商机添加商品编号
if (mysqli_query($conn,$sql)) {
	echo "<script type='text/javascript'>alert('数据编辑成功!');window.location.href='../userbsCenter/userinfo.php';</script>";
    exit;
}else {
    echo "<script type='text/javascript'>alert('数据编辑失败!');window.location.href='javascript:history.back(-1)';</script>";
    exit;
}
mysqli_close($conn);

 ?>
