<?php 
session_start();
if(!isset($_SESSION['online'])){
    echo "<script type='text/javascript'>window.location.href='adminLog.html';</script>";
    exit();
}
 ?>

<!-- html代码 -->
<!DOCTYPE html>
<html ng-app="adminApp">
<head>
	<title>管理员中心</title>
	<link href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="view/adminCenter.css">
</head>
<body ng-controller="allCtl">
	<!-- 导航栏 -->
	<nav class="navbar navbar-default" role="navigation">
  		<div class="container-fluid">
		    <div class="navbar-header">
		    	<a class="navbar-brand" href="../../index.php"><img class="logo" src="../img/logo.png"></a>
		    </div>
		    <ul class="nav navbar-nav navbar-right">
		    	<li><a href="adminCenter.php"><span class="glyphicon glyphicon-user">龙涛</span></a></li>
			    <li><a href="../php/adminLog.php?action=logout"><span class="glyphicon glyphicon-log-out"></span> 退出</a></li>
		    </ul>
		</div>
	</nav>
<!-- 分页 -->
	<div class="nav-all">
		<ul id="myTab" class="nav nav-pills nav-justified">
			<li class="active">
				<a href="#checkno" data-toggle="tab">
					 审核未通过
				</a>
			</li>
			<li>
				<a href="#checking" data-toggle="tab">审核中</a>
			</li>
			<li>
				<a href="#checked" data-toggle="tab">已通过审核</a>
			</li>
		</ul>
	</div>
	<!-- 以上为分页的头 -->
	<!-- 以下为分页内容 -->
	<div id="myTabContent" class="tab-content" style="width: 1100px;margin: 0 auto;">
		<!-- 未审核的数据 -->
		<div class="tab-pane fade in active" id="checkno">
		<!-- 搜索框 -->
			<div class="process-all">
				<span class="process-title">筛选记录:</span>
				<div class="process-data">
					<input type="text" ng-model="test1">
				</div>
			</div><br>
			<!-- 标题头 -->
			<div style="background-color: #f9f9f9;text-align: center;">
				<span title="用户名" class="up-data">用户名</span>
				<span title="用户基地名" class="up-data">用户基地名</span>
				<span title="基地负责人" class="up-data">基地负责人</span>
				<span title="负责人邮箱" class="up-data">负责人邮箱</span>
				<span title="负责人电话" class="up-data">负责人电话</span>
				<span title="基地地址" class="up-data">基地地址</span>
				<span title="审核状态" class="up-data">审核状态</span>
				<span title="申请时间" class="up-data">申请时间</span>
				<span title="删除" class="up-data">删除</span>
				<hr>
			</div>
			<!-- 以上为标题头部 -->
			<p ng-show="!checkno[0].user_id" style="text-align: center;" ng-bind="checkno[0].no_data"></p>
			<!-- 列数据 -->
			<div ng-repeat="x in checkno | filter:test1 | orderBy:'user_date'" style="text-align: center;">
			<!-- 没有数据的时候不显示这块 -->
				<div ng-show="x.user_id">
					<span title="{{x.user_enterName}}" ng-bind="x.user_enterName" class="up-data"></span>
					<span title="{{x.user_baseName}}" ng-bind="x.user_baseName" class="up-data"></span>
					<span title="{{x.user_person}}" ng-bind="x.user_person" class="up-data"></span>
					<span title="{{x.user_email}}" ng-bind="x.user_email" class="up-data"></span>
					<span title="{{x.user_number}}" ng-bind="x.user_number" class="up-data"></span>
					<span title="{{x.user_dress}}" ng-bind="x.user_dress" class="up-data"></span>
					<span title="审核未通过" class="up-data">审核未通过</span>
					<span title="{{x.user_date}}" ng-bind="x.user_date" class="up-data"></span>
					<span title="删除" class="up-data" id="jjj"><button type="button" data-toggle="modal" ng-click="getID(x.user_id)" data-target="#myModal4"  id="cancel" class="btn btn-danger">删除记录</button></span>
						
						<!-- 弹框 -->
					<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
									<button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="cancelData()">
										确定
									</button>
								</div>
							</div><!-- /.modal-content -->
						</div><!-- /.modal -->
					</div>
					<!-- 以上未弹框代码 -->
					<hr>
				</div><!-- 没有数据的时候不显示这块 -->
			</div>
		<!-- 以上为数据的罗列 -->
		</div>
		<!-- 以上未未审核的数据 -->
		<!-- 正在审核的数据 -->
		<div class="tab-pane fade" id="checking">
			<!-- 搜索框 -->
			<div class="process-all">
				<span class="process-title">筛选记录:</span>
				<div class="process-data">
					<input type="text" ng-model="test2">
				</div>
			</div><br>
			<!-- 标题头 -->
			<div style="background-color: #f9f9f9;text-align: center;">
				<span title="用户名" class="up-data">用户名</span>
				<span title="用户基地名" class="up-data">用户基地名</span>
				<span title="基地负责人" class="up-data">基地负责人</span>
				<span title="负责人邮箱" class="up-data">负责人邮箱</span>
				<span title="负责人电话" class="up-data">负责人电话</span>
				<span title="基地地址" class="up-data">基地地址</span>
				<span title="审核状态" class="up-data">审核状态</span>
				<span title="申请时间" class="up-data">申请时间</span>
				<span title="通过审核" class="up-data">通过审核</span>
				<span title="不通过审核" class="up-data">不通过审核</span>
				<hr>
			</div>
			<!-- 以上为标题头部 -->
			<p ng-show="!checking[0].user_id" style="text-align: center;" ng-bind="checking[0].no_data"></p>
			<!-- 列数据 -->
			<div ng-repeat="x in checking | filter:test2 | orderBy:'user_date'" style="text-align: center;">
				<!-- 没有数据的时候不显示这块 -->
				<div ng-show="x.user_id">
					<span title="{{x.user_enterName}}" ng-bind="x.user_enterName" class="up-data"></span>
					<span title="{{x.user_baseName}}" ng-bind="x.user_baseName" class="up-data"></span>
					<span title="{{x.user_person}}" ng-bind="x.user_person" class="up-data"></span>
					<span title="{{x.user_email}}" ng-bind="x.user_email" class="up-data"></span>
					<span title="{{x.user_number}}" ng-bind="x.user_number" class="up-data"></span>
					<span title="{{x.user_dress}}" ng-bind="x.user_dress" class="up-data"></span>
					<span title="正在审核" class="up-data">正在审核</span>
					<span title="{{x.user_date}}" ng-bind="x.user_date" class="up-data"></span>
					<span title="通过审核" class="up-data"><button type="button" ng-click="getID(x.user_id)" data-toggle="modal" data-target="#myModal2"  class="btn btn-danger">通过</button></span>
					<span title="不通过审核" class="up-data"><button type="button" data-toggle="modal" data-target="#myModal3" ng-click="getID(x.user_id)" class="btn btn-danger">不通过</button></span>
						
						<!-- 弹框 -->
					<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
										&times;
									</button>
									<h4 class="modal-title" id="myModalLabel">
										通过审核
									</h4>
								</div>
								<div class="modal-body">
									请再次确认你的选择
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">关闭
									</button>
									<button type="button" class="btn btn-primary" ng-click="agree()" data-dismiss="modal">
										确定
									</button>
								</div>
							</div><!-- /.modal-content -->
						</div><!-- /.modal -->
					</div>
					<!-- 以上未弹框代码 -->
					<!-- 弹框 -->
					<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
										&times;
									</button>
									<h4 class="modal-title" id="myModalLabel">
										不通过审核
									</h4>
								</div>
								<div class="modal-body">
									请再次确认你的选择
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">关闭
									</button>
									<button type="button" class="btn btn-primary" ng-click="agreeNo()" data-dismiss="modal">
										确定
									</button>
								</div>
							</div><!-- /.modal-content -->
						</div><!-- /.modal -->
					</div>
					<!-- 以上未弹框代码 -->
					<hr>
				</div><!-- 没有数据的时候不显示这块 -->
			</div>
		<!-- 以上为数据的罗列 -->
		</div>
		<!-- 以上为正在审核的数据 -->
		<div class="tab-pane fade" id="checked">
		<!-- 搜索框 -->
			<div class="process-all">
				<span class="process-title">筛选记录:</span>
				<div class="process-data">
					<input type="text" ng-model="test3">
				</div>
			</div><br>
			<!-- 标题头 -->
			<div style="background-color: #f9f9f9;text-align: center;">
				<span title="用户名" class="up-data">用户名</span>
				<span title="用户基地名" class="up-data">用户基地名</span>
				<span title="基地负责人" class="up-data">基地负责人</span>
				<span title="负责人邮箱" class="up-data">负责人邮箱</span>
				<span title="负责人电话" class="up-data">负责人电话</span>
				<span title="基地地址" class="up-data">基地地址</span>
				<span title="审核状态" class="up-data">审核状态</span>
				<span title="申请时间" class="up-data">申请时间</span>
				<span title="变为未审核" class="up-data">变为未审核</span>
				<hr>
			</div>
			<!-- 以上为标题头部 -->
			<p ng-show="!checked[0].user_id" style="text-align: center;" ng-bind="checked[0].no_data"></p>
			<!-- 列数据 -->
			<div ng-repeat="x in checked | filter:test3 | orderBy:'user_date'" style="text-align: center;">
			<!-- 没有数据的时候不显示这块 -->
				<div ng-show="x.user_id">
					<span title="{{x.user_enterName}}" ng-bind="x.user_enterName" class="up-data"></span>
					<span title="{{x.user_baseName}}" ng-bind="x.user_baseName" class="up-data"></span>
					<span title="{{x.user_person}}" ng-bind="x.user_person" class="up-data"></span>
					<span title="{{x.user_email}}" ng-bind="x.user_email" class="up-data"></span>
					<span title="{{x.user_number}}" ng-bind="x.user_number" class="up-data"></span>
					<span title="{{x.user_dress}}" ng-bind="x.user_dress" class="up-data"></span>
					<span title="审核通过" class="up-data">审核通过</span>
					<span title="{{x.user_date}}" ng-bind="x.user_date" class="up-data"></span>
					<span title="变为未审核" class="up-data"><button type="button" ng-click="getID(x.user_id)" data-toggle="modal" data-target="#myModal1"  class="btn btn-danger">变为未审核</button></span>
						
						<!-- 弹框 -->
					<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
										&times;
									</button>
									<h4 class="modal-title" id="myModalLabel">
										改变审核状态
									</h4>
								</div>
								<div class="modal-body">
									请再次确认你的选择
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">关闭
									</button>
									<button type="button" class="btn btn-primary" ng-click="agreeNo()" data-dismiss="modal">
										确定
									</button>
								</div>
							</div><!-- /.modal-content -->
						</div><!-- /.modal -->
					</div>
					<!-- 以上未弹框代码 -->
					<hr>
				</div><!-- 没有数据的时候不显示这块 -->
			</div>
		</div>
		<!-- 以上为已审核的数据 -->
	</div>
<!-- 以上为分页内容 -->
	<script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
	<!-- angularjs框架 -->
	<script src="https://cdn.bootcss.com/angular.js/1.6.3/angular.min.js"></script>
	<!-- bootstrap框架 -->
	<script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="contrller/adminCtl.js"></script>
</body>
</html>