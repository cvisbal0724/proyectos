confControllers.controller('HomeController', function ($scope,$location,authUsuario,SessionService,SessionSet,$state,$http) {

	$scope.listaMenu=[];
	$scope.nombreUsuario=authUsuario.nombreUsuario();

	if (!authUsuario.estaLogueado()) {
		$state.go('login');
	};

	$scope.consultarmenu=function(){

	 $http.post("menu/consultarmenu",{}).success(function(data, status, headers, config) {

	 	$scope.listaMenu=data;
        
      });


	}

	$scope.desloguear=function(){		
	   authUsuario.desloguear();
    }  


});
