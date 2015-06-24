confControllers.controller('LiderController', function ($scope,$location,authUsuario,SessionService,SessionSet,$state,$http) {

$scope.liderVO={id:0,id_persona:0,_token:authUsuario.token()};
$scope.result={};
$scope.listaLideres=[];
$scope.criterio='';
$scope.listaPersonas=[];
$scope.listaConcejales=[];
$scope.criterios={criterio:''};
$scope.lider_concejal={};

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

$scope.agregar_lider_concejales=function(){
	
	var lista=[];

	angular.forEach($scope.listaConcejales.data,function(prop,i){
		if (prop.procesar==true) {
			lista.push({meta:prop.meta,id_lider:$state.params.id_lider,id_concejal:prop.id});	
		};		
	});

	if (lista.length==0) {$scope.result={"show":true,"alert":"warning","msg":"Seleccione los concejales a agregar."}; return false;};

	$http.post("lider/agregarliderconcejales",{listaConcejales:lista,_token:authUsuario.token()})
	.success(function(data, status, headers, config) {
		
		 //$scope.list=data;
		 	
	 });
}

$scope.consultar_lider_concejales=function(){
	$http.post("lider/consultarliderconcejales",{id_lider:$state.params.id_lider,_token:authUsuario.token()})
	.success(function(data, status, headers, config) {
		
		 $scope.listaLiderConcejales=data;
		 	
	 });
}

$scope.eliminal_lider_concejales=function(){
	$http.post("lider/eliminarliderconcejal",
		{id_lider:$scope.lider_concejal.id_lider,
			id_concejal:$scope.lider_concejal.id_concejal,
			_token:authUsuario.token()})
	.success(function(data, status, headers, config) {
		
		 $scope.listaLiderConcejales=data;
		 	
	 });
}

$scope.abrir_modal=function(item){
	$scope.lider_concejal=item;
}

});