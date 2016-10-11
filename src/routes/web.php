<?php

#Route::group(['middleware' => 'doNotCacheResponse'], function () {
#    Route::get('robots.txt', 'RobotsController@index');
#    Route::get('info', 'FrontendController@info');
#});

Route::group(['middleware' => ['web'], 'prefix' => config('admin.url')], function () {

    Route::get('/login', ['uses' => 'LoginController@showLoginForm', 'as' => 'admin.login.form']);
    Route::post('/login', ['uses' => 'LoginController@login', 'as' => 'admin.login']);
    Route::get('/logout', ['uses' => 'LoginController@logout', 'as' => 'admin.logout']);

    Route::get('/recover', ['uses' => 'PasswordController@showLinkRequestForm', 'as' => 'admin.recover.form']);
    Route::post('/recover', ['uses' => 'PasswordController@sendResetLinkEmail', 'as' => 'admin.recover']);
    Route::get('/recover/reset/{token?}', ['uses' => 'PasswordController@showResetForm', 'as' => 'admin.recover.reset']);
    Route::post('/recover/reset', ['uses' => 'PasswordController@reset', 'as' => 'admin.recover.reset.post']);

    Route::group(['middleware' => ['auth.admin']], function () {
        Route::get('/', ['uses' => 'AdmixController@dashboard', 'as' => 'admin.dashboard']);
        Route::get('/not-found', ['uses' => 'AdmixController@notFound', 'as' => 'admin.notFound']);
        Route::post('/summernote', ['uses' => 'AdmixController@summernote', 'as' => 'admin.summernote']);

        Route::get('/profile', ['uses' => 'ProfileController@edit', 'as' => 'admin.profile']);
        Route::put('/profile', ['uses' => 'ProfileController@update', 'as' => 'admin.profile.update']);

        Route::group(['middleware' => ['auth.rules']], function () {
            Route::get('users/trash', ['uses' => 'UsersController@index', 'as' => 'admin.users.trash']);
            Route::post('users/restore/{id}', ['uses' => 'UsersController@restore', 'as' => 'admin.users.restore']);
            Route::resource('users', 'UsersController', [
                'names' => [
                    'index' => 'admin.users.index',
                    'create' => 'admin.users.create',
                    'store' => 'admin.users.store',
                    'edit' => 'admin.users.edit',
                    'update' => 'admin.users.update',
                    'show' => 'admin.users.show'
                ], 'except' => ['destroy']]);
            Route::delete('users/destroy', ['uses' => 'UsersController@destroy', 'as' => 'admin.users.destroy']);

            Route::get('roles/trash', ['uses' => 'RolesController@index', 'as' => 'admin.roles.trash']);
            Route::post('roles/restore/{id}', ['uses' => 'RolesController@restore', 'as' => 'admin.roles.restore']);
            Route::resource('roles', 'RolesController', [
                'names' => [
                    'index' => 'admin.roles.index',
                    'create' => 'admin.roles.create',
                    'store' => 'admin.roles.store',
                    'edit' => 'admin.roles.edit',
                    'update' => 'admin.roles.update'
                ], 'except' => ['destroy', 'show']]);
            Route::delete('roles/destroy', ['uses' => 'RolesController@destroy', 'as' => 'admin.roles.destroy']);
        });
    });
});
