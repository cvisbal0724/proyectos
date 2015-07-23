confControllers.controller('VotanteController', function ($scope,$location,authUsuario,SessionService,SessionSet,$state,$http) {

$scope.votanteVO={id:'',
				  id_persona:0,				  
				  id_concejal:0,
				  voto:false,
				  id_tipo_voto:0,
				  id_categoria_votacion:0,
				  comentario:'',
				  id_lugar_de_votacion:0,
				  numero_mesa:0,
				  dar_de_baja:false,
				  comentario_de_baja:'',
				  persona:{}};
$scope.result={};
$scope.listaVotantes=[];
$scope.criterio='';
$scope.listaPersonas=[];
$scope.concejales=[];
$scope.lideres=[];
$scope.id_concejales='';
$scope.id_lideres='';

$scope.consultar_por_codigo=function(id){
		
    $http.get("votante/consultarporcodigo/"+id).success(function(data, status, headers, config) {
    	$scope.votanteVO=data;		 	
    	$scope.listaPersonas.push(data.persona);
    	$scope.votanteVO.id_persona=data.id_persona;
    });

}

	if ($state.params.id>0) {
		$scope.consultar_por_codigo($state.params.id);
	};

$scope.crear=function(){
	$scope.votanteVO.id_persona=$scope.votanteVO.id_persona[0];
	if (!$scope.votanteVO.id_persona > 0) {$scope.result={"show":true,"alert":"warning","msg":"Seleccione la persona."}; return false;};
	$http.post("votante/crear",$scope.votanteVO).success(function(data, status, headers, config) {
		
		 	$scope.result=data;
		 	if (data.alert=='success') {		 		
		 		$scope.nuevo();
		 	};
		 	
	});
}

$scope.actualizar=function(){
	$scope.votanteVO.id_persona=$scope.votanteVO.id_persona[0];
	if (!$scope.votanteVO.id_persona > 0) {$scope.result={"show":true,"alert":"warning","msg":"Seleccione la persona."}; return false;};
	$http.post("votante/actualizar",$scope.votanteVO).success(function(data, status, headers, config) {
		
		 	$scope.result=data;
		 	if (data.alert=='success') {		 		
		 		$scope.nuevo();		 		
		 	};
		 	
	});
}

$scope.consultar_persona_por_criterios=function(){
	$http.post("persona/consultarporcriterios",{criterio:$scope.criterio})
	.success(function(data, status, headers, config) {
		
		 $scope.listaPersonas=data;
		 	
	 });
}

$scope.consultar=function(page){

		if (page==undefined) {page=1};
		$http.post("votante/consultar?page="+page,$scope.criterios).success(function(data, status, headers, config) {
			$scope.listaVotantes=data;	
			$scope.paginas=Array();
			for (var i = 1; i <= $scope.listaVotantes.last_page; i++) {
				 	$scope.paginas.push(i);
			};	 	
		});
	}

$scope.nuevo=function(){
	$scope.votanteVO={id:0,usuario:'',id_persona:0,id_perfil:0};
}

$scope.dar_de_baja=function(){

	if (!$scope.votanteVO.comentario_de_baja > 0) {$scope.result={"show":true,"alert":"warning","msg":"Ingrese la observación."}; return false;};
	$http.post("votante/dardebaja",{id:$scope.votanteVO.id,observacion:$scope.votanteVO.comentario_de_baja})
	.success(function(data, status, headers, config) {
		
		 $scope.result=data;
		 	
	 });
}

$scope.consultarconcejalylider=function(){

	$http.post("votante/consultarconcejalylider",{})
	.success(function(data, status, headers, config) {
		
		 $scope.concejales=data.concejales;
		 $scope.lideres=data.lideres;
		 	
	 });

}

$scope.consultar_votar_por=function(){
	alert($scope.votanteVO.id_persona);
}

$scope.agregar_id_concejal=function(obj) {
	$scope.id_concejales='';
	angular.forEach($scope.concejales,function(prop,i){
		$scope.id_concejales+=prop.id+',';
	});
}

$scope.agregar_id_lider=function(obj) {
	angular.forEach($scope.lideres,function(prop,i){
		$scope.id_lideres+=prop.id+',';
	});
}

$scope.exportar_votantes=function(){

	//window.location='votante/exportarpdf/'+$scope.id_concejales +'/'+$scope.id_lideres;	target="_blank" done=1;
 	window.open('votante/exportarpdf/'+$scope.id_concejales +'/'+$scope.id_lideres,'_blank');
}

});