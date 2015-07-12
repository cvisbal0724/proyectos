confControllers.controller('LiderController', function ($scope,$location,authUsuario,SessionService,SessionSet,$state,$http) {

$scope.liderVO={id:0,id_persona:0,foto:null};
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

	var formData= new FormData();

	formData.append('id',$scope.liderVO.id);
	formData.append('id_persona',$scope.liderVO.id_persona);
	formData.append('foto',$scope.liderVO.foto);
	//formData.append('_token',$scope.liderVO._token);

	$http.post("lider/crear",formData,
		{transformRequest: angular.identity,
            headers: {'Content-Type': undefined}})
	.success(function(data, status, headers, config) {
		
		 	$scope.result=data;
		 	if (data.alert=='success') {		 		
		 		$scope.nuevo();
		 	};
		 	
	});
}

$scope.actualizar=function(){
	$scope.liderVO.id_persona=$scope.liderVO.id_persona[0];
	if (!$scope.liderVO.id_persona > 0) {$scope.result={"show":true,"alert":"warning","msg":"Seleccione la persona."}; return false;};
	
	var formData= new FormData();

	formData.append('id',$scope.liderVO.id);
	formData.append('id_persona',$scope.liderVO.id_persona);
	formData.append('foto',$scope.liderVO.foto);
	//formData.append('_token',$scope.liderVO._token);

	$http.post("usuario/actualizar",formData,
		{transformRequest: angular.identity,
            headers: {'Content-Type': undefined}})
		.success(function(data, status, headers, config) {
		
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
		$http.post("lider/consultar?page="+page,$scope.criterios).success(function(data, status, headers, config) {
			$scope.listaLideres=data;	
			$scope.paginas=Array();
			for (var i = 1; i <= $scope.listaLideres.last_page; i++) {
				 	$scope.paginas.push(i);
			};	 	
		});
	}

$scope.nuevo=function(){
	$scope.liderVO={id:0,id_persona:0};
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

	$http.post("lider/agregarliderconcejales",{listaConcejales:lista})
	.success(function(data, status, headers, config) {
		
		 $scope.listaLiderConcejales=data;
		 	
	 });
}

$scope.consultar_lider_concejales=function(){
	$http.post("lider/consultarliderconcejales",{id_lider:$state.params.id_lider})
	.success(function(data, status, headers, config) {
		
		 $scope.listaLiderConcejales=data;
		 	
	 });
}

$scope.eliminal_lider_concejales=function(item){

	swal({   
	title: "Esta seguro?",   
	text: "Desea eliminar el concejal!",   
	type: "warning",   
	showCancelButton: true,   
	confirmButtonColor: "#DD6B55",  
	confirmButtonText: "Si!", 
	cancelButtonText:'No',  
	closeOnConfirm: false }, function(){   
		
		$http.post("lider/eliminarliderconcejales",{id_lider:item.id_lider,id_concejal:item.id_concejal})
			.success(function(data, status, headers, config) {

		swal("Eliminado!", "El concejal fue removido del lider satisfactoriamente", "success"); 
		 $scope.listaLiderConcejales=data;
		 	
	 });
	
	});
	
}

$scope.abrir_modal=function(item){
	$scope.lider_concejal=item;
}

});