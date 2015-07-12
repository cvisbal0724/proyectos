confControllers.controller('PartidoController', function ($scope,$location,authUsuario,SessionService,SessionSet,$state,$http) {

	$scope.partidoVO={id:0,nombre:'',logo:null};
	$scope.result={};
	$scope.listaPartidos=[];

	

	$scope.guardar=function(){

		var formData= new FormData();

		formData.append('id',$scope.partidoVO.id);
		formData.append('nombre',$scope.partidoVO.nombre);
		formData.append('logo',$scope.partidoVO.logo);
		formData.append('_token',$scope.partidoVO._token);

		$http.post("partido/guardar",formData,
			{transformRequest: angular.identity,
            headers: {'Content-Type': undefined}}).success(function(data, status, headers, config) {

		 	$scope.result=data;
		 	if (data.alert=='success') {
		 		$scope.listaPartidos=data.data;
		 		$scope.nuevo();
		 	};
		 	
	      });
	}

	$scope.consultar=function(){

		$http.post("partido/consultar",{}).success(function(data, status, headers, config) {
			$scope.listaPartidos=data;		 	
		});
	}

	$scope.nuevo=function(){
		$scope.partidoVO.id=0;
		$scope.partidoVO.nombre='';
		$scope.partidoVO.logo=null;
		$scope.partidoVO._token=authUsuario.token()
	}

	$scope.consultar_por_codigo=function(obj){
		$http.get("/partido/consultarporcodigo/"+obj.id).success(function(data, status, headers, config) {
			$scope.partidoVO=data;		 	
		});
	}

	$scope.eliminar=function(obj){

		swal({   
	title: "Esta seguro?",   
	text: "Desea eliminar el partido!",   
	type: "warning",   
	showCancelButton: true,   
	confirmButtonColor: "#DD6B55",  
	confirmButtonText: "Si!", 
	cancelButtonText:'No',  
	closeOnConfirm: false }, function(){   
		
		$http.post("partido/eliminar",{id:obj.id})
		.success(function(data, status, headers, config) {
			swal("Eliminado!", "El partido fue removido satisfactoriamente", "success"); 
			$state.go($state.current, {}, {reload: true});
		});
			
	});	
		

	}

});