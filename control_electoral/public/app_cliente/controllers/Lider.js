confControllers.controller('LiderController', function ($scope,$location,authUsuario,SessionService,SessionSet,$state,$http) {

$scope.liderVO={id:0,id_persona:0,_token:authUsuario.token()};
$scope.result={};
$scope.listaLideres=[];
$scope.criterio='';
$scope.listaPersonas=[];
$scope.listaConcejales=[];
$scope.criterios={criterio:''};


$scope.consultar_por_codigo=function(id){
		
		$http.get("usuario/consultarporcodigo/"+id).success(function(data, status, headers, config) {
			$scope.liderVO=data;		 	
			$scope.listaPersonas.push(data.persona);
			$scope.liderVO.id_persona=data.id_persona;
		});

	}

	if ($state.params.id>0) {
		$scope.consultar_por_codigo($state.params.id);
	};

$scope.crear=function(){

	$scope.liderVO.id_persona=$scope.liderVO.id_persona[0];

	if (!$scope.liderVO.id_persona > 0) {$scope.result={"show":true,"alert":"warning","msg":"Seleccione la persona."}; return false;};

	$http.post("lider/crear",$scope.liderVO).success(function(data, status, headers, config) {
		
		 	$scope.result=data;
		 	if (data.alert=='success') {		 		
		 		$scope.nuevo();
		 	};
		 	
	});
}

$scope.actualizar=function(){
	$scope.liderVO.id_persona=$scope.liderVO.id_persona[0];
	if (!$scope.liderVO.id_persona > 0) {$scope.result={"show":true,"alert":"warning","msg":"Seleccione la persona."}; return false;};
	$http.post("usuario/actualizar",$scope.liderVO).success(function(data, status, headers, config) {
		
		 	$scope.result=data;
		 	if (data.alert=='success') {		 		
		 		$scope.nuevo();		 		
		 	};
		 	
	});
}

$scope.consultar_persona_por_criterios=function(){
	$http.post("persona/consultarporcriterios",{criterio:$scope.criterio,_token:authUsuario.token()})
	.success(function(data, status, headers, config) {
		
		 $scope.listaPersonas=data;
		 	
	 });
}

$scope.consultar=function(page){

		if (page==undefined) {page=1};
		$http.post("lider/consultar?page="+page,$scope.criterios).success(function(data, status, headers, config) {
			$scope.listaLideres=data;	
			$scope.paginas=Array();
			for (var i = 1; i <= $scope.listaLideres.last_page; i++) {
				 	$scope.paginas.push(i);
			};	 	
		});
	}

$scope.nuevo=function(){
	$scope.liderVO={id:0,id_persona:0,_token:authUsuario.token()};
}

$scope.consultar_concejal=function(page){

		if (page==undefined) {page=1};
		$http.post("concejal/consultar?page="+page,$scope.criterios).success(function(data, status, headers, config) {
			$scope.listaConcejales=data;	
			$scope.paginas=Array();
			for (var i = 1; i <= $scope.listaConcejales.last_page; i++) {
				 	$scope.paginas.push(i);
			};	 	
		});
	}

});