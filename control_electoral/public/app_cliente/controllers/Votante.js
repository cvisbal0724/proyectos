confControllers.controller('VotanteController', function ($scope,$location,authUsuario,SessionService,SessionSet,$state,$http) {

$scope.votanteVO={id:'',
				  id_persona:'0',				  
				  id_concejal:'0',
				  voto:false,
				  id_tipo_voto:'0',
				  id_categoria_votacion:'0',
				  comentario:'',
				  id_lugar_de_votacion:'0',
				  numero_mesa:'0',
				  dar_de_baja:false,
				  comentario_de_baja:'',
				  _token:authUsuario.token()};
$scope.result={};
$scope.listaVotantes=[];
$scope.criterio='';
$scope.listaPersonas=[];


$scope.consultar_por_codigo=function(id){
		
		$http.get("usuario/consultarporcodigo/"+id).success(function(data, status, headers, config) {
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
	$http.post("usuario/crear",$scope.votanteVO).success(function(data, status, headers, config) {
		
		 	$scope.result=data;
		 	if (data.alert=='success') {		 		
		 		$scope.nuevo();
		 	};
		 	
	});
}

$scope.actualizar=function(){
	$scope.votanteVO.id_persona=$scope.votanteVO.id_persona[0];
	if (!$scope.votanteVO.id_persona > 0) {$scope.result={"show":true,"alert":"warning","msg":"Seleccione la persona."}; return false;};
	$http.post("usuario/actualizar",$scope.votanteVO).success(function(data, status, headers, config) {
		
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
		$http.post("usuario/consultar?page="+page,$scope.criterios).success(function(data, status, headers, config) {
			$scope.listaVotantes=data;	
			$scope.paginas=Array();
			for (var i = 1; i <= $scope.listaVotantes.last_page; i++) {
				 	$scope.paginas.push(i);
			};	 	
		});
	}

$scope.nuevo=function(){
	$scope.votanteVO={id:0,usuario:'',id_persona:0,id_perfil:0,_token:authUsuario.token()};
}

});