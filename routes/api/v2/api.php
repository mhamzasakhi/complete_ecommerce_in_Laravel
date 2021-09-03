<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'api\v2', 'prefix' => 'v2','middleware' => ['api_lang']], function () {
    Route::group(['prefix' => 'seller', 'namespace' => 'seller'], function () {

        Route::get('seller-info', 'SellerController@seller_info');
        Route::put('seller-update', 'SellerController@seller_info_update');
        Route::get('monthly-earning', 'SellerController@monthly_earning');

        Route::get('shop-info', 'SellerController@shop_info');
        Route::get('transactions', 'SellerController@transaction');
        Route::put('shop-update', 'SellerController@shop_info_update');

        Route::post('balance-withdraw', 'SellerController@withdraw_request');
        Route::delete('close-withdraw-request', 'SellerController@close_withdraw_request');

        Route::group(['prefix' => 'products'], function () {
            Route::get('list', 'ProductController@list');
        });

        Route::group(['prefix' => 'orders'], function () {
            Route::get('list', 'OrderController@list');
            Route::get('/{id}', 'OrderController@details');
            Route::put('order-detail-status/{id}','OrderController@order_detail_status');
        });

        Route::group(['prefix' => 'messages'], function () {
            Route::get('list', 'ChatController@messages');
            Route::post('send', 'ChatController@send_message');
        });

        Route::group(['prefix' => 'auth', 'namespace' => 'auth'], function () {
            Route::post('login', 'LoginController@login');
        });

        Route::group(['prefix' => 'config'], function () {
            Route::get('/', 'ConfigController@configuration');
        });
    });
    Route::post('ls-lib-update', 'LsLibController@lib_update');
});
