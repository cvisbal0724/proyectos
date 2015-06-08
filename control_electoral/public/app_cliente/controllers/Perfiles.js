confControllers.controller('PerfilesController', function ($scope,$location,authUsuario,SessionService,SessionSet,$state,$http) {

$scope.perfilesVO={id:0,nombre:'',_token:authUsuario.token()};
$scope.result={};
$scope.listaPerfiles=[];
$scope.listaModulos=[];
$scope.listaPerfilModulos=[];
	

	$scope.consultar_perfil_modulos=function(){

		$http.get("perfiles/consultarmodulo/"+$state.params.id_perfil).success(function(data, status, headers, config) {
			$scope.listaPerfilModulos=data;
		});

	}

	$scope.consultar_modulos=function(){

		$http.get("perfiles/consultarmodulosnoagregados/"+$state.params.id_perfil).success(function(data, status, headers, config) {
			$scope.listaModulos=data;
		});

	}

	$scope.guardar=function(){
		
		if ($scope.perfilesVO.nombre=='') {$scope.result={"show":true,"alert":"warning","msg":"Ingrese el nombre."}; return false;};	
		
		$http.post("perfiles/guardar",$scope.perfilesVO).success(function(data, status, headers, config) {
		
		 	$scope.result=data;
		 	if (data.alert=='success') {	
		 		$scope.listaPerfiles=data.data;	 		
		 		$scope.nuevo();
		 	};
		 	
	      });
	}

	$scope.nuevo=function(){
		$scope.perfilesVO.id=0;
		$scope.perfilesVO.nombre='';
	}


	$scope.consultar=function(){

		$http.post("perfiles/consultar",$scope.perfilesVO).success(function(data, status, headers, config) {
			$scope.listaPerfiles=data;
		});

	}

	$scope.consultar_por_codigo=function(obj){
		
		$http.get("perfiles/consultarporcodigo/"+obj.id).success(function(data, status, headers, config) {
			$scope.perfilesVO=data;		 	
		});
	}

	$scope.ver_perfil_modulos=function(){
		$state.go('home.perfil_modulos');
	}
	
	$scope.agregar_modulos=function(){

		var lista=[];

		angular.forEach($scope.listaModulos,function(prop,i){
			if (prop.procesar==true) {
				lista.push({id_perfil:$state.params.id_perfil,id_modulo:prop.id});
			};			
		});

		$http.post("perfiles/agregarmodulos",{_token:authUsuario.token(),listaModulos:lista})
		.success(function(data, status, headers, config) {
			//$scope.listaModulos=data;
			$state.go($state.current, {}, {reload: true});
		});

	}

	$scope.selecionar_modulos=function(chk){
		angular.forEach($scope.listaModulos,function(prop, i){
			prop.procesar=chk;
		});
	}

	$scope.eliminar_perfil_modulo=function(obj){

		$http.post("perfiles/eliminarperfilmodulo",{_token:authUsuario.token(),id_perfil_modulo:obj.id})
		.success(function(data, status, headers, config) {
			$state.go($state.current, {}, {reload: true});
		});

	}

});