<?php
session_start(); 
if(!isset($_SESSION['userid'])){
    echo "<script type='text/javascript'>window.location.href='../sign_log/home.html#/log';</script>";
    exit();
}
include('conn.php');
$userid = $_SESSION['userid'];
$nowid = $_SESSION['nowid'];//获取当前的process_id
$seedtype = $_POST['seedtype'];//农产品的种类
$seedsource = $_POST['seedsource'];//种子的来源
$seedstate = $_POST['seedstate'];//种子的状态
$seedimg = $_FILES["seedimg"];//种子的图片
$sowdate = $_POST['sowdate'];//播种时间
$sowdress = $_POST['sowdress'];//播种地点
$sowweather = $_POST['sowweather'];//播种天气
$sowground = $_POST['sowground'];//播种土地环境
$sowimg = $_FILES["sowimg"];//播种图片
$growingstate = $_POST['growingstate'];//成长状态
$growingcalamity = $_POST['growingcalamity'];//成长遇到的灾害
$growingfertilizer = $_POST['growingfertilizer'];//成长时的施肥类型
$growingimg = $_FILES["growingimg"];//成长图片
$harvestdate = $_POST['harvestdate'];//收获时间
$sellingdress = $_POST['sellingdress'];//销售地点
$sellingmarket = $_POST['sellingmarket'];
$sellingtype = $_POST['sellingtype'];//销售类型
$sellingdate = $_POST['sellingdate'];
$sellingimg = $_FILES["sellingimg"];//销售图片
$video = $_FILES["video"];//视频
$seedimgName = $seedimg["name"];
$sowimgName = $sowimg["name"];
$growingimgName = $growingimg["name"];
$sellingimgName = $sellingimg["name"];
$videoName = $video["name"];
$sql = "select seed_image,sow_image,growing_image,selling_image,process_video from process where process_id='$nowid'";
$result = mysqli_query($conn,$sql);
if ($result) {
	$rows = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$img1 = $rows['seed_image'];
	$img2 = $rows['sow_image'];
	$img3 = $rows['growing_image'];
	$img4 = $rows['selling_image'];
	$video1 = $rows['process_video'];
}else{
	echo "<script type='text/javascript'>alert('编辑失败!');';</script>";
	exit;
}
//图片上传函数
function uploadImg($imgObj){
// 允许上传的图片后缀
	global $userid;
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
			if (file_exists("../upload/img/" .$userid."/". $imgObj["name"]))
			{
				echo "<script type='text/javascript'>alert('" . $imgObj["name"] . "文件已经存在。');</script>";
			}
			else
			{
				// 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
				move_uploaded_file($imgObj["tmp_name"], "../upload/img/" .$userid."/". $imgObj["name"]);
			}
		}
	}
	else
	{
		echo "<script type='text/javascript'>alert('图片类型不正确或者图片过大!');window.location.href='javascript:history.back(-1)';</script>";
	    exit;
	}
}
if ($seedimgName) {
    uploadImg($seedimg);
    $img1 = $seedimgName;
}
if ($sowimgName) {
    uploadImg($sowimg);
    $img2 = $sowimgName;
}
if ($growingimgName) {
    uploadImg($growingimg);
    $img3 = $growingimgName;
}
if ($sellingimgName) {
    uploadImg($sellingimg);
    $img4 = $sellingimgName;
}

if ($videoName) {
	$allowedExts = array("flv", "wmv", "rmvb", "mp4");
	$temp = explode(".", $video["name"]);
	$extension = end($temp);        // 获取文件后缀名
	if (($video["type"] == "video/flv")
	|| ($video["type"] == "video/wmv")
	|| ($video["type"] == "video/fmvb")
	|| ($video["type"] == "video/mp4")
	&& ($video["size"] < 20971520)    // 小于 20 mb
	&& in_array($extension, $allowedExts))
	{
		if ($video["error"] > 0)
		{
			echo "<script type='text/javascript'>alert('错误:" . $video["error"] . "');window.location.href='javascript:history.back(-1)';</script>";
		    exit;
		}
		else
		{
			//用户视频文件目录不存在则创建一个
			if (!file_exists('../upload/video/'.$userid)){ 
					mkdir ('../upload/video/'.$userid);
			}

			if (file_exists("../upload/video/".$userid.'/' . $video["name"]))
			{
				echo "<script type='text/javascript'>alert('" . $video["name"] . "文件已经存在。');</script>";
			}
			else
			{
				// 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
				move_uploaded_file($video["tmp_name"], "../upload/video/" .$userid."/". $video["name"]);
			}
		}
	}
	else
	{
		echo "<script type='text/javascript'>alert('视频类型不正确或者视频过大!');window.location.href='javascript:history.back(-1)';</script>";
	    exit;
	}
	$video1 = $videoName;
}

$sql = "UPDATE process SET seed_type='$seedtype', seed_source='$seedsource', seed_state='$seedstate', seed_image='$img1', sow_date='$sowdate', sow_dress='$sowdress', sow_weather='$sowweather', sow_ground='$sowground', sow_image='$img2', growing_state='$growingstate', growing_calamity='$growingcalamity', growing_fertilizer='$growingfertilizer', growing_image='$img3', harvest_date='$harvestdate', selling_dress='$sellingdress', selling_market='$sellingmarket', selling_type='$sellingtype', selling_date='$sellingdate', selling_image='$img4', process_video='$video1' WHERE process_id='$nowid'";
// 如果卖给了商机，给商机添加商品编号
if ($sellingmarket) {
	$check_query = mysqli_query($conn,"select bs_id from bs where bs_id='$nowid'");
	$row = mysqli_num_rows($check_query);
	if ($row < 1) {
		$sqlbs = "insert into bs (bs_id) values ('$nowid')";
		if (!mysqli_query($conn,$sqlbs)) {
			echo "<script type='text/javascript'>alert('数据编辑失败!');window.location.href='javascript:history.back(-1)';</script>";
		    exit;
		}
	}
}
if (mysqli_query($conn,$sql)) {
	echo "<script type='text/javascript'>alert('数据编辑成功!');window.location.href='../userCenter/userinfo.php';</script>";
    exit;
}else {
    echo "<script type='text/javascript'>alert('数据编辑失败!');window.location.href='javascript:history.back(-1)';</script>";
    exit;
}
mysqli_close($conn);

 ?>
