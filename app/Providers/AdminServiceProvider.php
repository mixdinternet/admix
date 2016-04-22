<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Menu;
use Carbon;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
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

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Carbon::setLocale(config('app.locale'));
        setlocale (LC_ALL, config('app.locale').'.utf8');

        //define um atalho para retornar o usuário vinculado à rota
        $this->app->bind('currentUser', function ($app) {
            $request = $this->app->make('Illuminate\Http\Request');
            $route = $this->app->make('Illuminate\Routing\Route');

            $userBindParameters = $route->bindParameters($request);
            return $userBindParameters['users'];
        });
    }
}
