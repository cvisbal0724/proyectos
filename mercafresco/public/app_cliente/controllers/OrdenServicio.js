confControllers.controller('OrdenServicioController', function ($scope,$http,$routeParams,$filter,filterFilter,$route,$location, $state) {

	   $scope.metodo_seleccionado='';
	   $scope.pago_credito={id_metodo_pago:3,nombre:'',tarjeta:'',ano:'',mes:'',codigo_seguridad:'',numero_cuotas:'1'};;//{id_metodo_pago:3,nombre:'Carlos Visbal',tarjeta:'4097440000000004',ano:'2015',mes:'12',codigo_seguridad:'321',numero_cuotas:'1'};
	   $scope.mensaje='';
	   $scope.codigo='';
	   $scope.pago_pse={id_metodo_pago:4,id_banco:'0',nombre:'',cedula:'',telefono:''};
	   
	   if ($state.current.name=='metodos_de_pago.credito') {

	   		$scope.metodo_seleccionado='3';

	   }else if ($state.current.name=='metodos_de_pago.pse') {

	   		$scope.metodo_seleccionado='4';

	   }else if ($state.current.name=='metodos_de_pago.contra_entrega') {

	   		$scope.metodo_seleccionado='1';

	   }

       $scope.crear_ordenservicio=function(){      

			$http.post("ordenservicio/crear",{id_metodo_pago:1})
			 .success(function(data, status, headers, config) {
			     if (data['ID']>0 && data['msg']=='success') {
			     	$state.go("finalizar");
			     }else if (data['ID']==0) {
			     	$scope.mensaje=data['msg'];//'Por favor selecciones la hora en la que desea la entrega de su pedido.';
			     	$('#modalMetodoPago').modal('show');
			     }
			});
		  
        }

       $scope.vermetodosdepago=function(){

       	if ($scope.metodo_seleccionado=='3') {
       		$state.go('metodos_de_pago.credito');
       	}else if ($scope.metodo_seleccionado=='4') {
       		$state.go('metodos_de_pago.pse');
       	}else if ($scope.metodo_seleccionado=='1') {
       		$state.go('metodos_de_pago.contra_entrega');
       	};
       	
       }

       $scope.pago_con_pse=function(){
           
            $http.post("ordenservicio/crear",$scope.pago_pse)
			 .success(function(data, status, headers, config) {			     
			     if (data['ID']==0) {
			     	$scope.mensaje=data['msg'];//'Por favor selecciones la hora en la que desea la entrega de su pedido.';
			     	$('#modalMetodoPagoPSE').modal('show');
			     }else if (data['ID']=='url') {
			     	window.location.href=data['url'];
			     };
			});
              
       }

       $scope.pago_con_tarjeta_credito=function(){
           
            $http.post("ordenservicio/crear",$scope.pago_credito)
			 .success(function(data, status, headers, config) {
			     if (data['ID']>0 && data['msg']=='success') {
			     	$state.go("finalizar");
			     }else if (data['ID']==0) {
			     	$scope.mensaje=data['msg'];//'Por favor selecciones la hora en la que desea la entrega de su pedido.';
			     	$('#modalMetodoPagoCredito').modal('show');
			     }
			});
              
       }

       $scope.guardar_bono=function(){
           
           if ($scope.codigo=='' || $scope.codigo==null) {
           		$scope.result={show:true,alert:"warning",msg:"Ingrese el cupon."};
           		return false;
           };

            $http.get("bono/guardar/"+$scope.codigo)
			 .success(function(data, status, headers, config) {
			     $scope.result=data;
			});
              
       }

       $scope.reintentar_pago=function(){
       		$http.get("ordenservicio/reintertarpagobancario?id_banco="+$state.params.id_banco +"&nombre="+
       			$state.params.nombre+"&cedula="+$state.params.cedula+"&telefono="+$state.params.telefono)
			 .success(function(data, status, headers, config) {
			    window.location.href=data;
			});
       }

	    $scope.terminar_proceso_de_pago_bancario=function(){
       		$http.post("ordenservicio/terminarprocesodepagobancario")
			 .success(function(data, status, headers, config) {
			    if (data=='success') {
			    	$state.go('productos');
			    };
			});
       }

});
