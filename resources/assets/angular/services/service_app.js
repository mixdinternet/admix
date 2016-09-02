angular.module("module_app").service("Service_app", function($http, $q, $log, Factory_app){

	return{

		// OBTENDO UMA LISTA DE APP
			list : function(){

				var deferred = $q.defer();

				$http.get("/jsons/app.json").then(function(response){

					var result = response.data;
					var list = new Array();
					
					for (var i = 0 ; i < result.length ; i++){
						
						var item = {Factory_app};
						item.id = result[i].id;
						item.nome = result[i].nome;
						list.push(item);
					}

					if(list.length > 0){
						deferred.resolve(list);
					}else{
						deferred.reject("não há dados");
					}

				}, function(data, status){
					deferred.reject("error");
				});

				return deferred.promise;
			},
		// -- // --			


		// INSERINDO UM APP NOVO
			insert : function(item){

				var deferred = $q.defer();

				$http.post("/jsons/app.json", item).then(function(response){
					deferred.resolve(true);
				}, function(data, status){
					deferred.reject(false);
				});

				return deferred.promise;
			},
		// -- // --			



	};

});