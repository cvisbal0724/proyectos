confControllers.controller('ConcejalController', function ($scope,$location,authUsuario,SessionService,SessionSet,$state,$http) {

$scope.concejalVO={id:0,numero:'',id_persona:0,id_partido:0,_token:authUsuario.token()};
$scope.result={};
$scope.listaConcejales=[];
$scope.criterio='';
$scope.listaPersonas=[];


$scope.consultar_por_codigo=function(id){
		
		$http.get("concejal/consultarporcodigo/"+id).success(function(data, status, headers, config) {
			$scope.concejalVO=data;		 	
			$scope.listaPersonas.push(data.persona);
			$scope.concejalVO.id_persona=data.id_persona;
		});

	}

	if ($state.params.id>0) {
		$scope.consultar_por_codigo($state.params.id);
	};

$scope.crear=function(){

	if ($scope.concejalVO.id_partido=='0') {$scope.result={show:true,alert:'warning',msg:'Seleccione el partido.'};return false;};

	$scope.concejalVO.id_persona=$scope.concejalVO.id_persona[0];

	if (!$scope.concejalVO.id_persona > 0) {$scope.result={"show":true,"alert":"warning","msg":"Seleccione la persona."}; return false;};

	$http.post("concejal/crear",$scope.concejalVO).success(function(data, status, headers, config) {
		
		 	$scope.result=data;
		 	if (data.alert=='success') {		 		
		 		$scope.nuevo();
		 	};
		 	
	});
}

$scope.actualizar=function(){
	
	if ($scope.concejalVO.id_partido=='0') {$scope.result={show:true,alert:'warning',msg:'Seleccione el partido.'};return false;};

	$scope.concejalVO.id_persona=$scope.concejalVO.id_persona[0];

	if (!$scope.concejalVO.id_persona > 0) {$scope.result={"show":true,"alert":"warning","msg":"Seleccione la persona."}; return false;};

	$http.post("concejal/actualizar",$scope.concejalVO).success(function(data, status, headers, config) {
		
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
		$http.post("concejal/consultar?page="+page,$scope.criterios).success(function(data, status, headers, config) {
			$scope.listaConcejales=data;	
			$scope.paginas=Array();
			for (var i = 1; i <= $scope.listaConcejales.last_page; i++) {
				 	$scope.paginas.push(i);
			};	 	
		});
	}

$scope.nuevo=function(){
	$scope.concejalVO={id:0,numero:'',id_persona:0,id_partido:0,_token:authUsuario.token()};
}



});