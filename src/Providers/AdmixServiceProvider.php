<?php

namespace Mixdinternet\Admix\Providers;

use Illuminate\Support\ServiceProvider;
use Pingpong\Menus\MenuFacade as Menu;
use Carbon\Carbon as Carbon;

class AdmixServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->providers();

        $this->setMenu();

        $this->setRoutes();

        $this->setMiddlewares();

        $this->loadViews();

        $this->loadMigrations();

        $this->publish();

        #php artisan vendor:publish --provider="Mixdinternet\Admix\Providers\AdmixServiceProvider" --tag=install
    }

    public function register()
    {
        $this->loadConfigs();

        $this->app->singleton(
            \Illuminate\Contracts\Debug\ExceptionHandler::class,
            \Mixdinternet\Admix\Exceptions\Handler::class
        );
    }

    protected function setMenu()
    {
        Menu::create('adminlte-sidebar', function ($menu) {
            $menu->setView('vendor.pingpong.menus.adminlte.default');
            $menu->dropdown('Usuários', function ($sub) {
                $sub->route('admin.users.index', 'Usuários', [], 1
                    , ['icon' => 'fa fa-minus', 'active' => function () {
                        return checkActive(route('admin.users.index'));
                    }])->hideWhen(function () {
                    return checkRule('admin.users.index');
                });
                $sub->route('admin.roles.index', 'Grupos', [], 1
                    , ['icon' => 'fa fa-minus', 'active' => function () {
                        return checkActive(route('admin.roles.index'));
                    }])->hideWhen(function () {
                    return checkRule('admin.roles.index');
                });
            }, 1, ['icon' => 'fa fa-users'])->hideWhen(function(){
                return checkRule(['admin.users.index', 'admin.roles.index']);
            });
        });

        Menu::create('adminlte-permissions', function ($menu) {
            $menu->setView('vendor.pingpong.menus.adminlte.permissions');
            $menu->url('admin.users', 'Usuários', ['']);
            $menu->url('admin.roles', 'Grupos', ['']);
        });
    }

    protected function setRoutes()
    {
        if (!$this->app->routesAreCached()) {
            $this->app->router->group(['namespace' => 'Mixdinternet\Admix\Http\Controllers'],
                function () {
                    require __DIR__ . '/../routes/web.php';
                });
        }
    }

    protected function setMiddlewares()
    {
        $this->app->router->middleware('auth.admin', \Mixdinternet\Admix\Http\Middleware\AdmixAuthenticate::class);
        $this->app->router->middleware('auth.rules', \Mixdinternet\Admix\Http\Middleware\VerifyRules::class);
    }

    protected function loadViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'mixdinternet/admix');
    }

    protected function loadMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    protected function loadConfigs()
    {
        Carbon::setLocale(config('app.locale'));
        date_default_timezone_set(config('app.timezone'));
        setlocale(LC_ALL, config('app.locale').'.utf8');

        config(['auth.providers.users.model' => \Mixdinternet\Admix\User::class]);

        $this->mergeConfigFrom(__DIR__ . '/../config/admin.php', 'admin');
    }

    protected function publish()
    {
        $this->publishes([
            __DIR__ . '/../resources/views' => base_path('resources/views/vendor/mixdinternet/admix'),
        ], 'views');

        $this->publishes([
            __DIR__ . '/../config' => base_path('config'),
            __DIR__ . '/../resources/lang' => base_path('resources/lang'),
            __DIR__ . '/../resources/vendor' => base_path('resources/views/vendor'),
            #__DIR__ . '/../database/seeds' => base_path('database/seeds'),
            __DIR__ . '/../public/assets' => public_path('assets'),
        ], 'install');
    }

    protected function providers()
    {
        $this->app->register(\Mixdinternet\Core\Providers\CoreServiceProvider::class);
        $this->app->register(\Mixdinternet\Mconfig\Providers\MconfigServiceProvider::class);
        $this->app->register(\Artesaos\SEOTools\Providers\SEOToolsServiceProvider::class);
        $this->app->register(\Watson\BootstrapForm\BootstrapFormServiceProvider::class);
        $this->app->register(\Caffeinated\Flash\FlashServiceProvider::class);
        $this->app->register(\Collective\Html\HtmlServiceProvider::class);
        $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        $this->app->register(\Codesleeve\LaravelStapler\Providers\L5ServiceProvider::class);
        $this->app->register(\Cviebrock\EloquentSluggable\ServiceProvider::class);
        $this->app->register(\Folklore\Image\ImageServiceProvider::class);
        $this->app->register(\Spatie\LaravelAnalytics\LaravelAnalyticsServiceProvider::class);
        $this->app->register(\Pingpong\Menus\MenusServiceProvider::class);

        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('BootForm', \Watson\BootstrapForm\Facades\BootstrapForm::class);
        $loader->alias('SEO', \Artesaos\SEOTools\Facades\SEOTools::class);
        $loader->alias('Flash', \Caffeinated\Flash\Facades\Flash::class);
        $loader->alias('Form', \Collective\Html\FormFacade::class);
        $loader->alias('Html', \Collective\Html\HtmlFacade::class);
        $loader->alias('Carbon', \Carbon\Carbon::class);
        $loader->alias('Image', \Folklore\Image\Facades\Image::class);
        $loader->alias('Debugbar', \Barryvdh\Debugbar\Facade::class);
        $loader->alias('LaravelAnalytics', \Spatie\LaravelAnalytics\LaravelAnalyticsFacade::class);
        $loader->alias('Menu', \Pingpong\Menus\MenuFacade::class);
    }
}
