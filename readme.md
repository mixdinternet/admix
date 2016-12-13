## Admix

[![Total Downloads](https://poser.pugx.org/mixdinternet/admix/d/total.svg)](https://packagist.org/packages/mixdinternet/admix)
[![Latest Stable Version](https://poser.pugx.org/mixdinternet/admix/v/stable.svg)](https://packagist.org/packages/mixdinternet/admix)
[![License](https://poser.pugx.org/mixdinternet/admix/license.svg)](https://packagist.org/packages/mixdinternet/admix)

![Área administrativa](http://mixd.com.br/github/52218e3bd3237b4720cf1e6a0894e511.png "Área administrativa")

Admix é a estrutura inicial utilizada no desenvolvimento de sites da Mixd Internet.

Dentre os itens utilizados neste pacote podemos destacar:
* [Laravel 5.3](https://laravel.com/docs/5.3)
* [AdminLTE](https://almsaeedstudio.com/themes/AdminLTE/index.html)
* [Integração com o Analytics](https://github.com/spatie/laravel-analytics)

## Pré Requisitos
[Homestead](https://laravel.com/docs/5.3/homestead) funcionando corretamente na máquina

## Instalação
Executar dentro do homestead

```
$ cd ~/Code
$ composer create-project laravel/laravel Blog
$ cd Blog
$ composer require mixdinternet/admix
```

Registrando nosso pacote em config/app.php

```
Mixdinternet\Admix\Providers\AdmixServiceProvider::class,
```

Publicando os arquivos necessários

```
$ php artisan vendor:publish --provider="Mixdinternet\Admix\Providers\AdmixServiceProvider" --tag=install
```

Crie as tabelas da aplicação

```
$ php artisan migrate
```

Crie o usuário e teste

```
$ php artisan db:seed --class=AdmixTableSeeder
```

Faça login na sua aplicação utilizando os dados gerados na instalação

```
Ex.
Usuário administrador criado.
E-mail => xxxx@xxxxx.xxx
Senha => xxxxx
```

## Configuração
O arquivo de configuração do Admix está em `config/admin.php`

Os dados de autenticação do envio dos e-mails deve ser feito no `.env`
Não esqueça do `APP_URL`

Melhorando o `.gitignore`

```
/.idea/*
/nbproject
/node_modules
/public/cache/*
/public/media/*
/public/storage
/storage/database.sqlite
/storage/cache/*
/vendor
Homestead.json
Homestead.yaml
.env
._*
.sub*
.smb*
.DS_Store
```

## Contribuindo

Em breve disponibilizaremos alguns pacotes para "encaixar" junto ao Admix.

Caso tenha interesse em desenvolver algum, por favor entre em contato.

## Vulnerabilidades

Caso encontre alguma vulnerabilidade, por favor entre em contato.

### Licença

O Admix é open-source e nossa licença é [MIT](http://opensource.org/licenses/MIT)
