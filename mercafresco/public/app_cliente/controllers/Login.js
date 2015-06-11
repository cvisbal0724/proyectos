
confControllers.factory("mensajesFlash", function($rootScope){
    return {
        show : function(message){
            $rootScope.flash = message;
        },
        clear : function(){
            $rootScope.flash = "";
        }
    }
});

confControllers.controller('LoginController', function ($scope,$location,authUsuario,SessionService,SessionSet,$state,$http) {

		
		$scope.cuenta={};
    $scope.result={};
    $scope.result2={};
		$scope.loginData={usuario:'', clave:''};

		$scope.loginSubmit = function(){

      if ($scope.loginData.usuario=='') {
        $scope.result={show:true,alert:'warning',msg:'Digite el usuario.'};
        return false;
      };

      if ($scope.loginData.clave=='') {
        $scope.result={show:true,alert:'warning',msg:'Digite su clave.'};
        return false;
      };

			var auth = authUsuario.auth($scope.loginData);
			auth.success(function(response){

       if (response.ID > 0) {
        SessionSet.cacheSession(response);
        $state.go("productos");
      }else{
        $scope.result=response;
      }
			
			});
		}

	 $('#modalRegistrarFacebook').on('hidden.bs.modal',function(){         
         $state.go('login');
       });		
	  

     $scope.recuperar_clave=function(){

       $http.get("usuario/recuperarclave/" + $scope.correo)
          .success(function(data, status, headers, config) {

            $scope.result2=data;
           
        });

     }   

});

//http://justinvoelkel.me/laravel-angularjs-part-two-login-and-authentication/

//http://uno-de-piera.com/login-de-usuarios-con-angularjs-y-codeigniter/