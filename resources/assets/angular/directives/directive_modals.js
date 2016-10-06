angular.module("module_app").directive("modal", function($timeout){

	return{

		restrict: "E",
		transclude: true,
		replace: true,
		scope: {
			modal_id: "@id",
			modal_content: "=content"
		},
		template: 
			'<div class="modal">' +
				'<div class="modal-opacity" ng-click="close();"></div>' +
				'<div class="vertical-align">' +
					'<div class="modal-container">' +
						'<div class="modal-close">' +
							'<button class="btn-close" title="Fechar!" ng-click="close();">' +
								'<img src="../assets/img/icon-modal-close.png" alt="Botão fechar"/>' +
							'</button>' +
						'</div>' +
						'<div class="modal-content" ng-bind-html="modal_content" ng-if="modal_content != undefined"></div>' +
						'<div class="modal-content" ng-transclude ng-if="modal_content == undefined"></div>' +
					'</div>' +
				'</div>' +
			'</div>',
		link: function(scope, element){

			$timeout(function(){
				// Close
				scope.close = function(){
					angular.element(element).removeClass("open");
				};

				// Open
				var elementOpen = angular.element("html").find("*[modal-target=" + scope.modal_id + "]");
				elementOpen.bind("click", function(){
					angular.element(element).addClass("open");
				});

			});
		}
	};
});