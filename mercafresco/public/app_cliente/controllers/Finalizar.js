confControllers.controller('FinalizarController', function ($scope,$http,$routeParams,$filter,filterFilter,$route,$location,$interval) {

	
	$scope.OrdenServicio={};
	$scope.valor=0;
	var stop;

	 $http.post("ordenservicio/finalizar",{})
      .success(function(data, status, headers, config) {
          $scope.OrdenServicio=data; 
      });
      
	  stop = $interval(function() {
	  	if ($scope.valor<=20) {
	  		$scope.valor=$scope.valor+1;
	  	}else{
			$scope.stopInt();
	  	}
	  },1000);
     
	  $scope.stopInt = function() {
          if (angular.isDefined(stop)) {
            $interval.cancel(stop);
            stop = undefined;
            //$location.path('/productos');
          }
      };


      $scope.enviar_correo=function(){
      	$http.post("ordenservicio/enviarcorreo",{})
	      .success(function(data, status, headers, config) {
	         if (data=='success') {
	         	$scope.result={show:true,alert:'success',msg:'Se ha enviado el correo satisfactoriamente.'};
	         };
	      });
      }

});