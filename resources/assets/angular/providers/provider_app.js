angular.module("module_app").provider("provider_app", function(service_app, $log){

	// Retorna uma lista de app
		function provider_list(){
//			return service_app.getListApp();
		}

	// Retorna o app desejado através do id passado como parâmetro
		function provider_id(id){
//			return service_app.getApp();
			var nome = "Leo";
			return nome;
		}

	// Inseri um app no banco através do id passado como parâmetro e retorna um boolean como resposta do insert
		function provider_set(id){
//			return service_app.setApp(id);
		}


	// Atualiza um app no banco através do id passado como parâmetro e retorna um boolean como resposta do update
		function provider_update(id){
//			return service_app.updateApp(id);
		}


	// Deleta um app no banco através do id passado como parâmetro e retorn um boolean como resposta do delete
		function provider_delete(id){
//			return service_app.deleteApp(id);
		}


		return {

			GET_provider_list: function(){
				return provider_list();
			},

			GET_provider_id: function(id){
				return provider_id(id);
			}

		}

});