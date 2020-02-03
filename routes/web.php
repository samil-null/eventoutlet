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
    Route::get('/verification/{token}', 'VerificationController@verify')->name('verification');
    Route::post('/forgot', 'ForgotController@forgot')->name('forgot');
    Route::get('/forgot/{token}', 'ForgotController@remember')->name('remember');
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

    Route::get('/offers', 'OfferController@index')->name('site.offers.index');
    Route::get('/users/{id}', 'UserController@show')->name('site.users.show');

});



//**

Route::group(['prefix' => 'app', 'namespace' => 'Api\App', 'middleware' => ['role:executor']], function() {
    Route::resource('/profiles', 'ProfileController');
    Route::resource('/offers', 'OfferController');
    Route::resource('/services', 'ServiceController');
    Route::resource('/specialties', 'SpecialityController');

    Route::group(['prefix' => 'media'], function () {
        Route::post('/avatar', 'MediaController@avatar')->middleware('optimizeImages');
        Route::post('/gallery','MediaController@gallery')->middleware('optimizeImages');
        Route::delete('/gallery','MediaController@remove')->middleware('optimizeImages');
        Route::post('/video', 'MediaController@video');
        Route::get('/video/render','MediaController@render');
    });

    Route::group(['prefix' => 'filter'], function () {
        Route::post('/', 'FilterController@build');
    });
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['role:admin']], function () {
    Route::get('/', 'DashboardController@index')->name('admin.dashboard');
    Route::resource('/users', 'UserController')->names([
        'index'     => 'admin.users.index',
        'show'      =>   'admin.users.show',
        'create'    => 'admin.users.create',
        'store'     => 'admin.users.store',
        'update'    => 'admin.users.update',
        'destroy'   => 'admin.users.destroy'
    ]);

    Route::resource('/specialties', 'SpecialityController')->names([
        'index'     => 'admin.specialties.index',
        'show'      =>   'admin.specialties.show',
        'create'    => 'admin.specialties.create',
        'store'     => 'admin.specialties.store',
        'update'    => 'admin.specialties.update',
        'destroy'   => 'admin.specialties.destroy'
    ]);

    Route::resource('/cities', 'CityController')->names([
        'index'     => 'admin.cities.index',
        'show'      => 'admin.cities.show',
        'create'    => 'admin.cities.create',
        'store'     => 'admin.cities.store',
        'update'    => 'admin.cities.update',
        'destroy'   => 'admin.cities.destroy'
    ]);

    Route::resource('/services', 'ServiceController')->names([
        'index'     => 'admin.services.index',
        'show'      => 'admin.services.show',
        'edit'      =>  'admin.services.edit',
        'create'    => 'admin.services.create',
        'store'     => 'admin.services.store',
        'update'    => 'admin.services.update',
        'destroy'   => 'admin.services.destroy'
    ]);

    Route::resource('/offers', 'OfferController')->names([
        'index'     => 'admin.offers.index',
        'show'      => 'admin.offers.show',
        'create'    => 'admin.offers.create',
        'store'     => 'admin.offers.store',
        'update'    => 'admin.offers.update',
        'destroy'   => 'admin.offers.destroy'
    ]);

});
