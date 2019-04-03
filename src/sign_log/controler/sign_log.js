var app=angular.module('sign-log', ['ngRoute']);
app.config(['$routeProvider',function($routeProvider) {
	$routeProvider.
	when('/sign', {
        templateUrl: 'template/sign_in.html',
        controller: 'signCtl'
    }).
    when('/log', {
        templateUrl: 'template/log_in.html',
        controller: 'logCtl'
    }).
    otherwise({
        redirectTo: '/sign'
    });
}]);
// 注册控制器
app.controller('logCtl', ['$scope', function($scope){
	$scope.btn = {
		action: '../php/log_in.php'
	}
	$scope.base = function(){
		$scope.btn = {
			action: '../php/log_in.php'
		}
	}
	$scope.bs = function(){
		$scope.btn = {
			action: '../php/bs_log.php'
		}
	}
}]);
// 登录控制器
app.controller('signCtl', ['$scope', function($scope){
	$scope.btn = {
		change: false,
		Name: '基地名称',
		person: '基地负责人',
		dress: '基地地址',
		action: '../php/sign_in.php'
	}
	$scope.base = function(){
		$scope.btn = {
			change: false,
			Name: '基地名称',
			person: '基地负责人',
			dress: '基地地址',
			action: '../php/sign_in.php'
		}
	}
	$scope.bs = function(){
		$scope.btn = {
			change: true,
			Name: '商家名称',
			person: '商家负责人',
			dress: '商家地址',
			action: '../php/bs_sign.php'
		}
	}
}]);
// 主页控制器
app.controller('titleCtl', ['$scope','$location', function($scope,$location){
	$scope.myUrl = $location.path();
	$scope.signUrl = "/sign";
	$scope.$watch('myUrl', function(newValue, oldValue, scope) {
		if (newValue == $scope.signUrl) {
			$scope.homeCtl={
				aTitle:"注册",
				item: "我们的目的是，大家的健康",
				sclass:"navCtl",
				lclass:" "
			};
		}else{
			$scope.homeCtl={
				aTitle:"登录",
				item: "快去服务大众吧",
				sclass:" ",
				lclass:"navCtl"
			};
		}
	}, true);
	// 点击注册时控制样式
	$scope.sClick = function(){
		$scope.homeCtl={
			aTitle:"注册",
			item: "我们的目的是，大家的健康",
			sclass:"navCtl",
			lclass:" "
		};
	};
	// 点击登录时控制样式
	$scope.lClick = function(){
		$scope.homeCtl={
			aTitle:"登录",
			item: "快去服务大众吧",
			sclass:" ",
			lclass:"navCtl"
		};
	};
}]);