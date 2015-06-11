confControllers.controller('UsuarioController', function ($scope,$location,authUsuario,SessionService,SessionSet,$state,$http) {

$scope.usuarioVO={id:0,usuario:'',id_persona:0,id_perfil:0,_token:authUsuario.token()};
$scope.result={};
$scope.listaUsuarios=[];
$scope.criterio='';
$scope.listaPersonas=[];

$scope.crear=function(){
	$http.post("usuario/crear",$scope.usuarioVO).success(function(data, status, headers, config) {
		
		 	$scope.result=data;
		 	if (data.alert=='success') {
		 		$scope.listaAlcaldes=data.data;
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


});