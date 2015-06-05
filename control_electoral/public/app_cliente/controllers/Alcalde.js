confControllers.controller('AlcaldeController', function ($scope,$location,authUsuario,SessionService,SessionSet,$state,$http) {

	$scope.alcaldeVO={id:0,nombre:'',id_partido:0,numero:0,_token:authUsuario.token()};
	$scope.result={};
	$scope.listaAlcaldes=[];

	

	$scope.guardar=function(){

		$http.post("partido/crear",$scope.alcaldeVO)
		.success(function(data, status, headers, config) {

		 	$scope.result=data;
		 	if (data.alert=='success') {
		 		$scope.listaAlcaldes=data.data;
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
		$scope.partidoVO.logo=null;
		$scope.partidoVO._token=authUsuario.token()
	}

	$scope.consultar_por_codigo=function(obj){
		$http.get("/partido/consultarporcodigo/"+obj.id).success(function(data, status, headers, config) {
			$scope.partidoVO=data;		 	
		});
	}

});