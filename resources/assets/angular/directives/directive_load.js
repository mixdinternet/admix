angular.module("module_app").directive("load", function($log){

	return{

		restrict: 'E',
		transclude: false,
		replace: false,
		template: 
			'<div id="fountainTextG">' +
				'<div id="fountainTextG_1" class="fountainTextG">A</div>' +
				'<div id="fountainTextG_2" class="fountainTextG">g</div>' +
				'<div id="fountainTextG_3" class="fountainTextG">u</div>' +
				'<div id="fountainTextG_4" class="fountainTextG">a</div>' +
				'<div id="fountainTextG_5" class="fountainTextG">r</div>' +
				'<div id="fountainTextG_6" class="fountainTextG">d</div>' +
				'<div id="fountainTextG_7" class="fountainTextG">e</div>' +
				'<div id="fountainTextG_8" class="fountainTextG">.</div>' +
				'<div id="fountainTextG_9" class="fountainTextG">.</div>' +
				'<div id="fountainTextG_10" class="fountainTextG">.</div>' +
			'</div>'

	}
});