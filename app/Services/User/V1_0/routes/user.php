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
    Route::post('/login', [
            'uses' => "AuthController@login",
//            'is' => 'client|driver'
        ]
    )->middleware(['api']);
//
    Route::post('/login/validate-pin', [
            'uses' => "AuthController@validatePin",
//            'is' => 'client|driver'
        ]
    )->middleware(['api']);

    Route::put('/user/profile', [
            'uses' => "UserController@updateProfile",
//            'is' => 'client|driver'
        ]
    )->middleware(['api','auth:api']);

    Route::patch('/user/phone', [
            'uses' => "UserController@updatePhone",
//            'is' => 'client|driver'
        ]
    )->middleware(['api','auth:api']);

    Route::patch('/user/email', [
            'uses' => "UserController@updateEmail",
//            'is' => 'client|driver'
        ]
    )->middleware(['api','auth:api']);

    Route::get('/user/email/verified/{token}', [
            'uses' => "UserController@validateEmail",
//            'is' => 'client|driver'
        ]
    )->middleware(['api']);


    Route::post('/user/user_location_search', [
            'uses' => "UserController@addUserLocationSearch",
//            'is' => 'client|driver'
        ]
    )->middleware(['api','auth:api']);


    Route::put('/user/avatar', [
            'uses' => "UserController@updateAvatar",
//            'is' => 'client|driver'
        ]
    )->middleware(['api','auth:api']);

    Route::get('/user', [
            'uses' => "UserController@get",
//            'is' => 'client|driver'
        ]
    )->middleware(['api','auth:api']);

//    Route::get('/user/settings', [
//            'uses' => "UserController@settings",
////            'is' => 'client|driver'
//        ]
//    )->middleware(['api','optionalAuth:api']);
//
//
    Route::get('/user/settings', [
            'uses' => "SettingController@index",
//            'is' => 'client|driver'
        ]
    )->middleware(['api']);





//    Route::get('/books/search', [
//            'uses' => "SearchController@search",
////            'is' => 'client|driver'
//        ]
//    )->middleware(['api']);



});
