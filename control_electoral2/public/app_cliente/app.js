'use strict';

var App = angular.module('App',  ['ui.router','ngRoute','confControllers','angularTreeview']);
var confControllers = angular.module('confControllers', []);

App.config(function($urlRouterProvider, $stateProvider) {

    $urlRouterProvider.otherwise('/login');

    $stateProvider
      .state('login', {
        url: "/login",              
        templateUrl: "inicio/login", 
        controller: 'LoginController'
       })
      .state('home', {
        url: "/home",              
        templateUrl: "inicio/home", 
        //controller: 'HomeController'
       })
      .state('home.registrar_partidos', {
        url: "/registrar-partido",              
        templateUrl: "partido/partido", 
        controller: 'PartidoController'
       })
      .state('home.registrar_alcaldes', {
        url: "/registrar-alcalde",              
        templateUrl: "alcalde/alcalde", 
        controller: 'AlcaldeController'
       })
      .state('home.registrar_personas', {
        url: "/registrar-persona",              
        templateUrl: "persona/persona", 
        controller: 'PersonaController'
       })
      .state('home.consultar_personas', {
        url: "/consultar-persona",              
        templateUrl: "persona/consultar_persona", 
        controller: 'PersonaController'
       })
      .state('home.editar_personas', {
        url: "/editar-persona/:id",              
        templateUrl: "persona/persona", 
        controller: 'PersonaController'
       })
      .state('home.registrar_perfiles', {
        url: "/registrar-perfiles",              
        templateUrl: "perfiles/perfiles", 
        controller: 'PerfilesController'
       })
      .state('home.perfil_modulos', {
        url: "/perfil-modulos/:id_perfil",              
        templateUrl: "perfiles/perfil_modulos", 
        controller: 'PerfilesController'
       })
      .state('home.registrar_modulos', {
        url: "/registrar-modulo",              
        templateUrl: "modulos/modulos", 
        controller: 'ModulosController'
       })
      .state('home.registrar_menus', {
        url: "/menu/:id_modulo?",              
        templateUrl: "menus/menus", 
        controller: 'MenuController'
       })
      .state('home.registrar_usuarios', {
        url: "/registrar-usuarios",              
        templateUrl: "usuario/usuario", 
        controller: 'UsuarioController'
       })
       .state('home.consultar_usuarios', {
        url: "/consultar-usuarios",              
        templateUrl: "usuario/consultar_usuario", 
        controller: 'UsuarioController'
       })
       .state('home.editar_usuarios', {
        url: "/editar-usuarios/:id",
        templateUrl: "usuario/usuario", 
        controller: 'UsuarioController'
       })
       .state('home.registrar_concejales', {
        url: "/registrar-concejal",
        templateUrl: "concejal/concejal", 
        controller: 'ConcejalController'
       })
        .state('home.consultar_concejales', {
        url: "/consultar-concejal",
        templateUrl: "concejal/consultar_concejal", 
        controller: 'ConcejalController'
       })
        .state('home.editar_concejales', {
        url: "/editar-concejal/:id",
        templateUrl: "concejal/concejal", 
        controller: 'ConcejalController'
       })
      .state('home.registrar_lideres', {
        url: "/registrar-lider",
        templateUrl: "lideres/lider", 
        controller: 'LiderController'
       })
       .state('home.consultar_lideres', {
        url: "/consultar-lider",
        templateUrl: "lideres/consultar_lider", 
        controller: 'LiderController'
       })
       .state('home.asociar_concejales', {
        url: "/asociar-concejales/:id_lider",
        templateUrl: "lideres/asociar_concejales", 
        controller: 'LiderController'
       })
       .state('home.registrar_votantes', {
        url: "/registrar-votante",
        templateUrl: "votantes/votante", 
        controller: 'VotanteController'
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
        SessionService.set("auth", usuario.auth);
        SessionService.set("nombre", usuario.nombre);  
        SessionService.set("_token", usuario._token);       
        },
        unCacheSession : function(){
            SessionService.unset("auth");
            SessionService.unset("nombre");
            SessionService.unset("_token");
        }
    }
});

confControllers.factory('authUsuario',function($http,$location,SessionService,SessionSet,$state){

	return{
		loguear:function(credentials){
		var authUser = $http({method:'POST',url:'inicio/loguear',params:credentials});
		return authUser;
		},       
		  desloguear : function(){
            return $http({
                method:'GET',
                url : "usuario/desloguear"
            }).success(function(){
                //eliminamos la sesión de sessionStorage
                SessionSet.unCacheSession();
                //$state.go("login");
                //$route.reload();
            });
        },        
		    verificarLogueo : function(){               
            var authUser = $http({method:'GET',url:'usuario/verificarlogueo'});
            authUser.success(function(response){

              if (response.id > 0) {
                  SessionSet.cacheSession(response);                 
                  return SessionService.get("auth");
              }

            });
            
        },
        estaLogueado:function(){
          return SessionService.get("auth");
        },
        token:function(){
          return SessionService.get("_token");
        },
        nombreUsuario:function(){
          return SessionService.get("nombre");
        }        
	}
});  


