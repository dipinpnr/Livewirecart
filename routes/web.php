<?php

use App\Models\admin\Mst_store_product;
use Illuminate\Support\Facades\Route;


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

Route::get('/', function () {
   
    return view('welcome');
});
Route::get('/test', function () {
   
    return "tested";
})->name('test');
Route::get('/view-cart', function () {
   
    return view('view-cart');
})->name('cart.view');

Route::get('/view-wishlist', function () {
   
    return view('view-wishlist');
})->name('wishlist.view');
