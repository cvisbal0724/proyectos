confControllers.controller('ActivarCuentaController', function ($scope,$http,$routeParams,$filter,filterFilter,$route,$location,$interval,$state) {

	var stop;
	$scope.key=$state.params.key;
	$scope.emnsaje='';
	$scope.valor=0;
	$scope.result={};

	 $http.post("usuario/activar",{key:$scope.key}).success(function(data, status, headers, config) {

         $scope.result=data;
          
         if ($scope.result.alert=='success') { 
               	
         	$('#modalActivar').modal('show');
         	$scope.startTime();
         };       
      });
	 
	 $scope.startTime=function(){
	 	 stop = $interval(function() {
	  	if ($scope.valor<=3) {
	  		$scope.valor=$scope.valor+1;
	  	}else{
			$scope.stopInt();
	  	}
	  },1000);
	 }	 
     
	  $scope.stopInt = function() {
          if (angular.isDefined(stop)) {
            $interval.cancel(stop);
            stop = undefined;
            $state.go('login');
          }
      };

});