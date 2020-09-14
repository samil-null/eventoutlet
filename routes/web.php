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
    Route::get('/forgot/{token}', 'ForgotController@remember')->name('remember');
    Route::post('/forgot/change', 'ForgotController@change');
    Route::post('/forgot', 'ForgotController@forgot')->name('forgot');
});

//Route::get('/blog');



//feedback
Route::post('/app/feedback', 'Api\App\FeedbackController@index');


/**
 * executor routes
 */

//http://127.0.0.1:8000/offers?city_id=2&speciality_id=2&specials_offers%5Bdate_from%5D=2020-03-17&specials_offers%5Bdate_to%5D=2020-03-31&discount%5Bfrom%5D=10&discount%5Bto%5D=70&per_page=10&specials_offers%5Bdate_from%5D=17-03-2020&specials_offers%5Bdate_to%5D=17-04-2020
Route::group(['prefix' => 'app', 'namespace' => 'Api\App', 'middleware' => ['role:executor']], function() {

    Route::resource('/users', 'UserController');

    Route::resource('/profiles', 'ProfileController');

    Route::resource('/offers', 'OfferController');
    Route::post('/offers/published', 'OfferController@published');

    Route::get('/services/count', 'ServiceController@count');
    Route::resource('/services', 'ServiceController');
    Route::resource('/specialties', 'SpecialityController');

    Route::group(['prefix' => 'media', 'namespace' => 'Media'], function () {
        Route::resource('/gallery','GalleryController')
            ->only(['index', 'store'])
            ->middleware('optimizeImages');
        Route::delete('/gallery', 'GalleryController@destroy');

        Route::resource('/videos', 'VideoController')
            ->only(['index', 'store']);
        Route::delete('/videos', 'VideoController@destroy');
        Route::get('/video/render','VideoController@render');

        Route::post('/avatar', 'AvatarController@store');
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

    Route::put('/services/change-status', 'ServiceController@changeStatuses')->name('admin.services.change_status');
    Route::resource('/services', 'ServiceController')->names([
        'index'     => 'admin.services.index',
        'show'      => 'admin.services.show',
        'edit'      =>  'admin.services.edit',
        'create'    => 'admin.services.create',
        'store'     => 'admin.services.store',
        'update'    => 'admin.services.update',
        'destroy'   => 'admin.services.destroy'
    ]);

    Route::put('/offers/change-status', 'OfferController@changeStatuses')->name('admin.offers.change_status');
    Route::resource('/offers', 'OfferController')->names([
        'index'     => 'admin.offers.index',
        'show'      => 'admin.offers.show',
        'create'    => 'admin.offers.create',
        'store'     => 'admin.offers.store',
        'update'    => 'admin.offers.update',
        'destroy'   => 'admin.offers.destroy'
    ]);

    Route::resource('/price-options', 'PriceOptionController')->names([
        'index'     => 'admin.priceOptions.index',
        'show'      => 'admin.priceOptions.show',
        'create'    => 'admin.priceOptions.create',
        'store'     => 'admin.priceOptions.store',
        'update'    => 'admin.priceOptions.update',
        'destroy'   => 'admin.priceOptions.destroy'
    ]);

    Route::resource('/roles', 'RoleController')->names([
        'index'     => 'admin.roles.index',
        'show'      => 'admin.roles.show',
        'create'    => 'admin.roles.create',
        'store'     => 'admin.roles.store',
        'update'    => 'admin.roles.update',
        'destroy'   => 'admin.roles.destroy'
    ]);


    Route::resource('/blog', 'BlogController')->names([
        'index'     => 'admin.blog.index',
        'show'      => 'admin.blog.show',
        'create'    => 'admin.blog.create',
        'store'     => 'admin.blog.store',
        'update'    => 'admin.blog.update',
        'destroy'   => 'admin.blog.destroy'
    ]);

    Route::resource('/settings', 'SettingsController')->only('index', 'store')->names([
        'index' => 'admin.settings.index',
        'store' => 'admin.settings.store',
    ]);
});

Route::group(['namespace' => 'Site'], function () {

    Route::get('/', 'HomeController@index')->name('site.home');

    Route::group(['middleware' => ['role:executor'], 'prefix' => 'lk', 'namespace' => 'Lk' ], function() {

        Route::get('/profile', 'ProfileController@show')->name('site.lk.profile.show');
        Route::get('/profile/edit', 'ProfileController@edit')->name('site.lk.profile.edit');

        Route::resource('/offers', 'OfferController')->names([
            'create' => 'site.lk.offers.create',
            'store' => 'site.lk.offers.store',
            'edit' => 'site.lk.offers.edit'
        ]);
    });

    Route::post('/subscriber', 'SubscriberController@subscribe')->name('site.subscribe');
    Route::get('/offers', 'OfferController@index')->name('site.offers.index');
    Route::get('/users/{id}', 'UserController@show')->name('site.users.show');

    Route::get('/about', 'PageController@about')->name('site.about');
    Route::get('/process', 'PageController@process')->name('site.process');

    Route::get('/{slug}', 'OfferController@category');

});


//Route::group(['prefix' => 'laraberg', 'middleware' => ['web', 'auth']], function() {
//    Route::apiResource('blocks', 'VanOns\Laraberg\Http\Controllers\BlockController');
//    //Route::get('oembed', 'VanOns\Laraberg\Http\Controllers\OEmbedController');
//});
//
//Route::group(['middleware' => ['web', 'auth']], function () {
//    \UniSharp\LaravelFilemanager\Lfm::routes();
//});
