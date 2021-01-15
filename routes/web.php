<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['auth.redirect']], function () {
    Route::get('/login', 'LoginController@loginForm')->name('login');
    Route::post('/login', 'LoginController@loginProcess');
});
Route::get('/logout', 'LoginController@logout');

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function () {
        Route::get('/', 'Admin\HomeController@index');
        Route::group(['prefix' => 'user'], function () {
            Route::get('/', 'Admin\UserController@index');
            Route::get('/add', 'Admin\UserController@create');
            Route::post('/add', 'Admin\UserController@store');
            Route::group(['prefix' => '{user_id}'], function () {
                Route::get('/', 'Admin\UserController@show');
                Route::get('/edit', 'Admin\UserController@edit');
                Route::put('/edit', 'Admin\UserController@update');
                Route::delete('/', 'Admin\UserController@destroy');
            });
        });

        Route::group(['prefix' => 'role'], function () {
            Route::get('/', 'Admin\RoleController@index');
            Route::get('/add', 'Admin\RoleController@create');
            Route::post('/add', 'Admin\RoleController@store');
            Route::group(['prefix' => '{role_id}'], function () {
                Route::get('/', 'Admin\RoleController@show');
                Route::get('/edit', 'Admin\RoleController@edit');
                Route::put('/edit', 'Admin\RoleController@update');
                Route::delete('/', 'Admin\RoleController@destroy');
            });
        });
    });
    Route::group(['prefix' => '', 'middleware' => ['role:user']], function () {
        Route::get('/', 'User\HomeController@index');
    });
});
