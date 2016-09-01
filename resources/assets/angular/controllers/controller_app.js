angular.module("module_app").controller("controller_app", function(service_app, factory_app, $scope, $modal, $log){


	$scope.message = "Hello World!!!";

	// Iniciando o Slick
        $scope.slickConfig = {
            enabled: true
        }
    // -- // --

    // Iniciando o Select2
        $scope.itemArray = [
            {id: 1, name: 'first'},
            {id: 2, name: 'second'},
            {id: 3, name: 'third'},
            {id: 4, name: 'fourth'},
            {id: 5, name: 'fifth'}
        ];
        $scope.selected = { 
            value: $scope.itemArray[0] 
        };

        $scope.itemMotivoArray = [
            {id: 0, name: 'Selecione'},
            {id: 1, name: 'first'},
            {id: 2, name: 'second'},
            {id: 3, name: 'third'},
            {id: 4, name: 'fourth'},
            {id: 5, name: 'fifth'}
        ];

        $scope.selectedMotivo = { 
            value: $scope.itemMotivoArray[0] 
        };
    // -- // --

    // Funcação para enviar o Formulário
        $scope.submitForm = function(isValid) {

            // verifica se o formulário é válido
            if (isValid) {
                alert('Formulário OK');
            }

        };
    // -- // --


    var item1 = service_app.list_app();

    $log.log(item1);

});