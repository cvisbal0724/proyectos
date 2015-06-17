confControllers.controller('AlcaldeController', function ($scope,$location,authUsuario,SessionService,SessionSet,$state,$http) {

	$scope.alcaldeVO={id:0,nombre:'',id_partido:0,numero:0,_token:authUsuario.token()};
	$scope.result={};
	$scope.listaAlcaldes=[];

	

	$scope.guardar=function(){

		var formData= new FormData();
		formData.append('id',$scope.alcaldeVO.id);
		formData.append('nombre',$scope.alcaldeVO.nombre);
		formData.append('id_partido',$scope.alcaldeVO.id_partido);
		formData.append('numero',$scope.alcaldeVO.numero);
		formData.append('foto',$scope.alcaldeVO.foto);
		formData.append('_token',$scope.alcaldeVO._token);

		$http.post("alcalde/guardar",formData,
			{transformRequest: angular.identity,
            headers: {'Content-Type': undefined}}).success(function(data, status, headers, config) {
		
		 	$scope.result=data;
		 	if (data.alert=='success') {
		 		$scope.listaAlcaldes=data.data;
		 		$scope.nuevo();
		 	};
		 	
	      });
	}

	$scope.consultar=function(){

		$http.post("alcalde/consultar",{_token:authUsuario.token()}).success(function(data, status, headers, config) {
			$scope.listaAlcaldes=data;		 	
		});
	}

	$scope.nuevo=function(){
		$scope.alcaldeVO.id=0;
		$scope.alcaldeVO.nombre='';
		$scope.alcaldeVO.id_partido='';
		$scope.alcaldeVO.numero='0';
		$scope.alcaldeVO.foto=null;
		$scope.alcaldeVO._token=authUsuario.token()
	}

	$scope.consultar_por_codigo=function(obj){
		$http.get("/alcalde/consultarporcodigo/"+obj.id).success(function(data, status, headers, config) {
			$scope.alcaldeVO=data;		 	
		});
	}

});