confControllers.controller('MenuController', function ($scope,$location,authUsuario,SessionService,SessionSet,$state,$http) {

$scope.menuVO={
				id:0,
				nombre:'',
				etiqueta:'',
				id_padre:0,
				id_modulo:0,
				url:'',
				orden:1,
				imagen:'',
				_token:authUsuario.token()
				};
$scope.listaMenu=[];


$scope.crear=function(){
		
		/*if ($scope.personaVO.cedula=='') {$scope.result={"show":true,"alert":"warning","msg":"Ingrese la cedula."}; return false;};	
		if ($scope.personaVO.nombre=='') {$scope.result={"show":true,"alert":"warning","msg":"Ingrese el nombre."}; return false;};	
		if ($scope.personaVO.apellido=='') {$scope.result={"show":true,"alert":"warning","msg":"Ingrese el apellido."}; return false;};	
		if ($scope.personaVO.id_alcalde=='') {$scope.result={"show":true,"alert":"warning","msg":"Seleccione el alcalde."}; return false;};	*/
		$scope.menuVO.id_padre=$scope.currentNode.id;
		$scope.menuVO.id_modulo=$scope.currentNode.id_modulo;
		$http.post("menu/crear",$scope.menuVO).success(function(data, status, headers, config) {
		
		 	$scope.result=data;
		 	if (data.alert=='success') {		 		
		 		$scope.nuevo();
		 		$scope.listaMenu=data.data;
		 	};
		 	
	      });
	}


$scope.actualizar=function(){
		
		/*if ($scope.personaVO.cedula=='') {$scope.result={"show":true,"alert":"warning","msg":"Ingrese la cedula."}; return false;};	
		if ($scope.personaVO.nombre=='') {$scope.result={"show":true,"alert":"warning","msg":"Ingrese el nombre."}; return false;};	
		if ($scope.personaVO.apellido=='') {$scope.result={"show":true,"alert":"warning","msg":"Ingrese el apellido."}; return false;};	
		if ($scope.personaVO.id_alcalde=='') {$scope.result={"show":true,"alert":"warning","msg":"Seleccione el alcalde."}; return false;};	*/
		
		$http.post("menu/actualizar",$scope.menuVO).success(function(data, status, headers, config) {
		
		 	$scope.result=data;
		 	if (data.alert=='success') {		 		
		 		$scope.nuevo();
		 		$scope.listaMenu=data.data;
		 	};
		 	
	      });
	}	

$scope.consultar_por_modulo=function(){
	$http.get("menu/consultarmenupormodulo/"+$state.params.id_modulo).success(function(data, status, headers, config) {
		$scope.listaMenu=data;		 	
	});
}				

$scope.nuevo=function() {
	$scope.menuVO.id=0;
	$scope.menuVO.nombre='';
	$scope.menuVO.etiqueta='';
	$scope.menuVO.id_padre=0;
	$scope.menuVO.id_modulo=0;
	$scope.menuVO.url='';
	$scope.menuVO.orden=1;
	$scope.menuVO.imagen='';
}

$scope.consultar_por_codigo=function(){
		
		$http.get("menu/consultarporcodigo/"+$scope.currentNode.id).success(function(data, status, headers, config) {
			$scope.menuVO=data;		 	
		});
	}

$scope.eliminar=function(){
		
		$http.get("menu/eliminar/"+$scope.currentNode.id).success(function(data, status, headers, config) {
			if (data=='success') {
				//$state.go($state.current, {}, {reload: true});
				$scope.listaMenu=data;		 	
			};	 	
		});
	}	

});