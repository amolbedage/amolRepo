angular.module('UserApp').controller('HomeController', ['$rootScope', '$scope',  function($rootScope, $scope) {
    $scope.$on('$viewContentLoaded', function() {   
        // initialize core components
        //App.initAjax();
			
			$scope.saveinfo=function(sinfo){
			console.log(sinfo);
			  
			}	
			
    });

 
}]);


