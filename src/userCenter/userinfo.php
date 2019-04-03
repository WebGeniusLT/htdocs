<?php
session_start();

//检测是否登录，若没登录则转向登录界面
if(!isset($_SESSION['userid'])){
    echo "<script type='text/javascript'>window.location.href='../sign_log/home.html#/log';</script>";
    exit();
}elseif ($_SESSION['state'] == 1) {
	echo "<script type='text/javascript'>alert('基地正在审核中!');window.location.href='../sign_log/home.html#/log';</script>";
	exit;
}elseif ($_SESSION['state'] == 0) {
	echo "<script type='text/javascript'>alert('基地审核失败，请重新申请!');window.location.href='../sign_log/home.html#/sign';</script>";
	exit;
}
//包含数据库连接文件
include('../php/conn.php');
$today = date("Y-m-d");
$userid = $_SESSION['userid']; //用户id
$username = $_SESSION['user']; //用户名
$userstate = $_SESSION['state']; //用户审核状态
$sql = "select * from users where user_id='$userid'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
$username = $row['user_enterName'];
$userbase = $row['user_baseName']; //用户基地名字
$userperson = $row["user_person"]; //基地负责人
$useremail = $row['user_email']; //用户邮箱
$usertel = $row['user_number']; //用户电话
$userdress = $row['user_dress']; //基地地址
$usertime = $row['user_date']; //注册时间
?>
<!DOCTYPE html>
<html lang="en" ng-app="htmlModule">
<head>
	<meta charset="UTF-8">
	<title>用户中心</title>
	<link href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="view/userCenter.css">
