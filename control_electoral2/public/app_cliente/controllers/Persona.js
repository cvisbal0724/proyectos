confControllers.controller('PersonaController', function ($scope,$location,authUsuario,SessionService,SessionSet,$state,$http) {

	$scope.personaVO={id:0,
	cedula:'',
	nombre:'',
	apellido:'',
	telefono:'',
	direccion:'',
	correo:'',
	id_alcalde:'0',
	barrio:''
	//_token:authUsuario.token()
	};
	$scope.result={};
	$scope.listaPersonas=[];
	$scope.paginas=Array();
	$scope.criterios={criterio:''}
	

	$scope.consultar_por_codigo=function(id){
		
		$http.get("persona/consultarporcodigo/"+id).success(function(data, status, headers, config) {
			$scope.personaVO=data;		 	
		});
	}

	if ($state.params.id > 0) {		
		$scope.consultar_por_codigo($state.params.id);
	};

	$scope.crear=function(){
		
		if ($scope.personaVO.cedula=='') {$scope.result={"show":true,"alert":"warning","msg":"Ingrese la cedula."}; return false;};	
		if ($scope.personaVO.nombre=='') {$scope.result={"show":true,"alert":"warning","msg":"Ingrese el nombre."}; return false;};	
		if ($scope.personaVO.apellido=='') {$scope.result={"show":true,"alert":"warning","msg":"Ingrese el apellido."}; return false;};	
		if ($scope.personaVO.id_alcalde=='0') {$scope.result={"show":true,"alert":"warning","msg":"Seleccione el alcalde."}; return false;};	

		$http.post("persona/crear",$scope.personaVO).success(function(data, status, headers, config) {
		
		 	$scope.result=data;
		 	if (data.alert=='success') {		 		
		 		$scope.nuevo();
		 	};
		 	
	      });
	}

$scope.crear_nueva_persona=function(){
		
		if ($scope.personaVO.cedula=='') {$scope.result={"show":true,"alert":"warning","msg":"Ingrese la cedula."}; return false;};	
		if ($scope.personaVO.nombre=='') {$scope.result={"show":true,"alert":"warning","msg":"Ingrese el nombre."}; return false;};	
		if ($scope.personaVO.apellido=='') {$scope.result={"show":true,"alert":"warning","msg":"Ingrese el apellido."}; return false;};	
		
		$http.post("persona/crearnuevapersona",$scope.personaVO).success(function(data, status, headers, config) {
		
		 	$scope.result=data;
		 	if (data.alert=='success') {		 		
		 		$scope.nuevo();
		 	};
		 	
	      });
	}

	$scope.actualizar=function(){
		
		if ($scope.personaVO.cedula=='') {$scope.result={"show":true,"alert":"warning","msg":"Ingrese la cedula."}; return false;};	
		if ($scope.personaVO.nombre=='') {$scope.result={"show":true,"alert":"warning","msg":"Ingrese el nombre."}; return false;};	
		if ($scope.personaVO.apellido=='') {$scope.result={"show":true,"alert":"warning","msg":"Ingrese el apellido."}; return false;};	
		if ($scope.personaVO.id_alcalde=='') {$scope.result={"show":true,"alert":"warning","msg":"Seleccione el alcalde."}; return false;};	
	
		$http.post("persona/actualizar",$scope.personaVO).success(function(data, status, headers, config) {
		
		 	$scope.result=data;
		 	if (data.alert=='success') {		 		
		 		$state.go('home.consultar_personas');
		 	};
		 	
	      });
	}

$scope.actualizar_nueva_persona=function(){
		
		if ($scope.personaVO.cedula=='') {$scope.result={"show":true,"alert":"warning","msg":"Ingrese la cedula."}; return false;};	
		if ($scope.personaVO.nombre=='') {$scope.result={"show":true,"alert":"warning","msg":"Ingrese el nombre."}; return false;};	
		if ($scope.personaVO.apellido=='') {$scope.result={"show":true,"alert":"warning","msg":"Ingrese el apellido."}; return false;};	
			
		$http.post("persona/actualizarnuevapersona",$scope.personaVO).success(function(data, status, headers, config) {
		
		 	$scope.result=data;
		 	if (data.alert=='success') {		 		
		 		$state.go('home.consultar_personas');
		 	};
		 	
	      });
	}

	$scope.consultar=function(page){

		if (page==undefined) {page=1};
		$http.post("persona/consultar?page="+page,$scope.criterios).success(function(data, status, headers, config) {
			$scope.listaPersonas=data;	
			$scope.paginas=Array();
			for (var i = 1; i <= $scope.listaPersonas.last_page; i++) {
				 	$scope.paginas.push(i);
			};	 	
		});
	}

	$scope.nuevo=function(){
		$scope.personaVO.id=0;
		$scope.personaVO.cedula='';
		$scope.personaVO.nombre='';
		$scope.personaVO.apellido='';
		$scope.personaVO.telefono='';
		$scope.personaVO.direccion='';
		$scope.personaVO.correo='';
		$scope.personaVO.id_alcalde='0';
		$scope.personaVO.barrio='';
	}

	

});