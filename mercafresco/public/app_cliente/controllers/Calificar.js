confControllers.controller('CalificarController', function ($scope,$http,$routeParams,$filter,filterFilter,$location,$state) {

	$scope.ordenServicio={};
	$scope.calificar={key:$state.params.key,id:0,puntuacion:null,comentario:''};
  $scope.result={};

    $scope.obtener_por_codigo=function(){

      $http.post("calificanos/obtenercompraporcodigo",{key:$state.params.key})
      .success(function(data, status, headers, config) {
          $scope.ordenServicio=data.orden; 
          if (data.calificacion.id > 0) {
            $scope.calificar=data.calificacion; 
          };
      });

    }
	 
	 $scope.guardar=function(){
        
        if ($scope.calificar.puntuacion==null) {
          $scope.result={show:true,alert:'warning',msg:'Seleccione la calificacion.'};
          return false;
       }
       if ($scope.calificar.comentario=='') {
          $scope.result={show:true,alert:'warning',msg:'Ingrese el comentario.'};
          return false;
       }

      $http.post("calificanos/crear",$scope.calificar)
      .success(function(data, status, headers, config) {
          //$scope.ordenServicio=data; 
          if (data=='success') {
            $scope.result={show:true,alert:'success',msg:'Gracias por su calificacion.'};
            $state.go('productos');
          };
          
      });

    }   
      
});