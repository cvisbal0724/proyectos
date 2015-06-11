confControllers.controller('MasInformacionController', function ($scope,$http,$routeParams,$filter,filterFilter,$location,$state) {

	$scope.pqr={id_tipo_pqr:'',nombres:'',apellidos:'',email:'',telefono:'',comentario:''};
	$scope.result={};

	 $scope.guardarPQR=function(){

	 	if ($scope.pqr.nombres=='' || $scope.pqr.email=='' ||
	 		$scope.pqr.id_tipo_pqr=='' || $scope.pqr.comentario=='') {
	 		$scope.result={alert:'warning', msg:'Por favor ingrese los campos que son requeridos.', show:true};
	 		return false;
	 	}else{

	     $http.post("pqr/crear",$scope.pqr)
	      .success(function(data, status, headers, config) {         
	          	$scope.result=data;
	          if($scope.result.alert=='success')	
	          	$scope.nuevo();         
	      });

  		}

    }

    $scope.nuevo=function(){
    	$scope.pqr.id_tipo_pqr='';
		$scope.pqr.nombres='';
		$scope.pqr.apellidos='';
		$scope.pqr.email='';
		$scope.pqr.telefono='';
		$scope.pqr.comentario='';
    }


    

});