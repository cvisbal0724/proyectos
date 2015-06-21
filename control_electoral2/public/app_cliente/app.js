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
        url: "/inicio",              
        templateUrl: "inicio/home", 
        //controller: 'HomeController'
       })
      .state('home.inicio', {
        url: "/",        
        views:{
          'contenedor':{templateUrl: "inicio/dashboard",},
          'notificaciones':{templateUrl:'layouts/notificaciones'}
        }              
         
        //controller: 'HomeController'
       })
      .state('home.registrar_partidos', {
        url: "/registrar-partido", 
         views:{
          'contenedor':{templateUrl: "partido/partido",controller: 'PartidoController'},
          'titulo':{template:'Registrar Partido'},
          'nombre-proyecto':{templateUrl:'layouts/nombre_proyecto'}
        }  
       })
      .state('home.registrar_alcaldes', {
        url: "/registrar-alcalde", 
         views:{
          'contenedor':{templateUrl: "alcalde/alcalde",controller: 'AlcaldeController'},
          'titulo':{template:'Registrar Alcalde'},
          'nombre-proyecto':{templateUrl:'layouts/nombre_proyecto'}
        }  
       })
      .state('home.registrar_personas', {
        url: "/registrar-persona", 
        views:{
          'contenedor':{templateUrl: "persona/persona",controller: 'PersonaController'},
          'titulo':{template:'Registrar Persona'},
          'nombre-proyecto':{templateUrl:'layouts/nombre_proyecto'}
        }  
       })
      .state('home.consultar_personas', {
        url: "/consultar-persona",
        views:{
          'contenedor':{templateUrl: "persona/consultar_persona",controller: 'PersonaController'},
          'titulo':{template:'Consultar Persona'},
          'nombre-proyecto':{templateUrl:'layouts/nombre_proyecto'}
        }  
       })
      .state('home.editar_personas', {
        url: "/editar-persona/:id",
         views:{
          'contenedor':{templateUrl: "persona/persona",controller: 'PersonaController'},
          'titulo':{template:'Actualizar Persona'},
          'nombre-proyecto':{templateUrl:'layouts/nombre_proyecto'}
        }  
       })
      .state('home.registrar_perfiles', {
        url: "/registrar-perfiles", 
        views:{
          'contenedor':{templateUrl: "perfiles/perfiles",controller: 'PerfilesController'},
          'titulo':{template:'Registrar Perfil'},
          'nombre-proyecto':{templateUrl:'layouts/nombre_proyecto'}
        }  
       })
      .state('home.perfil_modulos', {
        url: "/perfil-modulos/:id_perfil", 
        views:{
          'contenedor':{templateUrl: "perfiles/perfil_modulos",controller: 'PerfilesController'},
          'titulo':{template:'Perfil Modulos'},
          'nombre-proyecto':{templateUrl:'layouts/nombre_proyecto'}
        }  
       })
      .state('home.registrar_modulos', {
        url: "/registrar-modulo",             
        views:{
          'contenedor':{templateUrl: "modulos/modulos",controller: 'ModulosController'},
          'titulo':{template:'Registrar Modulo'},
          'nombre-proyecto':{templateUrl:'layouts/nombre_proyecto'}
        }  
       })
      .state('home.registrar_menus', {
        url: "/menu/:id_modulo?",
         views:{
          'contenedor':{templateUrl: "menus/menus",controller: 'MenuController'},
          'titulo':{template:'Registrar Menu'},
          'nombre-proyecto':{templateUrl:'layouts/nombre_proyecto'}
        }  
       })
      .state('home.registrar_usuarios', {
        url: "/registrar-usuarios",
         views:{
          'contenedor':{templateUrl: "usuario/usuario",controller: 'UsuarioController'},
          'titulo':{template:'Registrar Usuario'},
          'nombre-proyecto':{templateUrl:'layouts/nombre_proyecto'},
          'persona':{templateUrl:'persona/nueva_persona',controller:'PersonaController'}
        }  
       })
       .state('home.consultar_usuarios', {
        url: "/consultar-usuarios", 
         views:{
          'contenedor':{templateUrl: "usuario/consultar_usuario",controller: 'UsuarioController'},
          'titulo':{template:'Consultar Usuario'},
          'nombre-proyecto':{templateUrl:'layouts/nombre_proyecto'}
        }  
       })
       .state('home.editar_usuarios', {
        url: "/editar-usuarios/:id",       
         views:{
          'contenedor':{templateUrl: "usuario/usuario",controller: 'UsuarioController'},
          'titulo':{template:'Actualizar Usuario'},
          'nombre-proyecto':{templateUrl:'layouts/nombre_proyecto'},
          'persona':{templateUrl:'persona/nueva_persona',controller:'PersonaController'}
        }  
       })
       .state('home.registrar_concejales', {
        url: "/registrar-concejal",        
         views:{
          'contenedor':{templateUrl: "concejal/concejal",controller: 'ConcejalController'},
          'titulo':{template:'Registrar Concejal'},
          'nombre-proyecto':{templateUrl:'layouts/nombre_proyecto'},
          'persona':{templateUrl:'persona/nueva_persona',controller:'PersonaController'}
        }  
       })
        .state('home.consultar_concejales', {
        url: "/consultar-concejal",       
         views:{
          'contenedor':{templateUrl: "concejal/consultar_concejal",controller: 'ConcejalController'},
          'titulo':{template:'Consultar Concejal'},
          'nombre-proyecto':{templateUrl:'layouts/nombre_proyecto'}
        }  
       })
        .state('home.editar_concejales', {
        url: "/editar-concejal/:id",       
        views:{
          'contenedor':{templateUrl: "concejal/concejal",controller: 'ConcejalController'},
          'titulo':{template:'Actualizar Concejal'},
          'nombre-proyecto':{templateUrl:'layouts/nombre_proyecto'},
          'persona':{templateUrl:'persona/nueva_persona',controller:'PersonaController'}
        }  
       })
      .state('home.registrar_lideres', {
        url: "/registrar-lider",        
        views:{
          'contenedor':{templateUrl: "lideres/lider",controller: 'LiderController'},
          'titulo':{template:'Registrar Lider'},
          'nombre-proyecto':{templateUrl:'layouts/nombre_proyecto'},
          'persona':{templateUrl:'persona/nueva_persona',controller:'PersonaController'}
        }  
       })
       .state('home.consultar_lideres', {
        url: "/consultar-lider",       
         views:{
          'contenedor':{templateUrl: "lideres/consultar_lider",controller: 'LiderController'},
          'titulo':{template:'Consultar Lider'},
          'nombre-proyecto':{templateUrl:'layouts/nombre_proyecto'}
        }  
       })
       .state('home.asociar_concejales', {
        url: "/asociar-concejales/:id_lider",       
        views:{
          'contenedor':{templateUrl: "lideres/asociar_concejales",controller: 'LiderController'},
          'titulo':{template:'Asociar Concejales'},
          'nombre-proyecto':{templateUrl:'layouts/nombre_proyecto'}
        }  
       })
       .state('home.registrar_votantes', {
        url: "/registrar-votante",        
        views:{
          'contenedor':{templateUrl: "votantes/votante",controller: 'VotanteController'},
          'titulo':{template:'Registrar Votante'},
          'nombre-proyecto':{templateUrl:'layouts/nombre_proyecto'},
          'persona':{templateUrl:'persona/nueva_persona',controller:'PersonaController'}
        }  
       })
       .state('home.consultar_votantes', {
        url: "/consultar-votante",        
         views:{
          'contenedor':{templateUrl: "votantes/consultar_votante",controller: 'VotanteController'},
          'titulo':{template:'Consultar Votante'},
          'nombre-proyecto':{templateUrl:'layouts/nombre_proyecto'}
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
                url : "inicio/desloguear"
            }).success(function(){
                //eliminamos la sesión de sessionStorage
                SessionSet.unCacheSession();
                //$state.go("login");
                //$route.reload();
            });
        },        
		    verificarLogueo : function(){               
            var authUser = $http({method:'GET',url:'inicio/verificarlogueo'});
            authUser.success(function(response){

              if (response.auth) {
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


