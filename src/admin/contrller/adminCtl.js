var app=angular.module('adminApp', []);

// 总控制器
app.controller('allCtl', ['$scope','$http', function($scope,$http){
	// 请求未审核的数据
	$http({
		method: 'GET',
		url: '../php/getData.php?state=0'
	}).then(function successCallback(response) {
			$scope.checkno = response.data.sites;
		}, function errorCallback(response) {
			// 请求失败执行代码
	});
	// 请求正在审核的数据
	$http({
		method: 'GET',
		url: '../php/getData.php?state=1'
	}).then(function successCallback(response) {
			$scope.checking = response.data.sites;
		}, function errorCallback(response) {
			// 请求失败执行代码
	});
	// 请求已审核的数据
	$http({
		method: 'GET',
		url: '../php/getData.php?state=2'
	}).then(function successCallback(response) {
			$scope.checked = response.data.sites;
		}, function errorCallback(response) {
			// 请求失败执行代码
	});
	// 设置传入服务的参数
	$scope.getID = function(thisID){
		$scope.processID = thisID;
	}
	// 删除数据
	$scope.cancelData = function(){
		$http({
			method: 'GET',
			url: '../php/cancelUser.php?thisID='+$scope.processID
			}).then(function successCallback(response) {
				// 请求成功，从数据库重新罗列数据
				window.location.href = "adminCenter.php";
			}, function errorCallback(response) {
				// 请求失败执行代码
		});
	}
	// 通过审核
	$scope.agree = function(){
		$http({
			method: 'GET',
			url: '../php/agree.php?thisID='+$scope.processID
			}).then(function successCallback(response) {
				// 请求成功，从数据库重新罗列数据
				window.location.href = "adminCenter.php";

			}, function errorCallback(response) {
				// 请求失败执行代码
		});
		
	}
	// 不通过审核
	$scope.agreeNo = function(){
		$http({
			method: 'GET',
			url: '../php/agreeNo.php?thisID='+$scope.processID
			}).then(function successCallback(response) {
				// 请求成功，从数据库重新罗列数据
				window.location.href = "adminCenter.php";

			}, function errorCallback(response) {
				// 请求失败执行代码
		});
	}
}]);