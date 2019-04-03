var app = angular.module('myapp', []);
app.controller('searchCtl', ['$scope','$http', function($scope,$http){
	$scope.allInput = {
		userinput: "",
		remind: true
	}
	$scope.searchData = function(){
		$scope.allInput.userinput = $scope.num;
		$http({
		method: 'GET',
		url: 'src/php/searchData.php?data='+$scope.allInput.userinput
		}).then(function successCallback(response) {
				$scope.datas = response.data.sites;
				$scope.allInput.remind = false;
			}, function errorCallback(response) {
				// 请求失败执行代码
		});
		//商家信息
		$http({
			method: 'GET',
			url: 'src/php/searchbsData.php?data='+$scope.allInput.userinput
			}).then(function successCallback(response) {
					$scope.databs = response.data.sites;
					$scope.allInput.remind = false;
				}, function errorCallback(response) {
					// 请求失败执行代码
			});
	}
	    $scope.enterEvent = function(e) {
        var keycode = window.event?e.keyCode:e.which;
        if(keycode==13){
            $scope.searchData();
        }
    }
}])