confControllers.controller('DireccionesController', function ($scope,$http,$routeParams,$filter,filterFilter,$route,$location, $state) {

	
	$scope.listaDirecciones=[];
	$scope.listaBarrios=[];
  $scope.direccionseleccionada=0;
	$scope.direccionPersona={id:0,id_barrio:'0',nombre_sitio:'',direccion:'',telefono:'',quien_recibe:''};
  $scope.result={};

	   $http.post("direccionespersona/obtenerdirecciones",{})
      .success(function(data, status, headers, config) {
          $scope.listaDirecciones=data; 
      });


       $http.post("barrioproveedor/obtenertodos",{})
      .success(function(data, status, headers, config) {
          $scope.listaBarrios=data; 
      });

      $scope.crearDireccion=function(){

         if ($scope.direccionPersona.nombre_sitio=='') {
          $scope.result={show:true,alert:'warning',msg:'Digite el nombre sitio.'};
          return false;
        }
        else if ($scope.direccionPersona.direccion=='') {
          $scope.result={show:true,alert:'warning',msg:'Digite la dirección.'};
          return false;
        }
         else if ($scope.direccionPersona.id_barrio=='0') {
          $scope.result={show:true,alert:'warning',msg:'Seleccione el barrio.'};
          return false;
        }
        else if ($scope.direccionPersona.telefono=='') {
          $scope.result={show:true,alert:'warning',msg:'Digite el telefono.'};
          return false;
        }
        else if ($scope.direccionPersona.quien_recibe=='') {
          $scope.result={show:true,alert:'warning',msg:'Digite el nombre de quien recibe.'};
          return false;
        }else{

          if ($scope.direccionPersona.id >0) {

              $http.post("direccionespersona/modificar",$scope.direccionPersona)
                .success(function(data, status, headers, config) {            
                    if (data =='true') {
                      $('#modalDireccion').modal('hide');
                      $state.reload();
                    };
                });

            }else{

              	 $http.post("direccionespersona/crear",$scope.direccionPersona)
        	      .success(function(data, status, headers, config) {	          
        	          if (data > 0) {
        	          	$('#modalDireccion').modal('hide');
        	          	$state.reload();
        	          };
        	      });

            }

          }

      }

      $scope.seleccionarDireccion=function(obj){

         $http.post("direccionespersona/seleccionar",{id_direccion:obj.ID})
        .success(function(data, status, headers, config) {   
          
          if (data>0) {
             $state.go("tiempos");
          };         
           
        });
      	
      }

      $scope.obtenerDireccion=function(obj){

         $http.post("direccionespersona/obtenerporid",{id:obj.ID})
        .success(function(data, status, headers, config) {   
          
          $scope.direccionPersona=data;  
          $('#modalDireccion').modal('show');    
           
        });
        
      }

       $scope.abrirPegunta=function(obj){

        $scope.direccion=obj;
        $('#modalPregunta').modal('show');    

      }      

       $scope.quitarDireccion=function(){

        $('#modalPregunta').modal('show');    

         $http.post("direccionespersona/quitardireccion",{id:$scope.direccion.ID})
        .success(function(data, status, headers, config) {   
          
           if (data>0) {
              $state.reload();
          };   
           
        });
        
      }

      var existeDireccion=$http({method:'GET',url:'tieneDireccion'}); 
        existeDireccion.success(function(response){                
                               
           $scope.direccionseleccionada=response; 
           
                      
      });

     

       
});
