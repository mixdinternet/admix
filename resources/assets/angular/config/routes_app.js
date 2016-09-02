angular.module("module_app").config(function ($routeProvider, $locationProvider) {

//	$locationProvider.html5Mode(true);

	$routeProvider.when("/", {
		templateUrl: "pages/home.html",
		controller: "controller_home"
	})

	.when("/arquitetura", {
		templateUrl: "pages/arquitetura.html",
		controller: "controller_app"
	});

	$routeProvider.otherwise({redirectTo: "/"});
});