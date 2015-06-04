confControllers.controller('PartidoController', function ($scope,$location,authUsuario,SessionService,SessionSet,$state,$http) {

	$scope.partidoVO={nombre:'',_token:authUsuario.token()};

	$scope.guardar=function(){
		$http.post("partido/crear",$scope.partidoVO).success(function(data, status, headers, config) {

		 	if (data=='Success') {
		 		alert(data);  
		 		//$scope.nuevo();
		 	}else{
		 		alert(data);   
		 	}
		 	
	      });
	}

});