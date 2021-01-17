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
    Route::get('/register', 'RegisterController@registerForm');
    Route::post('/register', 'RegisterController@registerProcess');
});
Route::get('/logout', 'LoginController@logout');

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function () {
        Route::get('/', 'HomeController@index');
        Route::group(['prefix' => 'user'], function () {
            Route::get('/', 'UserController@index');
            Route::get('/add', 'UserController@create');
            Route::post('/add', 'UserController@store');
            Route::group(['prefix' => '{user_id}'], function () {
                Route::get('/', 'UserController@show');
                Route::get('/edit', 'UserController@edit');
                Route::put('/edit', 'UserController@update');
                Route::delete('/', 'UserController@destroy');
            });
        });

        Route::group(['prefix' => 'role'], function () {
            Route::get('/', 'RoleController@index');
            Route::get('/add', 'RoleController@create');
            Route::post('/add', 'RoleController@store');
            Route::group(['prefix' => '{role_id}'], function () {
                Route::get('/', 'RoleController@show');
                Route::get('/edit', 'RoleController@edit');
                Route::put('/edit', 'RoleController@update');
                Route::delete('/', 'RoleController@destroy');
            });
        });

        Route::group(['prefix' => 'job'], function () {
            Route::get('/', 'JobController@index');
            Route::delete('/', 'JobController@multi_destroy');
            Route::get('/add', 'JobController@create');
            Route::post('/add', 'JobController@store');
            Route::group(['prefix' => '{job_id}'], function () {
                Route::get('/', 'JobController@show');
                Route::get('/edit', 'JobController@edit');
                Route::put('/edit', 'JobController@update');
                Route::delete('/', 'JobController@destroy');
            });
        });

        Route::group(['prefix' => 'company'], function () {
            Route::get('/', 'CompanyController@index');
            Route::delete('/', 'CompanyController@multi_destroy');
            Route::get('/add', 'CompanyController@create');
            Route::post('/add', 'CompanyController@store');
            Route::group(['prefix' => '{company_id}'], function () {
                Route::get('/', 'CompanyController@show');
                Route::get('/edit', 'CompanyController@edit');
                Route::put('/edit', 'CompanyController@update');
                Route::delete('/', 'CompanyController@destroy');
            });
        });
    });
    Route::group(['prefix' => '', 'middleware' => ['role:user']], function () {
        Route::get('/', 'HomeController@index');


        Route::group(['prefix' => 'job'], function () {
            Route::get('/', 'JobController@index');
            Route::group(['prefix' => '{job_id}'], function () {
                Route::get('/', 'JobController@show');
            });
        });

        Route::group(['prefix' => 'company'], function () {
            Route::get('/', 'CompanyController@index');
            Route::group(['prefix' => '{company_id}'], function () {
                Route::get('/', 'CompanyController@show');
            });
        });
    });
});
