angular.module("module_app").controller("Controller_app", function($scope, $log){

	/*
		Aplicando o title das páginas
		---------------------------------------
	*/
		$scope.$on('$routeChangeStart', function(next, current) { 
	   		$("html head title").html(current.$$route.title);
	 	});	
	/* -- // -- */

});