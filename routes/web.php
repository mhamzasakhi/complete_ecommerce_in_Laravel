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

use Illuminate\Support\Facades\Route;

//for maintenance mode
Route::get('maintenance-mode', 'Web\WebController@maintenance_mode')->name('maintenance-mode');

Route::group(['namespace' => 'Web','middleware'=>['maintenance_mode']], function () {
    Route::get('/', 'WebController@home')->name('home');
    Route::get('quick-view', 'WebController@quick_view')->name('quick-view');
    Route::get('searched-products', 'WebController@searched_products')->name('searched-products');
    Route::get('checkout-details', 'WebController@checkout_details')->name('checkout-details');
    Route::get('checkout-shipping', 'WebController@checkout_shipping')->name('checkout-shipping')->middleware('customer');
    Route::get('checkout-payment', 'WebController@checkout_payment')->name('checkout-payment')->middleware('customer');
    Route::get('checkout-review', 'WebController@checkout_review')->name('checkout-review')->middleware('customer');
    Route::get('checkout-complete', 'WebController@checkout_complete')->name('checkout-complete')->middleware('customer');
    Route::get('shop-cart', 'WebController@shop_cart')->name('shop-cart');
    Route::get('search-shop', 'WebController@search_shop')->name('search-shop');

    Route::get('categories', 'WebController@all_categories')->name('categories');
    Route::get('category-ajax/{id}', 'WebController@categories_by_category')->name('category-ajax');

    Route::get('brands', 'WebController@all_brands')->name('brands');
    Route::get('sellers', 'WebController@all_sellers')->name('sellers');
    Route::get('seller-profile/{id}', 'WebController@seller_profile')->name('seller-profile');

    Route::get('flash-deals/{id}', 'WebController@flash_deals')->name('flash-deals');
    Route::get('terms', 'WebController@termsandCondition')->name('terms');
    Route::get('privacy-policy', 'WebController@privacy_policy')->name('privacy-policy');

    Route::get('/product/{slug}', 'WebController@product')->name('product');
    Route::get('products', 'WebController@products')->name('products');
    Route::get('orderDetails', 'WebController@orderdetails')->name('orderdetails');

    //Chat with seller from product details
    Route::get('chat-for-product', 'WebController@chat_for_product')->name('chat-for-product');

    Route::get('wishlists', 'WebController@viewWishlist')->name('wishlists')->middleware('customer');
    Route::post('store-wishlist', 'WebController@storeWishlist')->name('store-wishlist');
    Route::post('delete-wishlist', 'WebController@deleteWishlist')->name('delete-wishlist');

    Route::post('/currency', 'CurrencyController@changeCurrency')->name('currency.change');

    Route::get('about-us', 'WebController@about_us')->name('about-us');

    //profile Route
    Route::get('user-account', 'UserProfileController@user_account')->name('user-account');
    Route::post('user-account-update', 'UserProfileController@user_update')->name('user-update');
    Route::post('user-account-picture', 'UserProfileController@user_picture')->name('user-picture');
    Route::get('account-address', 'UserProfileController@account_address')->name('account-address');
    Route::post('account-address-store', 'UserProfileController@address_store')->name('address-store');
    Route::get('account-address-delete', 'UserProfileController@address_delete')->name('address-delete');
    Route::post('account-address-update', 'UserProfileController@address_update')->name('address-update');
    Route::get('account-payment', 'UserProfileController@account_payment')->name('account-payment');
    Route::get('account-oder', 'UserProfileController@account_oder')->name('account-oder');
    Route::get('account-order-details', 'UserProfileController@account_order_details')->name('account-order-details');
    Route::get('generate-invoice/{id}', 'UserProfileController@generate_invoice')->name('generate-invoice');
    Route::get('account-wishlist', 'UserProfileController@account_wishlist')->name('account-wishlist'); //add to card not work

    Route::get('account-tickets', 'UserProfileController@account_tickets')->name('account-tickets');
    Route::get('order-cancel/{id}', 'UserProfileController@order_cancel')->name('order-cancel');
    Route::post('ticket-submit', 'UserProfileController@ticket_submit')->name('ticket-submit');

    // Chatting start
    Route::get('chat-with-seller', 'ChattingController@chat_with_seller')->name('chat-with-seller');
    Route::get('messages', 'ChattingController@messages')->name('messages');
    Route::post('messages-store', 'ChattingController@messages_store')->name('messages_store');
    // chatting end
    //Support Ticket
    Route::group(['prefix' => 'support-ticket', 'as' => 'support-ticket.'], function () {
        Route::get('{id}', 'UserProfileController@single_ticket')->name('index');
        Route::post('{id}', 'UserProfileController@comment_submit')->name('comment');
        Route::get('delete/{id}', 'UserProfileController@support_ticket_delete')->name('delete');
        Route::get('close/{id}', 'UserProfileController@support_ticket_close')->name('close');
    });

    Route::get('account-transaction', 'UserProfileController@account_transaction')->name('account-transaction');
    Route::get('account-wallet-history', 'UserProfileController@account_wallet_history')->name('account-wallet-history');

    Route::post('review', 'ReviewController@store')->name('review.store');

    Route::group(['prefix' => 'track-order', 'as' => 'track-order.'], function () {
        Route::get('', 'UserProfileController@track_order')->name('index');
        Route::get('result-view', 'UserProfileController@track_order_result')->name('result-view');
        Route::get('last', 'UserProfileController@track_last_order')->name('last');
        Route::post('result', 'UserProfileController@track_order_result')->name('result');
    });
    //FAQ route
    Route::get('helpTopic', 'WebController@helpTopic')->name('helpTopic');
    //Contacts
    Route::get('contacts', 'WebController@contacts')->name('contacts');

    //sellerShop
    Route::get('shopView/{id}', 'WebController@seller_shop')->name('shopView');
    Route::post('shopView/{id}', 'WebController@seller_shop_product');

    //top Rated
    Route::get('top-rated', 'WebController@top_rated')->name('topRated');
    Route::get('best-sell', 'WebController@best_sell')->name('bestSell');
    Route::get('new-product', 'WebController@new_product')->name('newProduct');

//for test
    /*Route::get('order', 'WebController@testOrder')->name('order'); //done
    Route::get('orderList', 'WebController@testOrderList')->name('orderList'); //done/todo
    Route::get('profile', 'WebController@testProfile')->name('profile'); //done
    Route::get('supportTicket', 'WebController@testSupport')->name('support-ticket'); //done
    Route::get('wishList', 'WebController@testWish')->name('wishList'); //done/todo
    Route::get('chatTest', 'WebController@testChat')->name('chatTest'); // done
    Route::get('addressTest', 'WebController@testAddress')->name('address'); // done (header Problem)
    Route::get('addressView', 'WebController@testAddressView')->name('addressView'); //done
    Route::get('purchase', 'WebController@testpurchase')->name('purchase'); //done
    Route::get('supportChat', 'WebController@supportChat')->name('supportChat'); //done
    Route::get('orderDetails', 'WebController@orderdetails')->name('orderdetails'); //done/todo
    Route::get('error', 'WebController@error');*/
});

