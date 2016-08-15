## Admix

[![Total Downloads](https://poser.pugx.org/mixdinternet/admix/d/total.svg)](https://packagist.org/packages/mixdinternet/admix)
[![Latest Stable Version](https://poser.pugx.org/mixdinternet/admix/v/stable.svg)](https://packagist.org/packages/mixdinternet/admix)
[![License](https://poser.pugx.org/mixdinternet/admix/license.svg)](https://packagist.org/packages/mixdinternet/admix)

![Área administrativa](http://mixd.com.br/github/52218e3bd3237b4720cf1e6a0894e511.png "Área administrativa")

Admix é a estrutura inicial utilizada no desenvolvimento de sites da Mixd Internet.

Dentre os itens utilizados neste pacote podemos destacar:
* [Laravel 5.1](https://laravel.com/docs/5.1)
* [AdminLTE](https://almsaeedstudio.com/themes/AdminLTE/index.html)
* [Integração com o Analytics](https://github.com/spatie/laravel-analytics)
* [Gulp](http://gulpjs.com/)
* [NPM](https://www.npmjs.com/)
* [SASS](http://sass-lang.com/)
* [Foundation 6](http://foundation.zurb.com/)
* [AngularJS 1.5.8](https://angularjs.org/)
  * [Rotas](https://www.npmjs.com/package/angular-route)
  * [Paginação](https://github.com/michaelbromley/angularUtils/tree/master/src/directives/pagination)
  * [Select2](http://angular-ui.github.io/ui-select)
  * [Slick Carousel](https://www.npmjs.com/package/angular-slick-carousel)
  * [Input Masks - PT_BR](https://github.com/assisrafael/angular-input-masks)

## Pré Requisitos
[Homestead](https://laravel.com/docs/5.1/homestead) funcionando corretamente na máquina

Aumentar o timeout do composer `composer --global config process-timeout 2000` para que o npm install funcione

## Instalação
Executar dentro do homestead

```
$ cd ~/Code
$ composer create-project mixdinternet/admix Blog
```
Faça login na sua aplicação utilizando os dados gerados na instalação
```
Ex.
Usuário administrador criado.
E-mail => xxxx@xxxxx.xxx
Senha => xxxxx
```

Caso não encontre, gere um novo utilizando o comando
`php artisan db:seed`
(todos os dados do banco serão perdidos, então utilize somente na instalação)

## Configuração
O arquivo de configuração do Admix está em `config/admin.php`

Os dados de autenticação do envio dos e-mails deve ser feito no `.env`

## Contribuindo

Em breve disponibilizaremos alguns pacotes para "encaixar" junto ao Admix.

Caso tenha interesse em desenvolver algum, por favor entre em contato.

## Vulnerabilidades

Caso encontre alguma vulnerabilidade, por favor entre em contato.

### Licença

O Admix é open-source e nossa licença é [MIT](http://opensource.org/licenses/MIT)
