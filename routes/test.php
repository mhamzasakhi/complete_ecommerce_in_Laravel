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

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Madnest\Madzipper\Facades\Madzipper;

Route::get('mail-test', function () {
    foreach (['taylor@example.com', 'dries@example.com'] as $recipient) {
        Mail::to($recipient)->send(new \App\Mail\OrderPlaced('hi'));
    }
});

Route::get('product-test', function () {
    return \App\CPU\ProductManager::get_latest_products(1, 1);
});

Route::get('category-products-test/{id}', function ($id) {
    return \App\CPU\CategoryManager::products($id);
});


Route::get('test-api', function () {
    $api = 'https://api.envato.com/v3/market/author/sale?code=37cdb6d7-6075-4037-8457-f23ff0008c91';
    $client = new \GuzzleHttp\Client(['base_uri' => $api]);
    $headers = ['Authorization' => 'Bearer ' . base64_decode('TlloaG1TME1lZHoxbWpjTUE1c1cwWEF3YWg1Q3B2SGg='), 'Accept' => 'application/json',];
    $response = $client->request('GET', '', ['headers' => $headers]);
    $result = json_decode((string)$response->getBody(), true);
    return $result;
});


Route::get('zip-extract', function () {
    Madzipper::make('test-zip.zip')->extractTo('public');
});

Route::get('/view-test',function (){
    view('welcome');
});
