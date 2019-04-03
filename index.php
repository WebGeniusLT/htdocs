<?php 
session_start();
$userid = $_SESSION['userid']; //基地用户id
$username = $_SESSION['user']; //用户名
$useradmin = $_SESSION['online'];//管理员登录凭证
$userbsid = $_SESSION['userbsid']; //商家用户id
$userbsname = $_SESSION['userbs']; //用户名
 ?>
<!DOCTYPE html>
<html ng-app="myapp">
<head>
	<meta charset="utf-8">
	<title>绿色农产品溯源网</title>
	<link href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="view/indexView.css">
</head>
<body ng-controller="searchCtl">
	<!-- 导航栏 -->
	<nav class="navbar navbar-default" role="navigation">
  		<div class="container-fluid">
		    <div class="navbar-header">
		    	<a class="navbar-brand" href="index.php"><img class="logo" src="src/img/logo.png"></a>
		    </div>
		    <!-- 管理员 -->
			    <ul ng-show="<?php echo $useradmin; ?>" class="nav navbar-nav navbar-right">
			    	<li><a href="src/admin/adminCenter.php"><span class="glyphicon glyphicon-user"></span> 管理员-龙涛</a></li>
				    <li><a href="src/php/adminLog.php?action=logout"><span class="glyphicon glyphicon-log-out"></span> 退出</a></li>
			    </ul>
		        <ul ng-show="!<?php echo $useradmin ?>" class="nav navbar-nav navbar-right">
			      <li><a href="src/admin/adminLog.html"><span class="glyphicon glyphicon-log-in"></span> 管理员登录</a></li>
			    </ul>
			    <!-- 以上为管理员 -->
			    <ul ng-show="<?php echo $userid; ?>" class="nav navbar-nav navbar-right">
			    	<li><a href="src/userCenter/userinfo.php"><span class="glyphicon glyphicon-user"></span> 基地-<?php echo $username; ?></a></li>
				    <li><a href="src/php/log_in.php?action=logout"><span class="glyphicon glyphicon-log-out"></span> 退出</a></li>
			    </ul>
			    <!-- 商家 -->
			    <ul ng-show="<?php echo $userbsid; ?>" class="nav navbar-nav navbar-right">
			    	<li><a href="src/userbsCenter/userinfo.php"><span class="glyphicon glyphicon-user"></span> 商家-<?php echo $userbsname; ?></a></li>
				    <li><a href="src/php/bs_log.php?action=logout"><span class="glyphicon glyphicon-log-out"></span> 退出</a></li>
			    </ul>
			    <ul class="nav navbar-nav navbar-right" ng-show="!<?php echo $userbsid; ?>">
			    	<ul ng-show="!<?php echo $userid; ?>" class="nav navbar-nav navbar-right">
				      <li><a href="src/sign_log/home.html#/sign"><span class="glyphicon glyphicon-user"></span> 用户注册</a></li>
				      <li><a href="src/sign_log/home.html#/log"><span class="glyphicon glyphicon-log-in"></span> 登录</a></li>
				    </ul>
			    </ul>
			        
		</div>
	</nav>
	<p class="slogn">输入你想查询的编号</p>
	<!-- 查询框 -->
	<div class="search-all">
		<input type="text" placeholder="健康，就是动动手指那么简单" ng-model="num"  ng-keyup="enterEvent($event)">
		<a href="#" ng-click="searchData()">查询</a>
	</div>
	<div style="width: 845px;margin: 0 auto;">
		<!-- 数据罗列 -->
		<span ng-show="allInput.remind" style="margin: 10px 0 0 10px;font-size: 16px;color: #eadadb;">例如：LTM5261，搜索编号的前缀为LTM526</span>
		<!-- 数据显示 -->
		<span ng-bind="datas[0].fault" class="each-data"></span>
		<div ng-show="datas[0].process_id" style="background-color: #5caaf9;box-shadow: 0px 4px 20px 3px #2864c8;">
			<div style="height: 40px"></div>
			<p style="text-align: center;margin-bottom: 40px;font-size: 18px;font-weight: bold;color: #0019ff;">基地流程</p>
			<!-- 绿色食品种类 -->
			<span class="data-title">绿色食品种类：</span><span class="data-dal" ng-bind="datas[0].seed_type"></span>
			<hr class="data-line">
			<!-- 生产基地信息 -->
			<span class="data-title">生产基地：</span><span class="data-dal" ng-bind="datas[1].user_baseName"></span>
			<span class="data-title">基地负责人：</span><span class="data-dal" ng-bind="datas[1].user_person"></span>
			<span class="data-title">负责人邮箱：</span><span class="data-dal" ng-bind="datas[1].user_email"></span>
			<span class="data-title">负责人电话：</span><span class="data-dal" ng-bind="datas[1].user_number"></span>
			<span class="data-title">生产基地地址：</span><span class="data-dal" ng-bind="datas[1].user_dress"></span>
			<hr class="data-line">
			<!-- 种子阶段 -->
			<span class="data-title">种子来源：</span><span class="data-dal" ng-bind="datas[0].seed_source"></span>
			<span class="data-title">种子状态：</span><span class="data-dal" ng-bind="datas[0].seed_state"></span>
			<img class="img-size img-rounded" ng-show="datas[0].process_id" alt="种子阶段的图片" title="种子阶段的图片" ng-src="{{'src/upload/img/'+datas[1].user_id+'/'+datas[0].seed_image}}">
			<hr class="data-line">
			<!-- 播种阶段 -->
			<span class="data-title">播种时间：</span><span class="data-dal" ng-bind="datas[0].sow_date"></span>
			<span class="data-title">播种地点：</span><span class="data-dal" ng-bind="datas[0].sow_dress"></span>
			<span class="data-title">播种天气：</span><span class="data-dal" ng-bind="datas[0].sow_weather"></span>
			<span class="data-title">播种的土地状况：</span><span class="data-dal" ng-bind="datas[0].sow_ground"></span>
			<img class="img-size img-rounded" ng-show="datas[0].process_id" alt="播种阶段的图片" title="播种阶段的图片" ng-src="{{'src/upload/img/'+datas[1].user_id+'/'+datas[0].sow_image}}">
			<hr class="data-line">
			<!-- 成长阶段 -->
			<span class="data-title">成长状态：</span><span class="data-dal" ng-bind="datas[0].growing_state"></span>
			<span class="data-title">成长遇到的灾害：</span><span class="data-dal" ng-bind="datas[0].growing_calamity"></span>
			<span class="data-title">成长期间施肥：</span><span class="data-dal" ng-bind="datas[0].growing_fertilizer"></span>
			<img class="img-size img-rounded" ng-show="datas[0].process_id" alt="成长阶段的图片" title="成长阶段的图片" ng-src="{{'src/upload/img/'+datas[1].user_id+'/'+datas[0].growing_image}}">
			<hr class="data-line">
			<!-- 收获销售阶段 -->
			<span class="data-title">收获时间：</span><span class="data-dal" ng-bind="datas[0].harvest_date"></span>
			<div ng-show="databs[0].bs_id">
				<span class="data-title">销售地点：</span><span class="data-dal" ng-bind="datas[0].selling_dress"></span>
				<span class="data-title">下一级商家：</span><span class="data-dal" ng-bind="datas[0].selling_market"></span>
				<span class="data-title">销售方式：</span><span class="data-dal" ng-bind="datas[0].selling_type"></span>
				<span class="data-title">销售时间：</span><span class="data-dal" ng-bind="datas[0].selling_date"></span>
				<img class="img-size img-rounded" ng-show="datas[0].process_id" alt="销售的图片" title="销售的图片" ng-src="{{'src/upload/img/'+datas[1].user_id+'/'+datas[0].selling_image}}">
				<hr class="data-line">
			</div>
			<!-- all -->
			<span class="data-title">创建记录时间：</span><span class="data-dal" ng-bind="datas[0].creating_time"></span>
			<div ng-show="datas[0].process_video">
				<video style="width: 800px;height: 600px;display: block;margin: 20px auto 0;" controls="controls" ng-show="datas[0].process_id" alt="视频链接不存在" title="视频" ng-src="{{'src/upload/video/'+datas[1].user_id+'/'+datas[0].process_video}}">
					你的浏览器不支持html视频
				</video>
			</div>
			<hr class="data-line">
			<!-- 留白 -->
			<div style="height: 40px"></div>
		</div>
		<div ng-show="datas[0].process_id">
			<div ng-show="databs[0].userbs_id" style="background-color: #5caaf9;box-shadow: 0px 4px 20px 3px #2864c8;">
				<div style="height: 40px"></div>
				<p style="text-align: center;margin-bottom: 40px;font-size: 18px;font-weight: bold;color: #0019ff;">商家流程</p>
				<!-- 绿色食品种类 -->
				<span class="data-title">绿色食品种类：</span><span class="data-dal" ng-bind="databs[0].bs_type"></span>
				<hr class="data-line">
				<!-- 生产基地信息 -->
				<span class="data-title">商家类型：</span><span class="data-dal" ng-bind="databs[1].userbs_type"></span>
				<span class="data-title">商家名称：</span><span class="data-dal" ng-bind="databs[1].userbs_bsName"></span>
				<span class="data-title">商家负责人：</span><span class="data-dal" ng-bind="databs[1].userbs_person"></span>
				<span class="data-title">负责人邮箱：</span><span class="data-dal" ng-bind="databs[1].userbs_email"></span>
				<span class="data-title">负责人电话：</span><span class="data-dal" ng-bind="databs[1].userbs_number"></span>
				<span class="data-title">商家地址：</span><span class="data-dal" ng-bind="databs[1].userbs_dress"></span>
				<hr class="data-line">
				<!-- 种子阶段 -->
				<span class="data-title">商品来源：</span><span class="data-dal" ng-bind="databs[0].bs_source"></span>
				<span class="data-title">购买时间：</span><span class="data-dal" ng-bind="databs[0].bs_indate"></span>
				<span class="data-title">销售地点：</span><span class="data-dal" ng-bind="databs[0].bs_dress"></span>
				<span class="data-title">售卖时间：</span><span class="data-dal" ng-bind="databs[0].bs_outdate"></span>
				<span class="data-title">售卖价格：</span><span class="data-dal" ng-bind="databs[0].bs_price"></span>
				<img class="img-size img-rounded" ng-show="databs[0].bs_id" alt="售卖图片" title="售卖图片" ng-src="{{'src/upload/imgbs/'+databs[1].userbs_id+'/'+databs[0].bs_image}}">
				<hr class="data-line">
				<!-- 留白 -->
				<div style="height: 40px"></div>
			</div>
		</div>
			

	</div>
	<div style="height: 60px"></div>

	<script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
	<!-- angularjs框架 -->
	<script src="https://cdn.bootcss.com/angular.js/1.6.3/angular.min.js"></script>
	<!-- bootstrap框架 -->
	<script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="view/contrlIndex.js"></script>
</body>
</html>