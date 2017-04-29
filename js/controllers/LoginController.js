angular.module('UserApp').controller('LoginController', [
'$rootScope', 
'$scope', 
'settings',
'$http',
'$window',
'$location',
'$templateCache',
'$stateParams',
'$state', function($rootScope, $scope, settings,$http,$window,$location,$templateCache,$stateParams,$state) {
    $scope.$on('$viewContentLoaded', function() {   
        // initialize core components
        //App.initAjax();
		$scope.login_user=function(u_data){
		  //console.log(u_data);
		  var u_info = $.param({
                email:u_data.email,
                password:u_data.password,
                 });  
	     // console.log(u_info);
			   if ($scope.login_form.$valid) 
			       {
					var config = {headers : {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}}
                    $http.post('check_login_user',u_info,config).success(function (userdata, status, headers, config) {
             	         
						   if(userdata=="Admin"){
							  // alert();
							  // console.log('sddd');
				  			 $window.location.href = 'admin_dashboard';
				         	 }
							 else if(userdata=="Job_seeker"){
								
								 	$window.location.href = 'job_seeker';
							 }
							 else if(userdata=="Employer")
							 {
								 
								  	$window.location.href = 'Employer';
							 }
							 else{
								 alert("Not")
							 }
             		  });
                   }  
		}
	   
			
    });

    // set sidebar closed and body solid layout mode
    $rootScope.settings.layout.pageContentWhite = true;
    $rootScope.settings.layout.pageBodySolid = false;
    $rootScope.settings.layout.pageSidebarClosed = false;
}]);


UserApp.directive('starRating',
	function() {
		return {
			restrict : 'A',
			template : '<ul class="rating">'
					 + '	<li ng-repeat="star in stars" ng-class="star" >'
					 + '\u2605'
					 + '</li>'
					 + '</ul>',
			scope : {
				ratingValue : '=',
				max : '=',
				onRatingSelected : '&'
			},
			link : function(scope, elem, attrs) {
				var updateStars = function() {
					scope.stars = [];
					for ( var i = 0; i < scope.max; i++) {
						scope.stars.push({
							filled : i < scope.ratingValue
						});
					}
				};
				
				scope.toggle = function(index) {
					scope.ratingValue = index + 1;
					scope.onRatingSelected({
						rating : index + 1
					});
				};
				
				scope.$watch('ratingValue',
					function(oldVal, newVal) {
						if (newVal) {
							updateStars();
						}
					}
				);
			}
		};
	}
);



