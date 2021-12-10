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
    Route::get('/order/option', [
            'uses' => "OrderController@option",
//            'is' => 'client|driver'
        ]
    )->middleware(['api']);
    Route::post('/order', [
            'uses' => "OrderController@create",
//            'is' => 'client|driver'
        ]
    )->middleware(['api', 'auth:api']);

    Route::patch('/order/accept', [
            'uses' => "OrderController@accept",
//            'is' => 'client|driver'
        ]
    )->middleware(['api', 'auth:api', 'auth:driver-api']);
//


    Route::get('/order/get-user-orders', [
            'uses' => "OrderController@getUserOrders",
//            'is' => 'client|driver'
        ]
    )->middleware(['api', 'auth:api']);

    Route::delete('/order/cancel-before-find-driver', [
            'uses' => "OrderController@cancelBeforeFindDriver",
//            'is' => 'client|driver'
        ]
    )->middleware(['api', 'auth:api']);


//    'auth:api'

});