//Seller shop apply
Route::group(['prefix' => 'shop', 'as' => 'shop.', 'namespace' => 'Seller\Auth'], function () {
    Route::get('apply', 'RegisterController@create')->name('apply');
    Route::post('apply', 'RegisterController@store');

});

//check done

Route::group(['prefix' => 'cart', 'as' => 'cart.', 'namespace' => 'Web'], function () {
    Route::post('variant_price', 'CartController@variant_price')->name('variant_price');
    Route::post('add', 'CartController@addToCart')->name('add');
    Route::post('remove', 'CartController@removeFromCart')->name('remove');
    Route::post('nav-cart-items', 'CartController@updateNavCart')->name('nav_cart');
    Route::post('toolbar', 'CartController@updateToolbar')->name('toolbar');
    Route::post('updateQuantity', 'CartController@updateQuantity')->name('updateQuantity');
});

//Seller shop apply
Route::group(['prefix' => 'coupon', 'as' => 'coupon.', 'namespace' => 'Web'], function () {
    Route::post('apply', 'CouponController@apply')->name('apply');
});
//check done

// SSLCOMMERZ Start
/*Route::get('/example1', 'SslCommerzPaymentController@exampleEasyCheckout');
Route::get('/example2', 'SslCommerzPaymentController@exampleHostedCheckout');*/
Route::post('pay-ssl', 'SslCommerzPaymentController@index');
Route::post('pay-ssl-app', 'SslCommerzPaymentController@index_app');

Route::post('/success', 'SslCommerzPaymentController@success');
Route::post('/fail', 'SslCommerzPaymentController@fail');
Route::post('/cancel', 'SslCommerzPaymentController@cancel');
Route::post('/ipn', 'SslCommerzPaymentController@ipn');
//SSLCOMMERZ END

/*paypal*/
/*Route::get('/paypal', function (){return view('paypal-test');})->name('paypal');*/
Route::post('pay-paypal', 'PaypalPaymentController@payWithpaypal')->name('pay-paypal');
Route::post('pay-paypal-app', 'PaypalPaymentController@payWithpaypalApp')->name('pay-paypal-app');

Route::get('paypal-status', 'PaypalPaymentController@getPaymentStatus')->name('paypal-status');
Route::get('paypal-success', 'PaypalPaymentController@success')->name('paypal-success');
Route::get('paypal-fail', 'PaypalPaymentController@fail')->name('paypal-fail');
/*paypal*/

/*Route::get('stripe', function (){
return view('stripe-test');
});*/
Route::get('pay-stripe', 'StripePaymentController@payment_process_3d')->name('pay-stripe');
Route::get('pay-stripe/success', 'StripePaymentController@success')->name('pay-stripe.success');
Route::get('pay-stripe/fail', 'StripePaymentController@success')->name('pay-stripe.fail');

// Get Route For Show Payment Form
Route::get('paywithrazorpay', 'RazorPayController@payWithRazorpay')->name('paywithrazorpay');
Route::post('payment-razor', 'RazorPayController@payment')->name('payment-razor');
Route::post('payment-razor/payment2', 'RazorPayController@payment_mobile')->name('payment-razor.payment2');
Route::get('payment-razor/success', 'RazorPayController@success')->name('payment-razor.success');
Route::get('payment-razor/fail', 'RazorPayController@success')->name('payment-razor.fail');

Route::get('payment-success', 'Customer\PaymentController@success')->name('payment-success');
Route::get('payment-fail', 'Customer\PaymentController@fail')->name('payment-fail');


//senang pay
Route::match(['get', 'post'], '/return-senang-pay', 'SenangPayController@return_senang_pay')->name('return-senang-pay');

//paystack
Route::post('/paystack-pay', 'PaystackController@redirectToGateway')->name('paystack-pay');
Route::get('/paystack-callback', 'PaystackController@handleGatewayCallback')->name('paystack-callback');
Route::get('/paystack',function (){
    return view('paystack');
});
