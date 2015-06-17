confControllers.controller('UsuarioController', function ($scope,$location,authUsuario,SessionService,SessionSet,$state,$http) {

$scope.usuarioVO={id:0,usuario:'',id_persona:0,id_perfil:0,_token:authUsuario.token()};
$scope.result={};
$scope.listaUsuarios=[];
$scope.criterio='';
$scope.listaPersonas=[];


$scope.consultar_por_codigo=function(id){
		
		$http.get("usuario/consultarporcodigo/"+id).success(function(data, status, headers, config) {
			$scope.usuarioVO=data;		 	
			$scope.listaPersonas.push(data.persona);
			$scope.usuarioVO.id_persona=data.id_persona;
		});

	}

	if ($state.params.id>0) {
		$scope.consultar_por_codigo($state.params.id);
	};

$scope.crear=function(){

	$scope.usuarioVO.id_persona=$scope.usuarioVO.id_persona[0];

	if (!$scope.usuarioVO.id_persona > 0) {$scope.result={"show":true,"alert":"warning","msg":"Seleccione la persona."}; return false;};

	$http.post("usuario/crear",$scope.usuarioVO).success(function(data, status, headers, config) {
		
		 	$scope.result=data;
		 	if (data.alert=='success') {		 		
		 		$scope.nuevo();
		 	};
		 	
	});
}

$scope.actualizar=function(){
	$scope.usuarioVO.id_persona=$scope.usuarioVO.id_persona[0];
	if (!$scope.usuarioVO.id_persona > 0) {$scope.result={"show":true,"alert":"warning","msg":"Seleccione la persona."}; return false;};
	$http.post("usuario/actualizar",$scope.usuarioVO).success(function(data, status, headers, config) {
		
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
			$scope.listaUsuarios=data;	
			$scope.paginas=Array();
			for (var i = 1; i <= $scope.listaUsuarios.last_page; i++) {
				 	$scope.paginas.push(i);
			};	 	
		});
	}

$scope.nuevo=function(){
	$scope.usuarioVO={id:0,usuario:'',id_persona:0,id_perfil:0,_token:authUsuario.token()};
}

});