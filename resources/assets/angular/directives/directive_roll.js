angular.module("module_app").directive("roll", function($log){

	return{
		restrict: 'A',
		scope: {
			goto: '@'
		},
		link: function(scope, element){
			element.bind('click', function(){
				var point = angular.element(scope.goto).offset().top;
				$("html, body").animate({
					scrollTop: point
				}, 800);
			});
		}		
	}
});