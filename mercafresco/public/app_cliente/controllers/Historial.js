confControllers.controller('HistoriaController', function ($scope,$http,$routeParams,$filter,filterFilter,$route,$location,$interval,$state) {

	$scope.OrdenesServicio=[];
	$scope.filtro={opcion:'0'};
  $scope.vectorAnos=[];
  var today = new Date();

   for (var i = 0; i < (today.getFullYear() - 2014)+1; i++) {   
      $scope.vectorAnos[i]=i;      
   };

	$scope.consultar=function(){

		if ($scope.filtro.mes=='0' || $scope.filtro.ano=='0') { return false; };

		$http.post("ordenservicio/obtenerporcriterios",$scope.filtro)
     	 .success(function(data, status, headers, config) {
          $scope.OrdenesServicio=data; 
      	});

	}	

$scope.consultarlosultimostres=function(){
   
    $http.post("ordenservicio/obtenerlosultimostres",$scope.filtro)
       .success(function(data, status, headers, config) {
          $scope.OrdenesServicio=data; 
     });

  } 

	$scope.agregarCanasta=function(obj){

      $http.post("productoproveedor/agregarcanasta",{id_producto_proveedor:obj.id_producto_proveedor,cantidad:obj.cantidad})
      .success(function(data, status, headers, config) {
         
      });

   }

   $scope.agregarCanastaLista=function(item){
    
      $http.post("productoproveedor/agregarlistacompra",{lista:item.detalle})
      .success(function(data, status, headers, config) {
         if (data=='true') { $state.go("productos"); };
      });

   }

});	