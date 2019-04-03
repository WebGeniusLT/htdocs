
 <!DOCTYPE html>
<html ng-app="ajaxApply">
	<head>
		<meta charset="utf-8">
		<title>ajax请求</title>
	</head>
<body>
	<div ng-controller="ctrl">
		<table width="100%">
		<!-- 	<tr ng-repeat="item in farmDatas">
				<td width="33%">{{LTM526 + item.process_id}}</td>
				<td width="33%">{{item.seed_type}}</td>
				<td width="33%">{{item.creating_time}}</td>
			</tr>
		</table> -->
		<p>
			{{farmDatas}}
		</p>
	</div>
	<script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
	<!-- angularjs框架 -->
	<script src="https://cdn.bootcss.com/angular.js/1.6.3/angular.min.js"></script>
	<!-- bootstrap框架 -->
	<script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		var app = angular.module('ajaxApply', []);
		app.controller('ctrl', ['$scope','$q', function($scope,$q){
			var defferd = $q.defer();
			$.ajax({
				url: 'src/php/test.php',
				type: 'GET',
				dataType: '',
				data: {},
				success: function(result,status,xhr) {
					// defferd.resolve(xhr.getResponseHeader("Server"));
					// defferd.resolve(xhr);
					// var response = {
					// 	data: result,
					// 	status: status,
					// 	xhr: xhr
					// }
					// defferd.resolve(response);
					console.log("result: " + result)
					defferd.resolve.apply(defferd,arguments);
				},
				error: function(xhr,status,error) {
					defferd.reject(error);
				}
			});
			defferd.promise
			.then(
				function(response){
                	// $scope.farmDatas = response.xhr.getResponseHeader("Server");
                	// $scope.farmDatas = response.getResponseHeader("Server");
                	$scope.farmDatas = JSON.parse(response).sites;
                	// $scope.farmDatas = response.sites;
                	console.log(response);
            	},function(response){
                	$scope.farmDatas = response;
            	}
            );
			
		}]);
	</script>
</body>
</html>