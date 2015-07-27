'use strict';

var App = angular.module('App',  ['ui.router','ngRoute', 'confControllers']);
var confControllers = angular.module('confControllers', []);


App.config(function($urlRouterProvider, $stateProvider) {

    $urlRouterProvider.otherwise('/supermercado');

    $stateProvider
    .state('productos', {
                url: "/supermercado",
                action: "productos.default" ,
                 views: {
                 "contenedor": { templateUrl: "inicio/productos", controller: 'ProductoProveedorController'}                 
                 
                 }
              })
     .state('productos.verproducto', {
                url: "/ver/:idproducto/:nombreproducto",
                template: ""                    
              })
     .state('vermas', {
                url: "/supermercado/:idcategoria/:categoria", 
                action: "productos.default"   ,
                 views: {
                 "contenedor": { templateUrl: "inicio/productos", controller: 'ProductoProveedorController'}
                 }        
              })  
      .state('vermas.verproducto', {
        url: "/ver/:idproducto/:nombreproducto",
        template: ""                    
      }) 
     .state('consultarproductos', {
                url: "supermercado/consultar/:criterio",               
                 views: {
                 "contenedor": { templateUrl: "inicio/productos", controller: 'ProductoProveedorController'},
                 "buscador": { templateUrl: "layouts/buscador", controller: 'ProductoProveedorController'}
                 }         
              })  
     .state('consultarproductos.verproducto', {
       url: "/ver/:idproducto/:nombreproducto",
       template: ""                    
     })   
     .state('login', {
                url: "/login",                 
                views: {
                 "contenedor": { templateUrl: "inicio/login", controller: 'LoginController'},
                 "header": { templateUrl: "layouts/headervistas"}
                 }           
              })
     .state('login_facebook', {
                url: "/login-facebook",
                views: {
                 "contenedor": {  templateUrl: 'inicio/login_facebook' , controller:'CuentaController'},
                 "header": { templateUrl: "layouts/headervistas"}
                 }           
              })
      .state('login_google', {
                url: "/login-google",
                views: {
                 "contenedor": {  templateUrl: 'inicio/login_google' , controller:'CuentaController'},
                 "header": { templateUrl: "layouts/headervistas"}
                 }           
              })
     .state('direcciones', {
                url: "/direcciones",
                views: {
                 "contenedor": { templateUrl: "pasos_para_pago/direcciones", controller: 'DireccionesController'},
                 "header": { templateUrl: "layouts/headervistas"}
                 }           
              })
   .state('tiempos', {
                url: "/tiempos",
                views: {
                 "contenedor": {  templateUrl: 'pasos_para_pago/tiempos', controller: 'TiemposController'},
                 "header": { templateUrl: "layouts/headervistas"}
                 }           
              })
   .state('metodos_de_pago', {
                url: "/metodos-de-pago",
                views: {
                 "contenedor": {  templateUrl: 'pasos_para_pago/metodos_de_pago', controller:'OrdenServicioController'},
                 "header": { templateUrl: "layouts/headervistas"}
                 }           
              })
   .state('metodos_de_pago.credito', {
                url: "/terjeta-de-credito",
                templateUrl: 'pasos_para_pago/credito',
                controller:'OrdenServicioController'         
              })
    .state('metodos_de_pago.pse', {
                url: "/pse",
                templateUrl: 'pasos_para_pago/pse'         
              })
   .state('metodos_de_pago.contra_entrega', {
                url: "/contra-entrega",
                templateUrl: 'pasos_para_pago/contra_entrega' ,
                controller:'OrdenServicioController'
              })
   .state('finalizar', {
                url: "/finalizar",
                views: {
                 "contenedor": { templateUrl: 'pasos_para_pago/finalizar', controller: 'FinalizarController'},
                 "header": { templateUrl: "layouts/headervistas"}
                 }           
              })
   .state('respuesta_banco', {
                url: "/respuesta-banco/:cedula/:nombre/:id_banco/:telefono",
                views: {
                 "contenedor": { templateUrl: 'pasos_para_pago/respuesta_banco', controller: 'OrdenServicioController'},
                 "header": { templateUrl: "layouts/headervistas"}
                 }           
              })
    .state('cuenta', {
                url: "/cuenta",
                views: {
                 "contenedor": {  templateUrl: 'mi_perfil/cuenta', controller: 'CuentaController'},
                 "header": { templateUrl: "layouts/headervistas"}
                 }           
              })
    .state('mis_direcciones', {
                url: "/mis-direcciones",
                views: {
                 "contenedor": {  templateUrl: 'mi_perfil/mis_direcciones', controller: 'DireccionesController'},
                 "header": { templateUrl: "layouts/headervistas"}
                 }           
              })
    .state('historial', {
                url: "/historial",
                views: {
                 "contenedor": {  templateUrl: 'historial/historial', controller: 'HistoriaController'},
                 "header": { templateUrl: "layouts/headervistas"}
                 }           
              })
    .state('registrar', {
                url: "/registrar",
                views: {
                 "contenedor": {  templateUrl: 'inicio/registrar', controller: 'CuentaController'},
                 "header": { templateUrl: "layouts/headervistas"}
                 }           
              })
    .state('activar', {
                url: "/activar/*key",
                views: {
                 "contenedor": {  templateUrl: 'inicio/activar', controller: 'ActivarCuentaController'},
                 "header": { templateUrl: "layouts/headervistas"}
                 }           
              }) 
    .state('nosotros', {
                url: "/nosotros",
                views: {
                 "contenedor": {  templateUrl: 'mas_informacion/nosotros'},
                 "header": { templateUrl: "layouts/headervistas"}
                 }           
              })
    .state('donde_llegamos', {
                url: "/donde-llegamos",
                views: {
                 "contenedor": {  templateUrl: 'mas_informacion/donde_llegamos'},
                 "header": { templateUrl: "layouts/headervistas"}
                 }           
              })
    .state('preguntas_frecuentes', {
                url: "/preguntas-frecuentes",
                views: {
                 "contenedor": {  templateUrl: 'mas_informacion/preguntas_frecuentes'},
                 "header": { templateUrl: "layouts/headervistas"}
                 }           
              })
    .state('aliados_estrategicos', {
                url: "/aliados-estrategicos",
                views: {
                 "contenedor": {  templateUrl: 'mas_informacion/aliados_estrategicos'},
                 "header": { templateUrl: "layouts/headervistas"}
                 }           
              })
    .state('politicas_de_privacidad', {
                url: "/politicas-de-privacidad",
                views: {
                 "contenedor": {  templateUrl: 'mas_informacion/politicas_de_privacidad'},
                 "header": { templateUrl: "layouts/headervistas"}
                 }           
              })
     .state('terminos_y_condiciones', {
                url: "/terminos-y-condiciones",
                views: {
                 "contenedor": {  templateUrl: 'mas_informacion/terminos_y_condiciones'},
                 "header": { templateUrl: "layouts/headervistas"}
                 }           
              })
     .state('pqr', {
                url: "/pqr",
                views: {
                 "contenedor": {  templateUrl: 'mas_informacion/pqr' , controller:'MasInformacionController'},
                 "header": { templateUrl: "layouts/headervistas"}
                 }           
              })
     .state('cambiar_clave', {
                url: "/cambiar-contrasena/*key",
                views: {
                 "contenedor": {  templateUrl: 'inicio/cambiar_clave' , controller:'CuentaController'},
                 "header": { templateUrl: "layouts/headervistas"}
                 }           
              })
     .state('calificanos', {
                url: "/calificanos/*key",
                views: {
                 "contenedor": {  templateUrl: 'calificanos/calificanos' , controller:'CalificarController'},
                 "header": { templateUrl: "layouts/headervistas"}
                 }           
      });
});



