confControllers.controller('TiemposController', function ($scope,$http,$routeParams,$filter,filterFilter,$route,$location,$state) {

	
	$scope.listaTiempos=[];
	$scope.mensaje='';

	 /*$http.post("tiempos/obtenertodos",{})
      .success(function(data, status, headers, config) {
          $scope.listaTiempos=data; 
      });*/

            
	  $scope.irDireccion=function(){       
      	$state.go("direcciones");
      }

       $scope.seleccionar_tiempo=function($event, id,hora, fecha){       
      		
      	var checkbox = $event.target;
	      	if (checkbox.checked) {
			 $http.post("tiempos/seleccionartiempo",{hora:hora,fecha:fecha})
		      .success(function(data, status, headers, config) {
		          
		      });
		    };	

      }

      $scope.irMetodos_de_pago=function(){
      	 $http.get("tieneTiempo")
		      .success(function(data, status, headers, config) {
		          if (data=='true') {
		          	$state.go("metodos_de_pago.contra_entrega");		          	
		          }else{
		          	$scope.mensaje='Por favor selecciones la hora en la que desea la entrega de su pedido.';
			     	$('#modalTiempos').modal('show');
		          }
		      });
      }    
    
});
