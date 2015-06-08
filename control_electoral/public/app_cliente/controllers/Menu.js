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

$scope.consultar_por_modulo=function(){
	$http.get("menu/consultarmenupormodulo/"+$state.params.id_modulo).success(function(data, status, headers, config) {
		$scope.listaMenu=data;		 	
	});
}				

});