confControllers.factory("SessionService", function(){
    return {
        //obtenemos una sesión //getter
        get : function(key) {
            return sessionStorage.getItem(key)
        },
        //creamos una sesión //setter
        set : function(key, val) {
            return sessionStorage.setItem(key, val)
        },
        //limpiamos una sesión
        unset : function(key) {
            return sessionStorage.removeItem(key)
        }
    }
});

confControllers.factory("SessionSet", function($location,SessionService){
    return {
        //obtenemos una sesión 
        cacheSession : function(usuario){
        SessionService.set("auth", usuario.ID > 0);
        SessionService.set("nombre", usuario.persona.NOMBRES);
        SessionService.set("usuario", usuario.USUARIO);
        },
        unCacheSession : function(){
            SessionService.unset("auth");
            SessionService.unset("usuario");
            SessionService.unset("nombre");
        }
    }
});

confControllers.factory('authUsuario',function($http,$location,SessionService,SessionSet,$state){

	return{
		auth:function(credentials){
		var authUser = $http({method:'POST',url:'login/auth',params:credentials});
		return authUser;
		},
        authByCookie:function(){
            var authUser = $http({method:'POST',url:'login/authporcookie'});            
            return authUser;
        },
		 logout : function(){
            return $http({
                method:'POST',
                url : "login/logout"
            }).success(function(){
                //eliminamos la sesión de sessionStorage
                SessionSet.unCacheSession();
                //$state.go("productos");
                //$state.reload();
            });
        },
        logoutByCookie : function(){
            return $http({
                method:'POST',
                url : "login/logoutporcookie"
            }).success(function(){
                //eliminamos la sesión de sessionStorage
                SessionSet.unCacheSession();
                $state.go("productos");
            });
        },
		 isLoggedIn : function(){
            return SessionService.get("auth");
        }        
	}
});  


