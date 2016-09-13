angular.module("module_app").config(function ($routeProvider, $locationProvider) {

//	$locationProvider.html5Mode(true);

	$routeProvider.when("/", {
		templateUrl: "pages/home.html",
		controller: "Controller_home"
	});

	$routeProvider.otherwise({redirectTo: "/"});
});