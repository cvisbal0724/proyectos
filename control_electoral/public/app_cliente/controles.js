App.directive('fileModel', ['$parse', function ($parse) {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            var model = $parse(attrs.fileModel);
            var modelSetter = model.assign;
            
            element.bind('change', function(){
                scope.$apply(function(){
                    modelSetter(scope, element[0].files[0]);
                });
            });
        }
    };
}]);


App.directive('metismenu', function() {
   return {
       // A = attribute, E = Element, C = Class and M = HTML Comment
       restrict:'A',
       link: function(scope, element, attrs) {           
           $(element).metisMenu();
        }
    }
 });   