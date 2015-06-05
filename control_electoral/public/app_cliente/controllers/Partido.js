confControllers.controller('PartidoController', function ($scope,$location,authUsuario,SessionService,SessionSet,$state,$http) {

	$scope.partidoVO={id:0,nombre:'',_token:authUsuario.token()};
	$scope.result={};
	$scope.listaPartidos=[];

	

	$scope.guardar=function(){
		$http.post("partido/crear",$scope.partidoVO).success(function(data, status, headers, config) {

		 	$scope.result=data;
		 	if (data.alert=='success') {
		 		$scope.listaPartidos=data.data;
		 		$scope.nuevo();
		 	};
		 	
	      });
	}

	$scope.consultar=function(){

		$http.post("partido/consultar",{_token:authUsuario.token()}).success(function(data, status, headers, config) {
			$scope.listaPartidos=data;		 	
		});
	}

	$scope.nuevo=function(){
		$scope.partidoVO.id=0;
		$scope.partidoVO.nombre='';
		$scope.partidoVO._token=authUsuario.token()
	}

	$scope.consultar_por_codigo=function(obj){
		$http.get("/partido/consultarporcodigo/"+obj.id).success(function(data, status, headers, config) {
			$scope.partidoVO=data;		 	
		});
	}

});