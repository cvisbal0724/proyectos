confControllers.controller('PartidoController', function ($scope,$location,authUsuario,SessionService,SessionSet,$state,$http) {

	$scope.partidoVO={id:0,nombre:'',logo:null,_token:authUsuario.token()};
	$scope.result={};
	$scope.listaPartidos=[];

	

	$scope.guardar=function(){

		var formData= new FormData();

		formData.append('id',$scope.partidoVO.id);
		formData.append('nombre',$scope.partidoVO.nombre);
		formData.append('logo',$scope.partidoVO.logo);
		formData.append('_token',$scope.partidoVO._token);

		$http.post("partido/guardar",formData,
			{transformRequest: angular.identity,
            headers: {'Content-Type': undefined}}).success(function(data, status, headers, config) {

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
		$scope.partidoVO.logo=null;
		$scope.partidoVO._token=authUsuario.token()
	}

	$scope.consultar_por_codigo=function(obj){
		$http.get("/partido/consultarporcodigo/"+obj.id).success(function(data, status, headers, config) {
			$scope.partidoVO=data;		 	
		});
	}

	$scope.eliminar=function(obj){

		$http.post("partido/eliminar",{_token:authUsuario.token(),id:obj.id})
		.success(function(data, status, headers, config) {
			$state.go($state.current, {}, {reload: true});
		});

	}

});