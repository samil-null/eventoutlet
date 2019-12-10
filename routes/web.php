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
        //Route::get('/offers/')
    });

});



//**

Route::group(['prefix' => 'app', 'namespace' => 'Api\App'], function() {
    Route::resource('/profiles', 'ProfileController');
    Route::resource('/offers', 'OfferController');
    Route::resource('/services', 'ServiceController');

});
