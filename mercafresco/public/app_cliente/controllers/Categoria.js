confControllers.controller('CategoriaController', function ($scope,$http,$routeParams,$filter,filterFilter,$location,$state) {

		$scope.listaCategoria=[];

    $scope.obtenerTodos=function(){

      $http.post("categoria/obtenertodos",{})
      .success(function(data, status, headers, config) {
          $scope.listaCategoria=data; 
      });

    }
	   
      
});