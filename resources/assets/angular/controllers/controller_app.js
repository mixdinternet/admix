angular.module("module_app").controller("controller_app", function(Service_app, Factory_app, $scope, $modal, $log){

    // Atualiza a table
    function refresh_table(){
        
        // Definindo o intervalo de tempo da atualização em segundos
        var time = 2.5;

        // Aplica a atualização de acordo com o tempo do parâmetro
        var segundos = time * 1000;
        setTimeout(function() {

            // Lista a table
            Service_app.list_app().then(function(result){ 
               $scope.apps = result;
            }, function(result){
               $log.log(result);
            });

            // Renicia o refresh
            setTimeout(function() {
                $log.log("atualiza");
                refresh_table();
            }, segundos);

        }, segundos);
    }

    // Lista a table
    Service_app.list_app().then(function(result){ 
        // Aplica o resultado
        $scope.apps = result;
        // Inicia o refresh table
        refresh_table();

    }, function(result){
        $log.log(result);
    });

});