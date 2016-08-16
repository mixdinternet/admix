/* 
	Criando o módulo e injetando os componentes:
	- Rotas
	- Slick Slider: https://www.npmjs.com/package/angular-slick-carousel
	- Select 2: http://angular-ui.github.io/ui-select
	- Paginação: https://github.com/michaelbromley/angularUtils/tree/master/src/directives/pagination
	- Input Masks: https://github.com/assisrafael/angular-input-masks
	- Foundation: https://www.npmjs.com/package/angular-foundation-6
	- Animation Directives: https://docs.angularjs.org/guide/animations
*/
angular.module("module_app", [
	"ngRoute", 
	"slickCarousel", 
	"ui.select", 
	"ngSanitize", 
	"angularUtils.directives.dirPagination", 
	"ui.utils.masks",
	"ngAnimate",
	"mm.foundation"
]);