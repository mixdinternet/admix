angular.module("module_app").controller("controller_app", function(service_app, $scope, $modal, $log){


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

    // Testando o Bean 
        var app_1 = new BeanApp();
        app_1.id = 1;
        app_1.nome = "Mixd";
        app_1.nivel = "Expert";

        var app_2 = new BeanApp();
        app_2.id = 2;
        app_2.nome = "House";
        app_2.nivel = "Medium";

        $scope.apps = new Array();
        $scope.apps.push(app_1);
        $scope.apps.push(app_2);
    // -- // --

});