angular.module("module_app").service("service_app", function($http, $log, factory_app){


	return{

		list_app : function(){

			var list = new Array();
			var item = factory_app;

			for (var i = 0; i < 5; i++){
				item.id = i;
				item.nome = "Test" + i;
				$log.log(item);
				list.push(item);
			}

			return list;
		}

	};



});