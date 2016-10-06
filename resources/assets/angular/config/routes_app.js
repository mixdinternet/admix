angular.module("module_app").config(function ($routeProvider, $locationProvider) {

	var title_sufixo = " | Admix";

	$routeProvider.when("/", {
		templateUrl: "pages/home.html",
		controller: "Controller_home",
		title: "Home" + title_sufixo
	});

	$routeProvider.otherwise({redirectTo: "/"});
});