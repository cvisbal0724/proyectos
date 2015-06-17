confControllers.controller('PeriodoController', function ($scope,$location,authUsuario,SessionService,SessionSet,$state,$http) {

	$scope.periodoVO={
		id:0,
		fecha_inicio:'',
		fecha_final:'',
		id_responsable:'',
		nombre:'',
		_token:authUsuario.token()
	};
	$scope.ListaPeriodos=[];

	if ($state.params.id > 0) {

		$http.get("legalizaciones/consultarporcodigo/"+$state.params.id).success(function(data, status, headers, config) {

	 	$scope.periodoVO=data;
	 	
      });

	}

	/**
	 * [registrar invoca al registrar de el servidor]
	 * @return {[type]} [description]
	 */
	$scope.guardar=function(){

		if ($scope.periodoVO.id > 0) {

			$http.post("legalizaciones/actualizar",$scope.periodoVO).success(function(data, status, headers, config) {

		 	if (data=='Success') {
		 		alert('Actualizado con exito');  
		 		$state.go('home.consultar_periodo');
		 		//$scope.nuevo();
		 	}else{
		 		alert('error');   
		 	}
		 	
	      });

	}else{

	$http.post("legalizaciones/registrar",$scope.periodoVO).success(function(data, status, headers, config) {

	 	if (data=='Success') {
	 		alert(data);  
	 		$scope.nuevo();
	 	}else{
	 		alert('error');   
	 	}
	 	
      });	
	}

	}

	
	$scope.consultarPeriodo=function(){

	$http.post("legalizaciones/consultar",{_token:authUsuario.token()}).success(function(data, status, headers, config) {

	 	$scope.ListaPeriodos=data;
	 	
      });

	}
	/**
	 * [nuevo crea un nuevo periodo]
	 * @return {[type]} [description]
	 */
	$scope.nuevo=function(){

		$scope.periodoVO.id=0,
		$scope.periodoVO.fecha_inicio='',
		$scope.periodoVO.fecha_final='',
		$scope.periodoVO.nombre = '',
		$scope.periodoVO.id_responsable = '',
		$scope.periodoVO._token = authUsuario.token()

	}
	//change necesarios para los tipo fecha
	$('#datetimepicker1').on('dp.change', function(ev){                 
      $scope.periodoVO.fecha_inicio =$('#dtfechaInicio').val();
    });

    $('#datetimepicker2').on('dp.change', function(ev){                 
      $scope.periodoVO.fecha_final =$('#dtfechaFinal').val();
    });


});