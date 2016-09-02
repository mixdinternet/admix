angular.module("module_app").factory("Factory_app", function($log){
	
	return function(){
		this.id;
		this.nome;

		this.getId = function(){
			return this.id;
		};
		this.setId = function (id){
			this.id = id;
		};
	};

});