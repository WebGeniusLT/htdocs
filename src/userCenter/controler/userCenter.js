var app = angular.module('htmlModule', []);
app.controller('userCenterCtl', ['$scope', function($scope){
	$scope.btn={
		userShow: true,
		changePass: false
	}
	// 用户资料修改控制
	$scope.userChange = function(){
		$scope.btn.userShow = false;
	}
	$scope.cancel = function(){
		$scope.btn.userShow = true;
	}
	// 修改密码开关
	$scope.btnOn = function(){
		$scope.btn.changePass = true;
	}
	$scope.btnOff = function(){
		$scope.btn.changePass = false;
	}
}]);
app.controller('userBaseCtl', ['$scope','$http', function($scope,$http){
	// 请求用户上传记录
	$http({
		method: 'GET',
		url: '../php/test.php'
	}).then(function successCallback(response) {
			$scope.names = response.data.sites;
		}, function errorCallback(response) {
			// 请求失败执行代码
	});
	// 一些控制界面的变量
	$scope.btn = {
		processbtn: false,
		processData: true,
		changeData: false
	}
	// 获取id
	$scope.getID = function(thisID){
		$scope.processID = thisID;
	}
	// 添加记录开关
	$scope.processOn = function(){
		$scope.btn.processbtn = true;
		$scope.btn.changeData = false;
	}
	$scope.processOff = function(){
		$scope.btn.processbtn = false;
		$scope.btn.processData = true;
	}
	// 删除数据
	$scope.cancelData = function(){
		$http({
			method: 'GET',
			url: '../php/cancelDate.php?thisID='+$scope.processID
			}).then(function successCallback(response) {
				// 请求成功，从数据库重新罗列数据
				window.location.href = "userinfo.php";

			}, function errorCallback(response) {
				// 请求失败执行代码
		});
	}
	// 编辑数据
	$scope.changeData = function(processID){
		$scope.btn.changeData = true;
		$scope.btn.processData = false;
		$http({
			method: 'GET',
			url: '../php/changeData.php?thisID='+processID
			}).then(function successCallback(response) {
				$scope.myData = response.data.codes;
			}, function errorCallback(response) {
				// 请求失败执行代码
		});
	}
	$scope.dataOff = function(){
		$scope.btn.changeData = false;
		$scope.btn.processData = true;
	}
	$scope.jj = function(ss){
		alert(ss);
	}
}])