</head>
<body>
	<!-- 导航栏 -->
	<nav class="navbar navbar-default" role="navigation">
  		<div class="container-fluid">
		    <div class="navbar-header">
		    	<a class="navbar-brand" href="../../index.php"><img class="logo" src="../img/logo.png"></a>
		    </div>
			    <ul class="nav navbar-nav navbar-right">
			    	<li><a href="userinfo.php"><span class="glyphicon glyphicon-user"></span> <?php echo $username; ?></a></li>
				    <li><a href="../php/log_in.php?action=logout"><span class="glyphicon glyphicon-log-out"></span> 退出</a></li>
			    </ul>
		</div>
	</nav>
	<!-- 标签页 -->
	<div class="nav-all">
		<div class="nav-top">
			<ul id="myTab" class="nav nav-pills nav-justified">
				<li class="active">
					<a href="#userCenter" data-toggle="tab">基地用户信息</a>
				</li>
				<li>
					<a href="#userHouse" data-toggle="tab">基地溯源记录</a>
				</li>
			</ul>
		</div>
	<!-- 标签页之后的内容 -->
		<div class="nav-content">
			<div id="myTabContent" class="tab-content">
			<!-- 用户中心 -->
				<div class="tab-pane fade in active" id="userCenter" ng-controller="userCenterCtl">
					<div class="user-house">
						<form action="../php/userMessage.php" method="post" name="userForm">
						<!-- 用户名 -->
							<div class="userCtl">
								<span class="user-message">用户名:</span>
								<span ng-show="btn.userShow" class="user-data"><?php echo $username ?></span>
								<input ng-show="!btn.userShow" class="user-box" type="text" name="user" value="<?php echo $username ?>" pattern="[A-z][A-z0-9]{3,14}" title="登录名以字母开头，至少4位，不超过15位" required="true">
							</div>
							<!-- 用户基地名字 -->
							<div class="userCtl">
								<span class="user-message">用户基地名字:</span>
								<span ng-show="btn.userShow" class="user-data"><?php echo $userbase ?></span>
								<input ng-show="!btn.userShow" class="user-box" type="text" name="userbase" value="<?php echo $userbase ?>" pattern="^[^\s]+$" title="不能有空格" required="true">
							</div>
							<!-- 基地负责人 -->
							<div class="userCtl">
								<span class="user-message">基地负责人:</span>
								<span ng-show="btn.userShow" class="user-data"><?php echo $userperson ?></span>
								<input ng-show="!btn.userShow" class="user-box" type="text" name="userperson" value="<?php echo $userperson ?>" pattern="^[^\s]+$" title="不能有空格" required="true">
							</div>
							<!-- 用户邮箱 -->
							<div class="userCtl">
								<span class="user-message">负责人邮箱:</span>
								<span ng-show="btn.userShow" class="user-data"><?php echo $useremail ?></span>
								<input ng-show="!btn.userShow" class="user-box" type="email" name="useremail" value="<?php echo $useremail ?>" required="true">
							</div>
							<!-- 用户电话 -->
							<div class="userCtl">
								<span class="user-message">联系人电话:</span>
								<span ng-show="btn.userShow" class="user-data"><?php echo $usertel ?></span>
								<input ng-show="!btn.userShow" class="user-box" type="text" name="usertel" value="<?php echo $usertel ?>" pattern="^[1][34578][0-9]{9}$" title="请输入11位电话号码" required="true">
							</div>
							<!-- 基地地址 -->
							<div class="userCtl">
								<span class="user-message">基地地址:</span>
								<span ng-show="btn.userShow" class="user-data"><?php echo $userdress ?></span>
								<input ng-show="!btn.userShow" class="user-box" type="text" name="userdress" value="<?php echo $userdress ?>" pattern="^[^\s]+$" title="不能有空格" required="true">
							</div>
							<!-- 注册时间 -->
							<div class="userCtl">
								<span class="user-message">注册时间:</span>
								<span class="user-data"><?php echo $usertime ?></span>
							</div>
							<a class="btn-blue" style="margin-left: 180px;" href="#" ng-show="btn.userShow" ng-click="userChange()">修改用户信息</a>
							<input class="btn-yellow" ng-show="!btn.userShow" type="submit" name="保存" value="保存">
							<a class="btn-blue" style="margin-left: 20px;" href="#" ng-show="!btn.userShow" ng-click="cancel()">取消</a>	
							<span ng-show="btn.userShow" ng-click="btnOn()" class="btn-switch glyphicon glyphicon-pencil">修改密码</span>						
						</form>
						
						<!-- 修改密码 -->
						<form action="../php/userPassword.php" method="post">
							<div ng-show="btn.changePass" class="changePass">
								<!-- 输入原密码 -->
								<div class="userCtl">
									<span class="user-message">原密码:</span>
									<input class="user-box" type="password" ng-model="oldpas" name="oldPassword" pattern="[A-z][A-z0-9]{3,14}" placeholder="输入旧密码" title="登录名以字母开头，至少4位，不超过15位" required="true">
								</div>
								<!-- 输入新密码 -->
								<div class="userCtl">
									<span class="user-message">输入新密码:</span>
									<input class="user-box" type="password" name="newPassword" ng-model="pas" placeholder="密码最多15位，不能有空格" pattern="^[^\s]{1,15}$" title="密码最多15位，不能有空格" required="true">
								</div>
								<span style="color: red;margin-left: 310px;" ng-show="pas==oldpas">新密码不能和原密码相同。</span><br>
								<!-- 再次确认密码 -->
								<div class="userCtl">
									<span class="user-message">确认密码:</span>
									<input class="user-box" type="password" ng-model="repas" placeholder="再次输入密码" required="true"">
								</div>
								<span style="color: red;margin-left: 310px;" ng-show="pas!=repas">两次密码不一致。</span><br>
								<input  class="btn-yellow" type="submit" ng-disabled="pas==oldpas||pas!=repas" value="确认修改">
								<a ng-click="btnOff()" class="btn-blue" style="margin-left: 20px;" href="#" >取消修改</a>	
							</div>
						</form>
					</div>
				</div>
				<!-- 用户仓库 -->
				<div class="tab-pane fade" id="userHouse" ng-controller="userBaseCtl">
					<button type="button" class="btn btn-default" ng-click="processOn()" style="margin-left: 800px;"><span class="glyphicon glyphicon-plus"></span> 添加一条记录</button>
					<div class="userWare" ng-show="btn.processbtn">
						<form class="form-horizontal" action="../php/addProcess.php" enctype="multipart/form-data" method="post" role="form">
							<span style="margin: 0 0 5px 50px;font-size: 18px;display: inline-block;">添加溯源记录，后带<span style="color: red;">＊</span>的选项为必填</span><br>
							<span style="font-size: 12px;color: gray;margin: 0 0 20px 50px;display: inline-block;">图片格式仅限("gif", "jpeg", "jpg", "png")，不超过200kb；视频格式仅限("flv", "wmv", "rmvb", "mp4")，不超过20mb（上传视频需要部分时间，请耐心等待）。（上传相同文件名或者服务器上存在的文件，系统将会提醒，但用户添加的记录仍然生效）</span><br>
							<!-- 农产品的种类 -->
							<div class="process-all">
								<span class="process-title">农产品的种类:</span>
								<div class="process-data">
									<input type="text" name="seedtype" required="true">
								</div>
								<span style="color: red;">＊</span>
							</div><br>
							<!-- 种子阶段 -->
							<span class="process-stage">种子阶段</span>
							<hr class="process-line"><!-- 分割线 -->
							<!-- 种子来源 -->
							<div class="process-all">
								<span class="process-title">种子的来源:</span>
								<div class="process-data">
									<input type="text" name="seedsource" required="true">
								</div>
								<span style="color: red;">＊</span>
							</div>
							<!-- 种子状态 -->
							<div class="process-all">
								<span class="process-title">种子的状态:</span>
								<div class="process-data">
									<input type="text" name="seedstate">
								</div>
							</div>
							<!-- 种子图片 -->
							<div class="process-all">
								<span class="process-title">种子的图片:</span>
								<div class="process-data" style="border-width: 0">
									<span class="glyphicon glyphicon-folder-open"></span>
									<input type="file" style="width: 230px" name="seedimg" required="true">
								</div>
								<span style="color: red;">＊</span>
							</div><br>
							<!-- 播种阶段 -->
							<span class="process-stage">播种阶段</span>
							<hr class="process-line"><!-- 分割线 -->
							<!-- 播种时间 -->
							<div class="process-all">
								<span class="process-title">播种的时间:</span>
								<div class="process-data">
									<input type="date" max="<?php echo $today ?>" name="sowdate" required="true">
								</div>
								<span style="color: red;">＊</span>
							</div>
							<!-- 播种地点 -->
							<div class="process-all">
								<span class="process-title">播种地点:</span>
								<div class="process-data">
									<input type="text" name="sowdress">
								</div>
							</div>
							<!-- 播种天气 -->
							<div class="process-all">
								<span class="process-title">播种天气:</span>
								<div class="process-data">
									<input type="text" name="sowweather">
								</div>
							</div>
							<!-- 播种的土地环境 -->
							<div class="process-all">
								<span class="process-title">播种的土地环境:</span>
								<div class="process-data">
									<input type="text" name="sowground">
								</div>
							</div>
							<!-- 播种时的图片 -->
							<div class="process-all">
								<span class="process-title">播种时图片:</span>
								<div class="process-data" style="border-width: 0">
									<span class="glyphicon glyphicon-folder-open"></span>
									<input type="file" style="width: 230px" name="sowimg" value="上传图片" required="true">
								</div>
								<span style="color: red;">＊</span>
							</div><br>
							<!-- 成长阶段 -->
							<span class="process-stage">成长阶段</span>
							<hr class="process-line"><!-- 分割线 -->
							<!-- 成长时的状态 -->
							<div class="process-all">
								<span class="process-title">成长时的状态:</span>
								<div class="process-data">
									<input type="text" name="growingstate" required="true">
								</div>
								<span style="color: red;">＊</span>
							</div>
							<!-- 成长时受到的灾害 -->
							<div class="process-all">
								<span class="process-title">成长时受到的灾害:</span>
								<div class="process-data">
									<input type="text" name="growingcalamity">
								</div>
							</div>
							<!-- 成长时施肥类型 -->
							<div class="process-all">
								<span class="process-title">成长时施肥类型:</span>
								<div class="process-data">
									<input type="text" name="growingfertilizer">
								</div>
							</div>
							<!-- 成长时的图片 -->
							<div class="process-all">
								<span class="process-title">成长时图片:</span>
								<div class="process-data" style="border-width: 0">
									<span class="glyphicon glyphicon-folder-open"></span>
									<input type="file" style="width: 230px" name="growingimg" required="true">
								</div>
								<span style="color: red;">＊</span>
							</div><br>
							<!-- 收获销售阶段 -->
							<span class="process-stage">收获销售阶段</span>
							<hr class="process-line"><!-- 分割线 -->
							<!-- 收获时间 -->
							<div class="process-all">
								<span class="process-title">收获的时间:</span>
								<div class="process-data">
									<input type="date" max="<?php echo $today ?>" name="harvestdate" required="true">
								</div>
								<span style="color: red;">＊</span>
							</div>
							<!-- 上传视频 -->
							<div class="process-all">
								<span class="process-title">视频:</span>
								<div class="process-data" style="border-width: 0">
									<span class="glyphicon glyphicon-folder-open"></span>
									<input type="file" style="width: 230px" name="video">
								</div>
							</div><br>
							<input  class="btn-yellow" style="margin-left: 300px" type="submit" value="确认提交">
								<a ng-click="processOff()" class="btn-blue" style="margin-left: 20px;" href="#" >取消提交</a>
						</form>
					</div>
					<!-- 罗列用户上传的数据 -->
					<div style="width: 800px;margin: 20px 0 0 114px;" ng-show="!btn.processbtn && btn.processData">
					<!-- 搜索框 -->
						<div class="process-all">
							<span class="process-title">筛选记录:</span>
							<div class="process-data">
								<input type="text" ng-model="test">
							</div>
						</div><br>
						<!-- 信息标题 -->
						<div style="background-color: #f9f9f9;text-align: center;">
							<span class="up-data1">编号</span>
							<span class="up-data2">种类</span>
							<span class="up-data3">上传时间</span>
							<span class="up-data4">删除记录</span>
							<span class="up-data5">编辑</span>
							<hr>
						</div>
						<!-- 没有数据的显示 -->
						<p ng-show="!names[0].process_id" style="text-align: center;" ng-bind="names[0].creating_time"></p>
						<!-- 有数据的显示 -->
						<div ng-repeat="x in names | filter:test | orderBy:'creating_time'" style="text-align: center;">
							<div ng-show="x.process_id">
								<span class="up-data1" ng-bind="'LTM526' + x.process_id"></span>
								<span class="up-data2" ng-bind="x.seed_type"></span>
								<span class="up-data3" ng-bind="x.creating_time"></span>
								<span class="up-data4"><button type="button" data-toggle="modal" ng-click="getID(x.process_id)" data-target="#myModal"  class="btn btn-danger">删除记录</button></span>
								<span class="up-data5"><button type="button" ng-click="changeData(x.process_id)" class="btn btn-success">编辑</button></span>
								<!-- 弹框 -->
								<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
													&times;
												</button>
												<h4 class="modal-title" id="myModalLabel">
													删除记录
												</h4>
											</div>
											<div class="modal-body">
												请再次确认你的选择
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">关闭
												</button>
												<button type="button" class="btn btn-primary" ng-click="cancelData()" data-dismiss="modal">
													确定
												</button>
											</div>
										</div><!-- /.modal-content -->
									</div><!-- /.modal -->
								</div>
								<!-- 以上未弹框代码 -->
								<hr>
							</div>
						</div>
					</div>
					<div class="userWare" ng-show="btn.changeData">
						<form class="form-horizontal" action="../php/putData.php" enctype="multipart/form-data" method="post" role="form">
							<span style="margin: 0 0 5px 50px;font-size: 18px;display: inline-block;">编辑溯源记录，后带<span style="color: red;">＊</span>的选项为必填</span><br>
							<span style="font-size: 12px;color: gray;margin: 0 0 20px 50px;display: inline-block;">图片格式仅限("gif", "jpeg", "jpg", "png")，不超过200kb；视频格式仅限("flv", "wmv", "rmvb", "mp4")，不超过20mb（上传视频需要部分时间，请耐心等待）。（上传相同文件名或者服务器上存在的文件，系统将会提醒，但用户添加的记录仍然生效）</span><br>
							<!-- 农产品的种类 -->
							<div class="process-all">
								<span class="process-title">农产品的种类:</span>
								<div class="process-data">
									<input type="text" name="seedtype" value="{{myData[0].seed_type}}"  required="true">
								</div>
								<span style="color: red;">＊</span>
							</div><br>
							<!-- 种子阶段 -->
							<span class="process-stage">种子阶段</span>
							<hr class="process-line"><!-- 分割线 -->
							<!-- 种子来源 -->
							<div class="process-all">
								<span class="process-title">种子的来源:</span>
								<div class="process-data">
									<input type="text" name="seedsource" value="{{myData[0].seed_source}}" required="true">
								</div>
								<span style="color: red;">＊</span>
							</div>
							<!-- 种子状态 -->
							<div class="process-all">
								<span class="process-title">种子的状态:</span>
								<div class="process-data">
									<input type="text" value="{{myData[0].seed_state}}" name="seedstate">
								</div>
							</div>
							<!-- 种子图片 -->
							<div class="process-all">
								<span class="process-title">{{myData[0].seed_image}}:</span>
								<div class="process-data" style="border-width: 0">
									<span class="glyphicon glyphicon-folder-open"></span>
									<input type="file" style="width: 230px" name="seedimg">
								</div>
							</div><br>
							<!-- 播种阶段 -->
							<span class="process-stage">播种阶段</span>
							<hr class="process-line"><!-- 分割线 -->
							<!-- 播种时间 -->
							<div class="process-all">
								<span class="process-title">播种的时间:</span>
								<div class="process-data">
									<input type="date" max="<?php echo $today ?>" name="sowdate" value="{{myData[0].sow_date}}" required="true">
								</div>
								<span style="color: red;">＊</span>
							</div>
							<!-- 播种地点 -->
							<div class="process-all">
								<span class="process-title">播种地点:</span>
								<div class="process-data">
									<input type="text" value="{{myData[0].sow_dress}}" name="sowdress">
								</div>
							</div>
							<!-- 播种天气 -->
							<div class="process-all">
								<span class="process-title">播种天气:</span>
								<div class="process-data">
									<input type="text" value="{{myData[0].sow_weather}}" name="sowweather">
								</div>
							</div>
							<!-- 播种的土地环境 -->
							<div class="process-all">
								<span class="process-title">播种的土地环境:</span>
								<div class="process-data">
									<input type="text" value="{{myData[0].sow_ground}}" name="sowground">
								</div>
							</div>
							<!-- 播种时的图片 -->
							<div class="process-all">
								<span class="process-title">{{myData[0].sow_image}}:</span>
								<div class="process-data" style="border-width: 0">
									<span class="glyphicon glyphicon-folder-open"></span>
									<input type="file" style="width: 230px" name="sowimg" value="上传图片" >
								</div>
							</div><br>
							<!-- 成长阶段 -->
							<span class="process-stage">成长阶段</span>
							<hr class="process-line"><!-- 分割线 -->
							<!-- 成长时的状态 -->
							<div class="process-all">
								<span class="process-title">成长时的状态:</span>
								<div class="process-data">
									<input type="text" name="growingstate" value="{{myData[0].growing_state}}" required="true">
								</div>
								<span style="color: red;">＊</span>
							</div>
							<!-- 成长时受到的灾害 -->
							<div class="process-all">
								<span class="process-title">成长时受到的灾害:</span>
								<div class="process-data">
									<input type="text" value="{{myData[0].growing_calamity}}" name="growingcalamity">
								</div>
							</div>
							<!-- 成长时施肥类型 -->
							<div class="process-all">
								<span class="process-title">成长时施肥类型:</span>
								<div class="process-data">
									<input type="text" value="{{myData[0].growing_fertilizer}}" name="growingfertilizer">
								</div>
							</div>
							<!-- 成长时的图片 -->
							<div class="process-all">
								<span class="process-title">{{myData[0].growing_image}}:</span>
								<div class="process-data" style="border-width: 0">
									<span class="glyphicon glyphicon-folder-open"></span>
									<input type="file" style="width: 230px" name="growingimg" >
								</div>
							</div><br>
							<!-- 收获销售阶段 -->
							<span class="process-stage">收获销售阶段</span>
							<hr class="process-line"><!-- 分割线 -->
							<!-- 收获时间 -->
							<div class="process-all">
								<span class="process-title">收获的时间:</span>
								<div class="process-data">
									<input type="date" value="{{myData[0].harvest_date}}" max="<?php echo $today ?>" name="harvestdate" required="true">
								</div>
								<span style="color: red;">＊</span>
							</div>
							<!-- 销售地点 -->
							<div class="process-all">
								<span class="process-title">销售地点:</span>
								<div class="process-data">
									<input type="text" value="{{myData[0].selling_dress}}" name="sellingdress">
								</div>
							</div>
							<!-- 下一级销售商家 -->
							<div class="process-all">
								<span class="process-title">下一级销售商家:</span>
								<div class="process-data">
									<input type="text" value="{{myData[0].selling_market}}" name="sellingmarket">
								</div>
							</div>
							<!-- 销售类型 -->
							<div class="process-all">
								<span class="process-title">销售类型:</span>
								<div class="process-data">
									<select name="sellingtype" ng-model="myData[0].selling_type"
									     style="display: inline-block;
												width: 256px;
												border-width: 0;
												outline: none;" 
									>
										<option value="其他" selected="true">其他</option>
										<option value="零售">零售</option>
										<option value="批发">批发</option>
									</select>
								</div>
							</div>
							<!-- 销售时间 -->
							<div class="process-all">
								<span class="process-title">销售的时间:</span>
								<div class="process-data">
									<input type="date" value="{{myData[0].selling_date}}" max="<?php echo $today ?>" name="sellingdate">
								</div>
							</div>
							<!-- 销售图片 -->
							<div class="process-all">
								<span class="process-title">销售的图片:</span>
								<div class="process-data" style="border-width: 0">
									<span class="glyphicon glyphicon-folder-open"></span>
									<input type="file" style="width: 230px" name="sellingimg" >
								</div>
							</div><br>
							<!-- 上传视频 -->
							<div class="process-all">
								<span class="process-title">视频:{{myData[0].process_video}}</span>
								<div class="process-data" style="border-width: 0">
									<span class="glyphicon glyphicon-folder-open"></span>
									<input type="file" style="width: 230px" name="video">
								</div>
							</div><br>
							<input  class="btn-yellow" style="margin-left: 300px" type="submit" value="确认提交">
								<a ng-click="dataOff()" class="btn-blue" style="margin-left: 20px;" href="#" >取消提交</a>
						</form>
					</div>
				</div>
<!-- 以上为仓库 -->
			</div>
		</div>
	</div>

	<!-- jquery框架 -->
	<script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
	<!-- angularjs框架 -->
	<script src="https://cdn.bootcss.com/angular.js/1.6.3/angular.min.js"></script>
	<!-- bootstrap框架 -->
	<script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="controler/userCenter.js"></script>
	
</body>
</html>