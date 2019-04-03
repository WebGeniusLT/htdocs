<?php 
// 获取用户查询编号
$userdata = $_GET['data'];
$len = strlen($userdata);
$pre = substr($userdata, 0, 6);
$post = substr($userdata, 6);
// 连接数据库
include('conn.php');
if ($len<7) {
	echo '{"sites":[{"fault":"搜索的编号至少7位！"}]}';
	exit;
}else{
	if($pre != "LTM526"){
		echo '{"sites":[{"fault":"搜索的编号前缀为LTM526！"}]}';
		exit;
	}else{
		$sql = "select * from process where process_id='$post'";
		$result = mysqli_query($conn,$sql);
		$num = mysqli_num_rows($result);
		if ($num == 0) {
			echo '{"sites":[{"fault":"你搜索的编号没有数据！"}]}';
			exit;
		}else{
			$jarr = array();
			while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
				$userid = $row['user_id'];
				$sql1 = "select user_id,user_baseName,user_person,user_email,user_number,user_dress from users where user_id='$userid'";
				$result1 = mysqli_query($conn,$sql1);
				$rows = mysqli_fetch_array($result1,MYSQLI_ASSOC);
				array_push($jarr,$row);
				array_push($jarr,$rows);
			}
			$str=json_encode($jarr,JSON_UNESCAPED_UNICODE);//将数组进行json编码
			$str1 = '{"sites":'.$str.'}';
			echo $str1;
		}
	}
}
mysqli_close($conn);

 ?>