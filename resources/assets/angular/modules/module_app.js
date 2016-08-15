/* 
	Criando o módulo e injetando os componentes:
	- Rotas
	- Slick Slider
	- Select 2
	- Paginação
	- Input Masks
*/
angular.module("module_app", ["ngRoute", "slickCarousel", "ui.select", "ngSanitize", "angularUtils.directives.dirPagination", "ui.utils.masks"]);