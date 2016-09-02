angular.module("module_app").controller("controller_app", function(Service_app, Factory_app, $scope, $modal, $log){

    // Lista a table
    Service_app.list().then(function(result){ 
       $scope.apps = result;
    }, function(result){
       $log.log(result);
    });

    // Novo Objeto
    var app = {Factory_app};
    app.id = 5;
    app.nome = "Mixd";

    // Adicionando um novo objeto no Banco de dados
    Service_app.insert(app).then(function(response){
        $log.log(response);
    }, function(response){
        $log.log(response);
    });

});