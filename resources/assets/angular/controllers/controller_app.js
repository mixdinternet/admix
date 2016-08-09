angular.module("module_app").controller("controller_app", function($scope){

	$scope.message = "Hello World!!!";

	// Iniciando o Slick exmeplo
    $scope.slickConfig = {
        enabled: true
    }

    // Iniciando o Select2 exemplo
    $scope.itemArray = [
        {id: 1, name: 'first'},
        {id: 2, name: 'second'},
        {id: 3, name: 'third'},
        {id: 4, name: 'fourth'},
        {id: 5, name: 'fifth'},
    ];
    $scope.selected = { value: $scope.itemArray[0] };

});