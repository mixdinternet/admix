angular.module("module_app").factory("factory_app", function($log){

	// Criando o Objeto
	var factoryApp = {

		// Iniciando as variáveis do objeto
			id : "",
			nome : "",
			nivel : "",


		// GETS AND SETS
			get_id: function(){
				return factoryApp.id;
			},
			set_id: function(id){
				factoryApp.id = id;
			},

			get_nome: function(){
				return factoryApp.nome;
			},
			set_nome: function(nome){
				factoryApp.nome = nome;
			},

			get_nivel: function(){
				return factoryApp.nivel;
			},
			set_nivel: function(nivel){
				factoryApp.nivel = nivel;
			}
	}



	// Retorna o objeto para o injetor
		return {
			NEW_factoryApp: function(){
				return factoryApp;
			}
		};

});