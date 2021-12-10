<?php
// Prefix: /api/auth
Route::group([
//    'namespace'=>'auth',
//    'middleware' => 'api',
//    'domain'=>'api.poputka.in.ua',
    'prefix' => 'v1_0',

], function () {


//    Route::get('/books', [
//            'uses' => "BookController@get",
////            'is' => 'client|driver'
//        ]
//    )->middleware(['api','filter-middleware']);
    Route::post('/driver/login', [
            'uses' => "AuthController@login",
//            'is' => 'client|driver'
        ]
    )->middleware(['api']);
//

    Route::get('/driver/get', [
            'uses' => "AuthController@getDriver",
//            'is' => 'client|driver'
        ]
    )->middleware(['api', 'auth:driver-api']);

    Route::get('/driver/direction', [
            'uses' => "MapController@direction",
//            'is' => 'client|driver'
        ]
    )->middleware(['api', 'auth:driver-api']);

    Route::post('/driver/client-living-notification', [
            'uses' => "DriverController@settings",
//            'is' => 'client|driver'
        ]
    )->middleware(['api', 'auth:driver-api']);

    Route::get('/driver/ping', [
            'uses' => "DriverController@ping",
//            'is' => 'client|driver'
        ]
    )->middleware(['api', 'auth:driver-api']);

    Route::patch('/driver/setDefaultCar', [
            'uses' => "DriverController@setDefaultCar",
//            'is' => 'client|driver'
        ]
    )->middleware(['api', 'auth:driver-api']);

    Route::get('/driver/notification', [
            'uses' => "DriverController@notification",
//            'is' => 'client|driver'
        ]
    )->middleware(['api', 'auth:driver-api']);

    Route::patch('/driver/setNavigation', [
            'uses' => "DriverController@setNavigation",
//            'is' => 'client|driver'
        ]
    )->middleware(['api', 'auth:driver-api']);

    Route::put('/driver/nearHole', [
            'uses' => "DriverController@nearHole",
//            'is' => 'client|driver'
        ]
    )->middleware(['api', 'auth:driver-api']);

    Route::put('/driver/driverStartTrip', [
            'uses' => "DriverController@driverStartTrip",
//            'is' => 'client|driver'
        ]
    )->middleware(['api', 'auth:driver-api']);



//    Route::post('/login/validate-code', [
//            'uses' => "AuthController@validateCode",
////            'is' => 'client|driver'
//        ]
//    )->middleware(['api']);
//
//    Route::patch('/user/profile', [
//            'uses' => "UserController@updateProfile",
////            'is' => 'client|driver'
//        ]
//    )->middleware(['api','auth:api']);
//
//    Route::patch('/user/phone', [
//            'uses' => "UserController@updatePhone",
////            'is' => 'client|driver'
//        ]
//    )->middleware(['api','auth:api']);
//
//    Route::patch('/user/email', [
//            'uses' => "UserController@updateEmail",
////            'is' => 'client|driver'
//        ]
//    )->middleware(['api','auth:api']);
//
//    Route::get('/user/email/verified/{token}', [
//            'uses' => "UserController@validateEmail",
////            'is' => 'client|driver'
//        ]
//    )->middleware(['api']);


//    Route::get('/books/search', [
//            'uses' => "SearchController@search",
////            'is' => 'client|driver'
//        ]
//    )->middleware(['api']);


});
