/* 
	Criando o módulo e injetando os componentes:
	- Rotas: https://www.npmjs.com/package/angular-route
	- Slick Slider: https://www.npmjs.com/package/angular-slick-carousel
	- Select 2: http://angular-ui.github.io/ui-select
	- Paginação: https://github.com/michaelbromley/angularUtils/tree/master/src/directives/pagination
	- Input Masks: https://github.com/assisrafael/angular-input-masks
	- Foundation: https://www.npmjs.com/package/angular-foundation-6
	- Animation Directives: https://docs.angularjs.org/guide/animations
	- Parallax: https://github.com/oblador/angular-parallax/blob/master/example/index.html
*/
angular.module("module_app", [
	"ngRoute", 
	"slickCarousel", 
	"ui.select", 
	"ngSanitize", 
	"angularUtils.directives.dirPagination", 
	"ui.utils.masks",
	"ngAnimate",
	"mm.foundation",
	"duParallax"	
]);