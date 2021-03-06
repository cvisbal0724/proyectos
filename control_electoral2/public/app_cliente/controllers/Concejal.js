confControllers.controller('ConcejalController', function ($scope,$location,authUsuario,SessionService,SessionSet,$state,$http) {

$scope.concejalVO={id:0,numero:'',id_persona:0,id_partido:0,foto:null};
$scope.result={};
$scope.listaConcejales=[];
$scope.criterio='';
$scope.listaPersonas=[];
$scope.concejal_entregadoVO={id:0,observacion:'',valor:0,id_concejal:$state.params.id};
$scope.listaEntregas=[];

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

	var formData= new FormData();

	formData.append('id',$scope.concejalVO.id);
	formData.append('numero',$scope.concejalVO.numero);
	formData.append('id_persona',$scope.concejalVO.id_persona);
	formData.append('id_partido',$scope.concejalVO.id_partido);
	formData.append('foto',$scope.concejalVO.foto);
	//formData.append('_token',$scope.concejalVO._token);

	$http.post("concejal/crear",formData,
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
	
	if ($scope.concejalVO.id_partido=='0') {$scope.result={show:true,alert:'warning',msg:'Seleccione el partido.'};return false;};

	$scope.concejalVO.id_persona=$scope.concejalVO.id_persona[0];

	if (!$scope.concejalVO.id_persona > 0) {$scope.result={"show":true,"alert":"warning","msg":"Seleccione la persona."}; return false;};

	var formData= new FormData();

	formData.append('id',$scope.concejalVO.id);
	formData.append('numero',$scope.concejalVO.numero);
	formData.append('id_persona',$scope.concejalVO.id_persona);
	formData.append('id_partido',$scope.concejalVO.id_partido);
	formData.append('foto',$scope.concejalVO.foto);
	//formData.append('_token',$scope.concejalVO._token);

	$http.post("concejal/actualizar",formData,
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
	$scope.concejalVO={id:0,numero:'',id_persona:0,id_partido:0};	
}

$scope.nuevo_entraga=function(){

	$scope.concejal_entregadoVO={id:0,observacion:'',valor:0};

}

$scope.guardar_entregas=function(){

	if ($scope.concejal_entregadoVO.valor==0 || $scope.concejal_entregadoVO.valor=='') {$scope.result={show:true,alert:'warning',msg:'Agregue el valor.'};return false;};

	$http.post('concejal/guardarentregas',$scope.concejal_entregadoVO)
		.success(function(data, status, headers, config) {
			
			$scope.result=data;
			$scope.listaEntregas=data.data;
			$scope.concejal_entregadoVO={id:0,observacion:'',valor:0,id_concejal:$state.params.id};

		});

}

$scope.obtener_entregas=function(){

	$http.post('concejal/obtenerentregas',{})
		.success(function(data, status, headers, config) {
						
			$scope.listaEntregas=data;

	});
}

$scope.obtener_entregas_por_codigo=function(item){

	$http.post('concejal/obtenerentregasporcodigo',{id:item.id})
		.success(function(data, status, headers, config) {
						
			$scope.concejal_entregadoVO=data;			

	});
}

$scope.eliminar_entrega=function(item){
	
	swal({   
	title: "Esta seguro?",   
	text: "Desea eliminar el concejal!",   
	type: "warning",   
	showCancelButton: true,   
	confirmButtonColor: "#DD6B55",  
	confirmButtonText: "Si!", 
	cancelButtonText:'No',  
	closeOnConfirm: false }, function(){   
		
		$http.post('concejal/eliminarentregas',{id:item.id})
		.success(function(data, status, headers, config) {
			
			swal("Eliminado!", "El valor fue removido satisfactoriamente.", "success"); 			
			$scope.listaEntregas=data;

		});

	});

}

});

