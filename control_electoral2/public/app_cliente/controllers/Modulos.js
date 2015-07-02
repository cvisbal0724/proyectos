confControllers.controller('ModulosController', function ($scope,$location,authUsuario,SessionService,SessionSet,$state,$http) {

$scope.modulosVO={id:0,nombre:'',_token:authUsuario.token()};
$listaModulos=[];

$scope.guardar=function(){
		
		if ($scope.modulosVO.nombre=='') {$scope.result={"show":true,"alert":"warning","msg":"Ingrese el nombre."}; return false;};	
		
		$http.post("modulos/guardar",$scope.modulosVO).success(function(data, status, headers, config) {
		
		 	$scope.result=data;
		 	if (data.alert=='success') {	
		 		$scope.listaModulos=data.data;	 		
		 		$scope.nuevo();
		 	};
		 	
	      });
	}

$scope.nuevo=function(){
	$scope.modulosVO.id=0;
	$scope.modulosVO.nombre='';
	$scope.modulosVO._token=authUsuario.token();
}	

$scope.consultar=function(){
	$http.post("modulos/consultar",{_token:authUsuario.token()}).success(function(data, status, headers, config) {
			$scope.listaModulos=data;
		});
}

$scope.consultar_por_codigo=function(obj){
		
		$http.get("modulos/consultarporcodigo/"+obj.id).success(function(data, status, headers, config) {
			$scope.modulosVO=data;		 	
		});
	}


	$scope.eliminar_modulo=function(obj){

		swal({   
		title: "Esta seguro?",   
		text: "Desea eliminar el modulo!",   
		type: "warning",   
		showCancelButton: true,   
		confirmButtonColor: "#DD6B55",  
		confirmButtonText: "Si!", 
		cancelButtonText:'No',  
		closeOnConfirm: false }, function(){   
			
		   $http.post("modulos/eliminarmodulo",{_token:authUsuario.token(),id:obj.id})
		   .success(function(data, status, headers, config) {
		   	swal("Eliminado!", "El modulo fue removido satisfactoriamente", "success"); 
		   	//$state.go($state.current, {}, {reload: true});
		   	  $state.listaModulos=data;
		   });
						
		});
		

	}

});