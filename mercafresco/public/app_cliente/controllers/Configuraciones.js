confControllers.controller('ConfiguracionController', function ($scope,$http,$routeParams,$filter,filterFilter) {

		$scope.abrirCategorias=function(){

			//angular.element("#categoria-toggle").click(function(e) {
                 //e.preventDefault();
                 $("#sidebar-wrapper-categorias").toggleClass("show");
                 $('#back-fondo').toggle();
             //});

		}

});

