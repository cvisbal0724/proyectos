confControllers.controller('CuentaController', function ($scope,$http,$routeParams,$filter,filterFilter,$route,$location,$sce,SessionSet,$state) {

	$scope.cuenta={
		cortesia:'0',
		correo:'',
		id_tipo_identificacion:'0',
		no_identificacion:'',
		nombres:'',
		apellidos:'',
		celular:'',
		fecha_nacimiento:'',
		telefono:'',
		id_barrio:'0',
		direccion:'',
		quien_recibe:'',
		clave:'',
		conf_clave:''
	};

	$scope.tipoIdentificacion=[];
	$scope.result={};
	$scope.result2={};
	$scope.listaBarrios=[];

	 $scope.cargarcuenta=function(){
		$http.post("usuario/obtenercuenta",{})
      		.success(function(data, status, headers, config) {
          $scope.cuenta=data; 
      });
     	
	}
	
/*
	 $http.post("usuario/obtenertipoidentificacion",{})
      		.success(function(data, status, headers, config) {
          $scope.tipoIdentificacion=data; 
      });
*/
	$scope.cargarbarrio=function(){		
		$http.post("barrioproveedor/obtenertodos",{})
	      .success(function(data, status, headers, config) {
	          $scope.listaBarrios=data; 
	      });
	}

	$scope.modifcarUsuario=function(){
		
		if ($scope.cuenta.cortesia=='0') { $scope.result={alert:'warning',msg:'Por favor seleccione la cortesia',show:true}; return false; };
		if ($scope.cuenta.id_tipo_identificacion=='0') { $scope.result={alert:'warning',msg:'Por favor seleccione el tipo de identificación.',show:true}; return false; };
		if ($scope.cuenta.no_identificacion=='') { $scope.result={alert:'warning',msg:'Por favor ingrese el numero de identificación.',show:true}; return false; };
		if ($scope.cuenta.nombres=='') { $scope.result={alert:'warning',msg:'Por favor ingrese sus nombres.',show:true}; return false; };
		if ($scope.cuenta.apellidos=='') { $scope.result={alert:'warning',msg:'Por favor ingrese sus apellidos.',show:true}; return false; };
		if ($scope.cuenta.correo=='') { $scope.result={alert:'warning',msg:'Por favor ingrese su correo.',show:true}; return false; };
		if ($scope.cuenta.telefono=='') { $scope.result={alert:'warning',msg:'Por favor ingrese su telefono.',show:true}; return false; };
		//if ($scope.cuenta.celular=='') { $scope.result={alert:'warning',msg:'Por favor ingrese su celular.',show:true}; return false; };
		//if ($scope.cuenta.fecha_nacimiento=='') { $scope.result={alert:'warning',msg:'Seleccione su fecha de nacimiento.',show:true}; return false; };
		if ($scope.cuenta.clave!=null && $scope.cuenta.clave!='') {
			if ($scope.cuenta.clave.length < 6) {$scope.result={alert:'warning',msg:'La clave debe tener minimo 6 caracteres.',show:true}; return false;};

			if ($scope.cuenta.clave !== $scope.cuenta.conf_clave) { $scope.result={alert:'warning',msg:'Las claves no coinciden.',show:true}; return false; };
		};
		
		$http.post("usuario/modificar",$scope.cuenta)
      		.success(function(data, status, headers, config) {
          	$scope.result=data;
        });
	}

	$scope.SkipValidation = function(value) {
	  return $sce.trustAsHtml(value);
	};
	
	 $('#datetimepicker1').on('dp.change', function(ev){	 	
       $scope.cuenta.fecha_nacimiento =$('#dtfechaNacimiento').val();
      });


	$scope.crearcuenta=function(){

		//if ($scope.cuenta.cortesia=='0') { $scope.result={alert:'warning',msg:'Por favor seleccione la cortesia',show:true}; return false; };
		if ($scope.cuenta.correo=='') { $scope.result={alert:'warning',msg:'Por favor ingrese su correo.',show:true}; return false; };
		
		if (!validateEmail($scope.cuenta.correo)) {
			 $scope.result={alert:'warning',msg:'El correo no es valido.',show:true}; return false; 
		};

		//if ($scope.cuenta.id_tipo_identificacion=='0') { $scope.result={alert:'warning',msg:'Por favor seleccione el tipo de identificación.',show:true}; return false; };
		if ($scope.cuenta.no_identificacion=='') { $scope.result={alert:'warning',msg:'Por favor ingrese el numero de identificación.',show:true}; return false; };
		if ($scope.cuenta.nombres=='') { $scope.result={alert:'warning',msg:'Por favor ingrese sus nombres.',show:true}; return false; };
		//if ($scope.cuenta.apellidos=='') { $scope.result={alert:'warning',msg:'Por favor ingrese sus apellidos.',show:true}; return false; };				
		//if ($scope.cuenta.celular=='') { $scope.result={alert:'warning',msg:'Por favor ingrese su celular.',show:true}; return false; };
		//if ($scope.cuenta.fecha_nacimiento=='') { $scope.result={alert:'warning',msg:'Seleccione su fecha de nacimiento.',show:true}; return false; };

		if ($scope.cuenta.clave.length < 6) {$scope.result={alert:'warning',msg:'La clave debe tener minimo 6 caracteres.',show:true}; return false;};

		if ($scope.cuenta.clave !== $scope.cuenta.conf_clave) { $scope.result={alert:'warning',msg:'Las claves no coinciden.',show:true}; return false; };

		//if ($scope.cuenta.telefono=='') { $scope.result={alert:'warning',msg:'Por favor ingrese su telefono.',show:true}; return false; };
		//if ($scope.cuenta.id_barrio=='0') { $scope.result={alert:'warning',msg:'Por favor seleccione el barrio.',show:true}; return false; };
		//if ($scope.cuenta.direccion=='') { $scope.result={alert:'warning',msg:'Por favor ingrese la direccion.',show:true}; return false; };
		//if ($scope.cuenta.quien_recibe=='') { $scope.result={alert:'warning',msg:'Por favor ingrese quien recibe su pedido.',show:true}; return false; };	
		
		$http.post("usuario/crear",$scope.cuenta)
      		.success(function(data, status, headers, config) {

      			if (data > 0) {
      				$('#modalRegistrar').modal('show');
      				$scope.result2={alert:'success',msg:'Su cuenta ha sido creada satisfactoriamente, se le ha enviado un correo de confirmación.',show:true};
      				$scope.nuevo();
      			}else{
      				$('#modalRegistrar').modal('show');
      				$scope.result2={alert:'danger',msg:data,show:true};
      			}   

        });

      	

	}

	$scope.nuevo=function(){
		$scope.cuenta={
		cortesia:'0',
		correo:'',
		id_tipo_identificacion:'0',
		no_identificacion:'',
		nombres:'',
		apellidos:'',
		celular:'',
		fecha_nacimiento:'',
		telefono:'',
		id_barrio:'0',
		direccion:'',
		quien_recibe:'',
		clave:'',
		conf_clave:''
	};
	}

	$scope.cargar_datos_facebook=function(){
		
		$http.post("login/obtenerdatosfacebook",{})
      		.success(function(data, status, headers, config) {
      			if (data.login===true) {
      				SessionSet.cacheSession(data.data);
      				$state.go("productos");
      			}else{
      				$scope.cuenta=data.data; 
      				$('#modalRegistrarFacebook').modal('show');
      			}         
        });
     	
	}

  $scope.crearcuenta_con_facebook=function(){

    if ($scope.cuenta.correo=='') { $scope.result={alert:'warning',msg:'Por favor ingrese su correo.',show:true}; return false; };
    if ($scope.cuenta.no_identificacion=='') { $scope.result={alert:'warning',msg:'Por favor ingrese el numero de identificación.',show:true}; return false; };
    if ($scope.cuenta.nombres=='') { $scope.result={alert:'warning',msg:'Por favor ingrese sus nombres.',show:true}; return false; };
    //if ($scope.cuenta.apellidos=='') { $scope.result={alert:'warning',msg:'Por favor ingrese sus apellidos.',show:true}; return false; };       
   if ($scope.cuenta.telefono=='') { $scope.result={alert:'warning',msg:'Por favor ingrese un telefono.',show:true}; return false; };       

    $http.post("usuario/crearconfacebook",$scope.cuenta)
          .success(function(data, status, headers, config) {

            if (data > 0) {
            	$scope.cargar_datos_facebook();
              //$scope.result2={alert:'success',msg:'Su cuenta ha sido creada satisfactoriamente, se le ha enviado un correo de confirmación.',show:true};
            }else{
              $scope.result2={alert:'danger',msg:data,show:true};
            }   

        });

     }

     $scope.desloguear_facebook=function(){

     	 $http.get("login/desloguearporfacebook")
          .success(function(data, status, headers, config) {
          
           	$state.go('productos');

        });

     }   

    
     $scope.cambiar_clave=function(){

     	if ($scope.cuenta.clave.length < 6) {$scope.result={alert:'warning',msg:'La clave debe tener minimo 6 caracteres.',show:true}; return false;};

		if ($scope.cuenta.clave !== $scope.cuenta.conf_clave) { $scope.result={alert:'warning',msg:'Las claves no coinciden.',show:true}; return false; };     	

     	 $http.post("usuario/cambiarclave",{ key:$state.params.key,clave:$scope.cuenta.clave })
          .success(function(data, status, headers, config) {

          	if (data.alert=='success') {
          		
          		$scope.result=data;
          		$scope.cuenta.clave='';
          		$scope.cuenta.conf_clave='';
          		//$('#modalMensaje').modal('show');
          	}else{

          		$scope.result=data;//{alert:'danger',msg:'Un error ha ocurrido al cambiar su contraseña.',show:true};
          		//$('#modalMensaje').modal('show');

          	}
           //$state.go('productos');

        });

     }   

function validateEmail(email) {
    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    return re.test(email);
}

});