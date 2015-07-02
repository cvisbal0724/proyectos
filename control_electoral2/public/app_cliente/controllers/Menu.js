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
		$http.post("menu/crear?todos="+($state.params.id_modulo > 0 ? '0' : '1'),$scope.menuVO)
		.success(function(data, status, headers, config) {
		
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
		
		$http.post("menu/actualizar?todos="+($state.params.id_modulo > 0 ? '0' : '1') ,$scope.menuVO)
		.success(function(data, status, headers, config) {
		
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
		
		swal({   
		title: "Esta seguro?",   
		text: "Desea eliminar el menu!",   
		type: "warning",   
		showCancelButton: true,   
		confirmButtonColor: "#DD6B55",  
		confirmButtonText: "Si!", 
		cancelButtonText:'No',  
		closeOnConfirm: false }, function(){   
		
		if ($state.params.id_modulo >0) {

			$http.get("menu/eliminar/"+$scope.currentNode.id + '?todos=0').success(function(data, status, headers, config) {
			
			swal("Eliminado!", "El menu fue removido satisfactoriamente", "success"); 
			$scope.listaMenu=data;		 	
			
			});

		}else{
			$http.get("menu/eliminar/"+$scope.currentNode.id + '?todos=1').success(function(data, status, headers, config) {
			
			swal("Eliminado!", "El menu fue removido satisfactoriamente", "success"); 
			$scope.listaMenu=data;		 	
			
			});
		}
			
	
	});
}


});