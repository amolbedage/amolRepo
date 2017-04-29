/***
Metronic AngularJS App Main Script
***/

/* Metronic App */
var UserApp = angular.module("UserApp", [
    "ui.router", 
    "oc.lazyLoad",  
   
])

/* Configure ocLazyLoader(refer: https://github.com/ocombe/ocLazyLoad) */
UserApp.config(['$ocLazyLoadProvider', function($ocLazyLoadProvider) {
    $ocLazyLoadProvider.config({
        // global configs go here
    });
}]);


UserApp.filter('urlencode', function() {
  return function(input) {
    return window.encodeURIComponent(input);
  }
});
/********************************************
 BEGIN: BREAKING CHANGE in AngularJS v1.3.x:
*********************************************/
/**
`$controller` will no longer look for controllers on `window`.
The old behavior of looking on `window` for controllers was originally intended
for use in examples, demos, and toy apps. We found that allowing global controller
functions encouraged poor practices, so we resolved to disable this behavior by
default.

To migrate, register your controllers with modules rather than exposing them
as globals:

Before:

```javascript
function MyController() {
  // ...
}
```

After:

```javascript
angular.module('myApp', []).controller('MyController', [function() {
  // ...
}]);

Although it's not recommended, you can re-enable the old behavior like this:

```javascript
angular.module('myModule').config(['$controllerProvider', function($controllerProvider) {
  // this option might be handy for migrating old apps, but please don't use it
  // in new ones!
  $controllerProvider.allowGlobals();
}]);
**/

//AngularJS v1.3.x workaround for old style controller declarition in HTML
UserApp.config(['$controllerProvider', function($controllerProvider) {
  // this option might be handy for migrating old apps, but please don't use it
  // in new ones!
  $controllerProvider.allowGlobals();
}]);

/********************************************
 END: BREAKING CHANGE in AngularJS v1.3.x:
*********************************************/



/***
Layout Partials.
By default the partials are loaded through AngularJS ng-include directive. In case they loaded in server side(e.g: PHP include function) then below partial 
initialization can be disabled and Layout.init() should be called on page load complete as explained above.
***/

/* Setup Layout Part - Header */
UserApp.controller('HeaderController', ['$scope','$rootScope','$http','$window','$location','$state', function($scope,$rootScope,$http,$window,$location,$state) {
    $scope.$on('$includeContentLoaded', function() {
		
	
	
		
		
       // Layout.initHeader(); // init header
    });
}]);




/* Setup Layout Part - Footer */
UserApp.controller('FooterController', ['$scope','$http','$window', function($scope,$http,$window) {
    $scope.$on('$includeContentLoaded', function() {
		
	
		
		
		
      //  Layout.initFooter(); // init footer
    });
}]);

/* Setup Rounting For All Pages */
UserApp.config(['$stateProvider', '$urlRouterProvider','$locationProvider', function($stateProvider, $urlRouterProvider,$locationProvider) {
    // Redirect any unmatched url
	
	$locationProvider.html5Mode(function(){
		requireBase:false
	});
    $urlRouterProvider.otherwise("/home");  
    
    $stateProvider

        // Dashboard
        .state('home', {
		    url: "/home",
			templateUrl: "views/home.html",  
            data: {pageTitle: 'Admin Dashboard Template'},
             controller: "HomeController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({
                        name: 'UserApp',
                      //  insertBefore: '#ng_load_plugins_before', // load the above css files before a LINK element with this ID. Dynamic CSS files must be loaded between core and theme css files
                        files: [
                           'js/controllers/HomeController.js',
                        ] 
                    });
                }]
            }
        })
		
		
          
		

}]);



  