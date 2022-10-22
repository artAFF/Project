<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;

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

Route::get('/', function () 
{
    return view('welcome');
});

Route::controller(RestaurantController::class)->group(function() 
{
    //create
    Route::get('/restaurant/create', 'createForm')->name('restaurant-create-form');
    Route::post('/restaurant/create', 'create')->name('restaurant-create');
    //list
    Route::get('/restaurant', 'list')->name('restaurant-list');
    Route::get('/restaurant/{restaurant}', 'show')->name('restaurant-view');
    //
    Route::get('/product/{product}/update','updateForm')->name('product-update-form');
    Route::post('/product/{product}/update','update')->name('product-update');
    Route::get('/product/{product}/delete','delete')->name('product-delete');

    Route::get('/product/{product}/shop','showShop',)->name('product-view-shop');

    Route::get('/product/{product}/shop/add', 'addShopForm')->name('product-add-shop-form');
    Route::post('/product/{product}/shop/add', 'addShop')->name('product-add-shop');

    Route::get('/product/{product}/shop/{shop}/remove', 'removeShop')->name('product-remove-shop');
});
