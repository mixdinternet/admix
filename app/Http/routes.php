<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'FrontendController@welcome');

Route::group(['middleware' => 'doNotCacheResponse'], function () {
    Route::get('robots.txt', 'RobotsController@index');
    Route::get('deploy', 'DeployController@index');
    Route::get('info', 'FrontendController@info');
    Route::get('opre', 'FrontendController@opre');
});

Route::group(['prefix' => config('admin.url')], function () {

    Route::get('/login', ['uses' => 'AdminController@loginView', 'as' => 'admin.login.view']);
    Route::post('/login', ['uses' => 'AdminController@postLogin', 'as' => 'admin.login']);
    Route::get('/logout', ['uses' => 'AdminController@getLogout', 'as' => 'admin.logout']);

    Route::get('/recover', ['uses' => 'AdminPasswordController@recoverView', 'as' => 'admin.recover.view']);
    Route::post('/recover', ['uses' => 'AdminPasswordController@postEmail', 'as' => 'admin.recover.post']);
    Route::get('/recover/reset/{token}', ['uses' => 'AdminPasswordController@getReset', 'as' => 'admin.recover.reset']);
    Route::post('/recover/reset', ['uses' => 'AdminPasswordController@postReset', 'as' => 'admin.recover.reset.post']);

    Route::group(['middleware' => ['auth.admin']], function () {
        Route::get('/', ['uses' => 'AdminController@dashboard', 'as' => 'admin.dashboard']);
        Route::get('/not-found', ['uses' => 'AdminController@notFound', 'as' => 'admin.notFound']);
        Route::post('/summernote', ['uses' => 'AdminController@summernote', 'as' => 'admin.summernote']);

        Route::get('/profile', ['uses' => 'UsersAdminController@profile', 'as' => 'admin.profile']);
        Route::put('/profile', ['uses' => 'UsersAdminController@profileUpdate', 'as' => 'admin.profile.update']);

        Route::group(['middleware' => ['auth.rules']], function () {
            Route::get('users/trash', ['uses' => 'UsersAdminController@index', 'as' => 'admin.users.trash']);
            Route::post('users/restore/{id}', ['uses' => 'UsersAdminController@restore', 'as' => 'admin.users.restore']);
            Route::resource('users', 'UsersAdminController', [
                'names' => [
                    'index' => 'admin.users.index',
                    'create' => 'admin.users.create',
                    'store' => 'admin.users.store',
                    'edit' => 'admin.users.edit',
                    'update' => 'admin.users.update',
                    'show' => 'admin.users.show'
                ], 'except' => ['destroy']]);
            Route::delete('users/destroy', ['uses' => 'UsersAdminController@destroy', 'as' => 'admin.users.destroy']);

            Route::get('roles/trash', ['uses' => 'RolesAdminController@index', 'as' => 'admin.roles.trash']);
            Route::post('roles/restore/{id}', ['uses' => 'RolesAdminController@restore', 'as' => 'admin.roles.restore']);
            Route::resource('roles', 'RolesAdminController', [
                'names' => [
                    'index' => 'admin.roles.index',
                    'create' => 'admin.roles.create',
                    'store' => 'admin.roles.store',
                    'edit' => 'admin.roles.edit',
                    'update' => 'admin.roles.update',
                    'show' => 'admin.roles.show'
                ], 'except' => ['destroy']]);
            Route::delete('roles/destroy', ['uses' => 'RolesAdminController@destroy', 'as' => 'admin.roles.destroy']);
        });
    });
});