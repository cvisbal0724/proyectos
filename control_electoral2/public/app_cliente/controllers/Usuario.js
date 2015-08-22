confControllers.controller('UsuarioController', function ($scope,$location,authUsuario,SessionService,SessionSet,$state,$http) {

$scope.usuarioVO={id:0,usuario:'',id_persona:0,id_perfil:0};
$scope.result={};
$scope.listaUsuarios=[];
$scope.criterio='';
$scope.listaPersonas=[];
$scope.cambiar_claveVO={clave_actual:'',clave_nueva:'',confirmar:''};

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
	$http.post("persona/consultarporcriterios",{criterio:$scope.criterio})
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
	$scope.usuarioVO={id:0,usuario:'',id_persona:0,id_perfil:0};
	$scope.cambiar_clave={clave_actual:'',clave_nueva:'',confirmar:''};
}

$scope.cambiar_clave=function(){
	
	if ($scope.cambiar_claveVO.clave_actual =='') {$scope.result={"show":true,"alert":"warning","msg":"Ingrese la contraseña actual."}; return false;};
	if ($scope.cambiar_claveVO.clave_nueva =='') {$scope.result={"show":true,"alert":"warning","msg":"INgrese la nueva contraseña."}; return false;};
	if ($scope.cambiar_claveVO.confirmar =='') {$scope.result={"show":true,"alert":"warning","msg":"Confirme la nueva contraseña."}; return false;};
	if ($scope.cambiar_claveVO.confirmar != $scope.cambiar_claveVO.clave_nueva) {$scope.result={"show":true,"alert":"warning","msg":"Las contraseñas no coinciden."}; return false;};

	 $http.post("usuario/cambiarclave",$scope.cambiar_claveVO)
	 .success(function(data, status, headers, config) {
	 	if (data=='success') {
	 		$scope.result={"show":true,"alert":"success","msg":"Contraseña cambiada satisfactoriamente."};	
	 		$scope.nuevo();
	 	}else{
	 		$scope.result={"show":true,"alert":"danger","msg":data};
	 	}
	 	 
	 });
	 	
}

$scope.bloquear_usuario=function (item) {
	
	swal({   
		title: "Esta seguro?",   
		text: "Desea bloquear el usuario " + item.nombre + ' ' + item.apellido,   
		type: "warning",   
		showCancelButton: true,   
		confirmButtonColor: "#DD6B55",  
		confirmButtonText: "Si!", 
		cancelButtonText:'No',  
		closeOnConfirm: false }, function(){   
		
		$http.post("usuario/bloquearusuario",{id:item.id})
		.success(function(data, status, headers, config) {
			
			if (data.result) {
				swal({
				title:"Usuario bloqueado satisfactoriamente.", 
				text:data.msg, 
				type:"success",
				confirmButtonColor: "#DD6B55",  
				confirmButtonText: "Ok", 
				//cancelButtonText:'No',  
				closeOnConfirm: true},function(){
					
				}); 
				item.bloqueado=1;
			};
			
			if (!data.result) {
				swal({
				title:"No se pudo bloquear el usuario.", 
				text:data.msg, 
				type:"error",
				confirmButtonColor: "#DD6B55",  
				confirmButtonText: "Ok", 
				//cancelButtonText:'No',  
				closeOnConfirm: true},function(){
					
				}); 
			};
			
			 	
		 });
			
	
	});
}

$scope.desbloquear_usuario=function (item) {
	
	swal({   
		title: "Esta seguro?",   
		text: "Desea desbloquear el usuario " + item.nombre + ' ' + item.apellido,   
		type: "warning",   
		showCancelButton: true,   
		confirmButtonColor: "#DD6B55",  
		confirmButtonText: "Si!", 
		cancelButtonText:'No',  
		closeOnConfirm: false }, function(){   
		
		$http.post("usuario/desbloquearusuario",{id:item.id})
		.success(function(data, status, headers, config) {
			
			if (data.result) {
				swal({
				title:"Usuario desbloqueado satisfactoriamente.", 
				text:data.msg, 
				type:"success",
				confirmButtonColor: "#DD6B55",  
				confirmButtonText: "Ok", 
				//cancelButtonText:'No',  
				closeOnConfirm: true},function(){
				
				}); 
				item.bloqueado=0;	
			};
			
			if (!data.result) {
				swal({
				title:"No se pudo desbloquear el usuario.", 
				text:data.msg, 
				type:"error",
				confirmButtonColor: "#DD6B55",  
				confirmButtonText: "Ok", 
				//cancelButtonText:'No',  
				closeOnConfirm: true},function(){
					
				}); 
			};
			
			 	
		 });
			
	
	});
}

});