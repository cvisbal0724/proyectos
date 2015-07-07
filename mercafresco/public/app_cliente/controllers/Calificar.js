confControllers.controller('CalificarController', function ($scope,$http,$routeParams,$filter,filterFilter,$location,$state) {

	$scope.ordenServicio={};
	$scope.calificar={key:$state.params.key,puntuacion:null,comentario:''};
   
    $scope.obtener_por_codigo=function(){

      $http.post("ordenservicio/obtenerporcodigo",{key:$state.params.key})
      .success(function(data, status, headers, config) {
          $scope.ordenServicio=data; 
      });

    }
	 
	 $scope.guardar=function(){

      $http.post("calificanos/crear",$scope.calificar)
      .success(function(data, status, headers, config) {
          //$scope.ordenServicio=data; 
      });

    }   
      
});