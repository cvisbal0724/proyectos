confControllers.filter('setDecimal', function ($filter) {
    return function (input, places) {
        if (isNaN(input)) return input;
        // If we want 1 decimal place, we want to mult/div by 10
        // If we want 2 decimal places, we want to mult/div by 100, etc
        // So use the following to create that factor
        var factor = "1" + Array(+(places > 0 && places + 1)).join("0");
        return Math.round(input * factor) / factor;
    };
});


confControllers.config(function($httpProvider) {

            $httpProvider.interceptors.push(function($q, $rootScope) {
                return {
                    'request': function(config) {
                        $rootScope.$broadcast('loading-started');
                        return config || $q.when(config);
                    },
                    'response': function(response) {
                        $rootScope.$broadcast('loading-complete');
                        return response || $q.when(response);
                    }
                };
            });

        });


confControllers.directive("loadingIndicator", function($location) {
            return {
                restrict : "A",
                template: '<div class="pop-fondo"></div><img class="pop-imagen" src="app_cliente/img/gif-load.gif">',
                link : function(scope, element, attrs) {
                    scope.$on("loading-started", function(e) {
                        element.css({"display" : ""});                       
                    });

                    scope.$on("loading-complete", function(e) {
                        element.css({"display" : "none"});     

                    });

                }
            };
        });

confControllers.directive('autoFocus', function($timeout) {
    return {
        restrict: 'AC',
        link: function(_scope, _element) {
            $timeout(function(){
                _element[0].focus();
            }, 0);
        }
    };
});


confControllers.directive('zoonImage', function() {
     return {
         // A = attribute, E = Element, C = Class and M = HTML Comment
         restrict:'A',
         link: function(scope, element, attrs) {
           
            $(element).imageLens({ lensSize: 200  });

          }
      }
 });   