confControllers.run(function($rootScope, $templateCache,$location,SessionService, authUsuario,SessionSet/*,$route*/,$http,$state){

    //creamos un array con las rutas que queremos controlar
    var rutasPrivadas = ["/mis-direcciones","/direcciones","/tiempos","/finalizar"];
    var rutasParaPagos = ["/direcciones","/tiempos","/metodos-de-pago","/metodos-de-pago/terjeta-de-credito","/metodos-de-pago/pse","metodos-de-pago/contra-entrega"];    
    var rutasPublicas = ["/login","/registrar"];    
    //al cambiar de rutas

        //si el usuario existe en la cookies    
          var auth= authUsuario.authByCookie();      
         auth.success(function(response){
                if (response.ID > 0) {                   
                    SessionSet.cacheSession(response);  
                   // $state.reload();
                }           
            });

    //borra cache
     $rootScope.$on('$viewContentLoaded', function() {
        $templateCache.removeAll();
      });


     if(in_array($location.path(),rutasParaPagos)){
            var existeProd=$http({method:'GET',url:'validarexistenproductos'}); 
            existeProd.success(function(response){                
                if (response == 0) {                   
                    $state.go('productos');
                }           
            });

        }         

        if ($location.path()=="/tiempos") {
        var existeDireccion=$http({method:'GET',url:'tieneDireccion'}); 
        existeDireccion.success(function(response){                
                if (response == 0) {                   
                    $state.go('productos');
                }           
            });

        };

       


    var off = $rootScope.$on('$stateChangeStart', function(event, toState, toParams, fromState, fromParams){
       
         //si en el array rutasPrivadas existe $location.path(), locationPath en el login
        //es /login, en la home /home etc, o el usuario no ha iniciado sesión, lo volvemos 
        //a dejar en el formulario de login
        if(in_array($location.path(),rutasPrivadas) && !authUsuario.isLoggedIn()){
            //window.location.back();  
             //event.preventDefault();        
            //return $state.go("login");
            $location.path('/login');
        }
        //en el caso de que intente acceder al login y ya haya iniciado sesión lo mandamos a la home
        if(in_array($location.path(),rutasPublicas) && authUsuario.isLoggedIn()){
            //
             //event.preventDefault(); 
             //return $state.go("productos");        
            $location.path('/supermercado');
        }

        if(($location.path() === '/supermercado') && authUsuario.isLoggedIn()){
           // $location.path("/login");
            //event.preventDefault();
        }  

       // off(); 
         
    });

    function in_array(needle, haystack, argStrict){
	  var key = '',
	  strict = !! argStrict;
	 
	  if(strict){
	    for(key in haystack){
	      if(haystack[key] === needle){
	        return true;
	      }
	    }
	  }else{
	    for(key in haystack){
	      if(haystack[key] == needle){
	        return true;
	      }
	    }
	  }
	  return false;
	}

});



confControllers.controller('AppController', function($scope/*, $route*/, $routeParams, SessionService,authUsuario,$state, $location){

              
              $scope.nombre = SessionService.get("nombre");
              $scope.estaLogueado = SessionService.get("auth")!=null;

              $scope.backPage = function() { 
                 window.history.back();                   
               };
                
              
               $scope.logout=function(){
               authUsuario.logout();
              $scope.nombre = '';//SessionService.get("nombre");
              $scope.estaLogueado = false;//SessionService.get("auth")!=null;
               $state.go('productos');
               //$location.path('/supermercado');
              }  

				// Update the rendering of the page.
              var render = function(){
                   
                    // Store the values in the model.                   
                    $scope.nombre = SessionService.get("nombre");
                    $scope.estaLogueado = SessionService.get("auth")!=null;
                    //$scope.isContact = isContact;

                };

                //checqueamos cual vista parcial vamos a renderizar
                $scope.$on(
                    "$routeChangeSuccess",
                    function( $currentRoute, $previousRoute ){

                        // Update the rendering.
                        render();

                    });     

});

