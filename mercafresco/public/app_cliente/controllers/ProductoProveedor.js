
confControllers.controller('ProductoProveedorController', function ($scope,$http,$filter,$location,filterFilter,authUsuario,SessionService,$stateParams,$state) {

$scope.idcategoria=$state.params.idcategoria;
$scope.criterio=$state.params.criterio;
$scope.categoria=$state.params.categoria;
$scope.listaCanasta=[];
$scope.totalCanasta=0;
$scope.totalCantidad=0;
$scope.totalUnidades=0;
$scope.mensaje='';  
$scope.producto={};
$scope.buscar={criterioBuscar:''};
$scope.vistaactual=$state.current.name;
  var n = $location.path().search("/ver/");
  
  if (n>0) {     
      window.history.back();
  }
 
	if ($scope.idcategoria > 0) {	
    //alert(1);
	 $http.post("productoproveedor/obtenerporcategoria",{id_categoria: $scope.idcategoria}).success(function(data, status, headers, config) {
           $scope.listaProductos = data;        
        });
	}else if($location.path()=='/supermercado/consultar/'+($scope.criterio==undefined ? $scope.categoria : $scope.criterio)){    
    //alert(2);
    $http.post("productoproveedor/obtenerporparecidos",{criterio: ($scope.criterio==undefined ? $scope.categoria : $scope.criterio)})
    .success(function(data, status, headers, config) {
       $scope.listaProductos = data;  
       $scope.buscar.criterioBuscar=($scope.criterio==undefined ? $scope.categoria : $scope.criterio);
     });
  }else{  
  //alert(3);  
    $http.post("productoproveedor/obtenerinicio",{}).success(function(data, status, headers, config) {
          $scope.listaProductos = data; 
          if (data.length == 0) {
            $scope.mensaje='Estimado cliente el momento no tenemos cobertura para su barrio.';
          $('#modalValidarProducto').modal('show');
          };       
      });

   } 

    $scope.buscarProducto=function(){
      if ($scope.buscar.criterioBuscar!='') {
        $state.go('consultarproductos',{criterio:$scope.buscar.criterioBuscar});
      }else{
        $state.go('productos');
      }
      
   }

   $scope.buscarporcategoria=function(obj){
        var nombre=obj.NOMBRE.replace(/ /g, "-").toLowerCase();
           
        $state.go('vermas',{idcategoria:obj.ID,categoria:normalize(nombre)});
        $("#sidebar-wrapper-categorias").toggleClass("show");
        $('#back-fondo').toggle();
        //$("#wrapper").addClass("toggled");
      }

  $scope.buscarporcategoria_2=function(id, categoria){
        var nombre=categoria.replace(/ /g, "-").toLowerCase();  

         $state.go('vermas',{idcategoria:id,categoria:normalize(nombre)});
        //$("#wrapper").addClass("toggled");
  }
  
   function establecerCanasta(data){
      $scope.listaCanasta=data; 
      $scope.totalCanasta=0;
      $scope.totalUnidades=0;
      $scope.totalCantidad=$scope.listaCanasta.length;

      angular.forEach(data,function(prop, key){
        $scope.totalCanasta+=(prop.precio * prop.cantidad);
        $scope.totalUnidades+= angular.isString(prop.cantidad) ? parseFloat(prop.cantidad) : prop.cantidad;
      }); 

        //Agrega la cantidad que tiene la canas ta al producto del home
       angular.forEach($scope.listaProductos,function(prop, key){
          
           angular.forEach(prop.productos,function(prop2, key2){
              
              var obj= $filter('filter')($scope.listaCanasta, { id: prop2.id}, true)[0];
              
              if (obj!=undefined && obj.cantidad > 0)             
                  prop2.cantidad=obj.cantidad;

           });
            
       });

       //$state.go($state.current, {}, {reload: true});

   }

   $scope.agregarCantidades=function(obj,opcion,desdecanasta){

         var incremento=0;
       	if (opcion=='+') {
       		if (obj.id_unidad!=2){
            obj.cantidad = angular.isString(obj.cantidad) ? parseFloat(obj.cantidad) + 1 : obj.cantidad + 1;
            incremento=1;
          }
       		else if(obj.id_unidad==2){
            obj.cantidad = angular.isString(obj.cantidad) ? parseFloat(obj.cantidad) + 0.5 : obj.cantidad + 0.5;
            incremento=0.5;
          }
       	}else if (opcion=='-') {
       		if (obj.id_unidad!=2) {
       			if(obj.cantidad > 1){
              obj.cantidad = angular.isString(obj.cantidad) ? parseFloat(obj.cantidad) - 1 : obj.cantidad - 1;   			
              incremento=-1; 
            }
       		}else if (obj.id_unidad==2) {
       			if(obj.cantidad > 0.5){
              obj.cantidad = angular.isString(obj.cantidad) ? parseFloat(obj.cantidad) - 0.5 : obj.cantidad - 0.5; 
              incremento=-0.5;
            }
          }  		
       	}
      if (desdecanasta) {
       $http.post("productoproveedor/agregarcantidadesdesdecanasta",{id_producto_proveedor:obj.id,cantidad:incremento})
        .success(function(data, status, headers, config) { 
              if (data['result']=='success') { 
                establecerCanasta(data['data']);               
              }else{

                if (incremento > 0) {obj.cantidad=obj.cantidad - incremento;};
                  $scope.mensaje=data['data'];
                  $('#modalValidarProducto').modal('show');
              }             
        });

        //$state.go($state.current, {}, {reload: true});

      }

   }

   $scope.existsObj = function(val){
        return $filter('filter')($scope.listaCanasta, val).length > 0;
   }  

   $scope.existsId = function(feed) {

   return  $filter('filter')($scope.listaCanasta, { id: feed.id}, true).length > 0;

  }

   $scope.buscarenJsonporid = function(id,data) {
   
   return  $filter('filter')(data, { id: id}, true);

  }

   $scope.buscarProductoporid = function(obj) {
  
   $http.post("productoproveedor/obtenerporidprovedorproducto",{id_producto_proveedor:obj.id})
        .success(function(data, status, headers, config) { 
         
          var n = $scope.vistaactual.search("verproducto");          
           var nombre=obj.nombre.replace(/ /g, "-").toLowerCase();
            $state.go($scope.vistaactual + (n > 0 ? '' : '.verproducto') ,{idproducto:obj.id,nombreproducto:nombre}); 

         var producto=$scope.buscarenJsonporid(obj.id,data['productos']);
         producto.cantidad=obj.cantidad;
         $scope.producto=producto;                  
        $('#modalProductos').modal('show');

    });

  }

   $scope.agregarCanasta=function(obj){

    if (!(obj.cantidad>0)) {
      $scope.mensaje='Agregue una cantidad mayor a cero.';
      $('#modalValidarProducto').modal('show');
      return false;
    };    

    if($scope.listaCanasta==null)$scope.listaCanasta=[];
   
      $http.post("productoproveedor/agregarcanasta",{id_producto_proveedor:obj.id,cantidad:obj.cantidad})
      .success(function(data, status, headers, config) {
          if (data['result']=='success') { 
             establecerCanasta(data['data']);
            
          }else if (data['result']=='notice') {

             establecerCanasta(data['data']);
             $scope.mensaje=data['msg'];
            $('#modalValidarProducto').modal('show');

          }
          else{
             $scope.mensaje=data['msg'];
            $('#modalValidarProducto').modal('show');
          } 
        
      });

      $('#modalProductos').modal('hide'); 
          
   }

   $scope.$watch('$viewContentLoaded', function()
    {
  
    $http.post("productoproveedor/cargarproductosagregados",{})
      .success(function(data, status, headers, config) {
            
      establecerCanasta(data);
            
      });

    });

   
  $scope.removerCanasta=function(obj){
     $http.get("productoproveedor/removeproductoagregado/" + obj.id,{ })
      .success(function(data, status, headers, config) {

        /*var index = $scope.listaCanasta.indexOf(obj);
        $scope.listaCanasta.splice(index, 1); */
        establecerCanasta(data);
    });
  }

  $scope.checkout=function(){

      if (authUsuario.isLoggedIn()) {

        $http.get("validarValorMinimo")
          .success(function(data, status, headers, config) {

               if ($scope.totalCanasta < parseFloat(data) && $scope.totalCanasta > 0) {          
                  $scope.mensaje='Lo sentimos, el valor minimo para realizar la compra es de $'+data+'.';
                  $('#modalValidarProducto').modal('show');
                }
                else if($scope.totalCanasta==0){
                  $scope.mensaje='Por favor agregue los productos a la canasta.';
                  $('#modalValidarProducto').modal('show');
                }else{
                  $location.path('/direcciones');
                }  

        });
               
      }else{
        $location.path('/login');
      }

    }


    $scope.modalProducto=function(obj){
       $scope.producto=obj;  
       var n = $scope.vistaactual.search("verproducto");          
       var nombre=obj.nombre.replace(/ /g, "-").toLowerCase();
        $state.go($scope.vistaactual + (n > 0 ? '' : '.verproducto') ,{idproducto:obj.id,nombreproducto:normalize(nombre)});      
        $('#modalProductos').modal('show');
    }

   
   $scope.keydown = function(keyEvent) {
    return false;
       };

     $scope.isNumberKey=function(evt)
       {
          var charCode = (evt.which) ? evt.which : event.keyCode
          if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57))
             return false;
 
          return true;
       }

});

App.directive('numericOnly', function(){
    return {
        require: 'ngModel',
        link: function(scope, element, attrs, modelCtrl) {

            modelCtrl.$parsers.push(function (inputValue) {
                var transformedInput = inputValue.replace(/[^\d\.]/g,'');//(/\.{2,}/g,'');

                if (transformedInput!=inputValue) {
                    modelCtrl.$setViewValue(transformedInput);
                    modelCtrl.$render();
                }

                return transformedInput;
            });
        }
    };
});