confControllers.controller('LoginController', function ($scope,$location,authUsuario,SessionService,SessionSet,$state) {

		
		$scope.loginVO={usuario:'', clave:'',_token:angular.element('#hd_token').val()};

		$scope.loguear = function(){

			var auth = authUsuario.loguear($scope.loginVO);

			auth.success(function(response){
					
				if (response.auth) {

					SessionSet.cacheSession(response);
					$state.go('home.inicio');
				}	
			});
		}

});