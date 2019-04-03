<?php
session_start();

//检测是否登录，若没登录则转向登录界面
if(!isset($_SESSION['userbsid'])){
    echo "<script type='text/javascript'>window.location.href='../sign_log/home.html#/log';</script>";
    exit();
}
//包含数据库连接文件
include('../php/conn.php');
$today = date("Y-m-d");
$userbsid = $_SESSION['userbsid']; //用户id
$userbsname = $_SESSION['userbs']; //用户名
$sql = "select * from userbs where userbs_id='$userbsid'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
$userbsname = $row['userbs_enterName'];
$userbstype = $row['userbs_type'];//商家类型
$userbase = $row['userbs_bsName']; //用户基地名字
$userperson = $row["userbs_person"]; //基地负责人
$useremail = $row['userbs_email']; //用户邮箱
$usertel = $row['userbs_number']; //用户电话
$userdress = $row['userbs_dress']; //基地地址
$usertime = $row['userbs_date']; //注册时间
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
		    	<li><a href="userinfo.php"><span class="glyphicon glyphicon-user"></span> <?php echo $userbsname; ?></a></li>
			    <li><a href="../php/bs_log.php?action=logout"><span class="glyphicon glyphicon-log-out"></span> 退出</a></li>
		    </ul>
		</div>
	</nav>
	<!-- 标签页 -->
	<div class="nav-all">
		<div class="nav-top">
			<ul id="myTab" class="nav nav-pills nav-justified">
				<li class="active">
					<a href="#userCenter" data-toggle="tab">商家用户信息</a>
				</li>
				<li>
					<a href="#userHouse" data-toggle="tab">商家商品记录</a>
				</li>
			</ul>
		</div>
	<!-- 标签页之后的内容 -->
		<div class="nav-content">
			<div id="myTabContent" class="tab-content">
			<!-- 用户中心 -->
				<div class="tab-pane fade in active" id="userCenter" ng-controller="userCenterCtl">
					<div class="user-house">
						<form action="../php/userbsMessage.php" method="post" name="userForm">
						<!-- 用户名 -->
							<div class="userCtl">
								<span class="user-message">用户名:</span>
								<span ng-show="btn.userShow" class="user-data"><?php echo $userbsname ?></span>
								<input ng-show="!btn.userShow" class="user-box" type="text" name="user" value="<?php echo $userbsname ?>" pattern="[A-z][A-z0-9]{3,14}" title="登录名以字母开头，至少4位，不超过15位" required="true">
							</div>
							<!-- 商家类型 -->
							<div class="userCtl">
								<span class="user-message">商家类型:</span>
								<span ng-show="btn.userShow" class="user-data"><?php echo $userbstype ?></span>
								<input ng-show="!btn.userShow" class="user-box" type="text" name="userbstype" value="<?php echo $userbstype ?>" pattern="^[^\s]+$" title="不能有空格" required="true">
							</div>
							<!-- 用户基地名字 -->
							<div class="userCtl">
								<span class="user-message">商家名字:</span>
								<span ng-show="btn.userShow" class="user-data"><?php echo $userbase ?></span>
								<input ng-show="!btn.userShow" class="user-box" type="text" name="userbase" value="<?php echo $userbase ?>" pattern="^[^\s]+$" title="不能有空格" required="true">
							</div>
							<!-- 基地负责人 -->
							<div class="userCtl">
								<span class="user-message">商家负责人:</span>
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
								<span class="user-message">商家地址:</span>
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
						<form action="../php/userbsPassword.php" method="post">
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
						<form class="form-horizontal" action="../php/addbsProcess.php" enctype="multipart/form-data" method="post" role="form">
							<span style="margin: 0 0 5px 50px;font-size: 18px;display: inline-block;">添加商品记录，后带<span style="color: red;">＊</span>的选项为必填</span><br>
							<span style="font-size: 12px;color: gray;margin: 0 0 20px 50px;display: inline-block;">图片格式仅限("gif", "jpeg", "jpg", "png")，不超过200kb。（上传相同文件名或者服务器上存在的文件，系统将会提醒，但用户添加的记录仍然生效）</span><br>
							<span class="process-stage">商家记录</span>
							<hr class="process-line"><!-- 分割线 -->
							<!-- 商品编号 -->
							<div class="process-all">
								<span class="process-title">商品编号:</span>
								<div class="process-data">
									<input type="text" name="bsid" required="true">
								</div>
								<span style="color: red;">＊</span>
							</div>
							<!-- 农产品的种类 -->
							<div class="process-all">
								<span class="process-title">商品来源:</span>
								<div class="process-data">
									<input type="text" name="bssource" required="true">
								</div>
								<span style="color: red;">＊</span>
							</div>
							<!-- 商品种类 -->
							<div class="process-all">
								<span class="process-title">商品种类:</span>
								<div class="process-data">
									<input type="text" name="bstype" required="true">
								</div>
								<span style="color: red;">＊</span>
							</div>
							<!-- 种子阶段 -->
							<div class="process-all">
								<span class="process-title">商品购买时间:</span>
								<div class="process-data">
									<input type="date" max="<?php echo $today ?>" name="bsindate" required="true">
								</div>
								<span style="color: red;">＊</span>
							</div>							
							<!-- 种子状态 -->
							<div class="process-all">
								<span class="process-title">商品销售地点:</span>
								<div class="process-data">
									<input type="text" name="bsdress">
								</div>
							</div>
							<div class="process-all">
								<span class="process-title">商品销售时间:</span>
								<div class="process-data">
									<input type="date" max="<?php echo $today ?>" name="bsoutdate" required="true">
								</div>
								<span style="color: red;">＊</span>
							</div>
							<!-- 售卖价格 -->
							<div class="process-all">
								<span class="process-title">商品售卖的价格:</span>
								<div class="process-data">
									<input type="text" name="bsprice" required="true">
								</div>
								<span style="color: red;">＊</span>
							</div>
							<!-- 种子图片 -->
							<div class="process-all">
								<span class="process-title">图片展示:</span>
								<div class="process-data" style="border-width: 0">
									<span class="glyphicon glyphicon-folder-open"></span>
									<input type="file" style="width: 230px" name="bsimg" required="true">
								</div>
								<span style="color: red;">＊</span>
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
						<p ng-show="!names[0].bs_id" style="text-align: center;" ng-bind="names[0].creating_time"></p>
						<!-- 有数据的显示 -->
						<div ng-repeat="x in names | filter:test | orderBy:'creating_time'" style="text-align: center;">
							<div ng-show="x.bs_id">
								<span class="up-data1" ng-bind="'LTM526' + x.bs_id"></span>
								<span class="up-data2" ng-bind="x.bs_type"></span>
								<span class="up-data3" ng-bind="x.creating_time"></span>
								<span class="up-data4"><button type="button" data-toggle="modal" ng-click="getID(x.bs_id)" data-target="#myModal"  class="btn btn-danger">删除记录</button></span>
								<span class="up-data5"><button type="button" ng-click="changeData(x.bs_id)" class="btn btn-success">编辑</button></span>
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
						<form class="form-horizontal" action="../php/putbsData.php" enctype="multipart/form-data" method="post" role="form">
							<span style="margin: 0 0 5px 50px;font-size: 18px;display: inline-block;">编辑商品记录，后带<span style="color: red;">＊</span>的选项为必填</span><br>
							<span style="font-size: 12px;color: gray;margin: 0 0 20px 50px;display: inline-block;">图片格式仅限("gif", "jpeg", "jpg", "png")，不超过200kb。（上传相同文件名或者服务器上存在的文件，系统将会提醒，但用户添加的记录仍然生效）</span><br>
							<span class="process-stage">编辑商品记录</span>
							<hr class="process-line"><!-- 分割线 -->
							<!-- 农产品的种类 -->
							<div class="process-all">
								<span class="process-title">商品来源:</span>
								<div class="process-data">
									<input type="text" name="bssource" value="{{myData[0].bs_source}}" required="true">
								</div>
								<span style="color: red;">＊</span>
							</div>
							<!-- 商品种类 -->
							<div class="process-all">
								<span class="process-title">商品种类:</span>
								<div class="process-data">
									<input type="text" name="bstype" value="{{myData[0].bs_type}}" required="true">
								</div>
								<span style="color: red;">＊</span>
							</div>
							<!-- 种子阶段 -->
							<div class="process-all">
								<span class="process-title">商品购买时间:</span>
								<div class="process-data">
									<input type="date" max="<?php echo $today ?>" value="{{myData[0].bs_indate}}" name="bsindate" required="true">
								</div>
								<span style="color: red;">＊</span>
							</div>							
							<!-- 种子状态 -->
							<div class="process-all">
								<span class="process-title">商品销售地点:</span>
								<div class="process-data">
									<input type="text" value="{{myData[0].bs_dress}}" name="bsdress">
								</div>
							</div>
							<div class="process-all">
								<span class="process-title">商品销售时间:</span>
								<div class="process-data">
									<input type="date" max="<?php echo $today ?>" value="{{myData[0].bs_outdate}}" name="bsoutdate" required="true">
								</div>
								<span style="color: red;">＊</span>
							</div>
							<!-- 售卖价格 -->
							<div class="process-all">
								<span class="process-title">商品售卖的价格:</span>
								<div class="process-data">
									<input type="text" name="bsprice" value="{{myData[0].bs_price}}" required="true">
								</div>
								<span style="color: red;">＊</span>
							</div>
							<!-- 种子图片 -->
							<div class="process-all">
								<span class="process-title">{{myData[0].bs_image}}:</span>
								<div class="process-data" style="border-width: 0">
									<span class="glyphicon glyphicon-folder-open"></span>
									<input type="file" style="width: 230px" name="bsimg">
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