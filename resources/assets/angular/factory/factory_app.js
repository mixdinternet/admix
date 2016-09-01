angular.module("module_app").factory("factory_app", function($log){
	
	return new function(){
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