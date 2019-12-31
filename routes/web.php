<?php

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

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
    Route::post('/register', 'RegisterController@index')->name('register');
    Route::post('/login', 'LoginController@index')->name('login');
    Route::get('/logout', 'LogoutController@index')->name('logout');
});

Route::group(['namespace' => 'Site'], function () {

    Route::get('/', 'HomeController@index')->name('site.home');
    Route::group(['middleware' => ['role:executor'], 'prefix' => 'lk', 'namespace' => 'Lk' ], function() {

        Route::resource('/profiles', 'ProfileController')->names([
            'show' => 'site.lk.profiles.show',
            'edit' => 'site.lk.profiles.edit'
        ]);
        Route::resource('/offers', 'OfferController')->names([
            'create' => 'site.lk.offers.create',
            'store' => 'site.lk.offers.store'
        ]);


    });

    Route::get('/offers', 'OfferController@index')->name('site.offers');
    Route::get('/users/{id}', 'UserController@show')->name('site.users.show');

});



//**

Route::group(['prefix' => 'app', 'namespace' => 'Api\App'], function() {
    Route::resource('/profiles', 'ProfileController');
    Route::resource('/offers', 'OfferController');
    Route::resource('/services', 'ServiceController');
    Route::resource('/specialties', 'SpecialityController');

    //Route::get('/media', 'MediaController@avatar');

    Route::group(['prefix' => 'media'], function () {
        Route::post('/avatar', 'MediaController@avatar');
        Route::post('/gallery','MediaController@gallery');
    });
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/', 'DashboardController@index')->name('admin.dashboard');
    Route::resource('/users', 'UserController')->names([
        'index' => 'admin.users.index',
        'show' => 'admin.users.show',
        'edit' => 'admin.users.edit'
    ]);

    Route::resource('/specialties', 'SpecialityController')->names([
        'index' => 'admin.specialties.index',
        'show' =>   'admin.specialties.show'
    ]);

    Route::resource('/cities', 'CityController')->names([
        'index' => 'admin.cities.index',
        'show'  => 'admin.cities.show'
    ]);

});
