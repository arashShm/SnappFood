<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController ;
use App\Http\Controllers\ProductController ;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


//dashboard Routes

Route::resource('shop', ShopController::class)->except('show');
Route::resource('product', ProductController::class);
Route::resource('order' , OrderController::class)->only(['index' , 'show','destroy']) ;
Route::post('/product/{product}/restore',[\App\Http\Controllers\ProductController::class,'restore'])->name('product.restore');
Route::post('/shop/{shop}/restore' ,[\App\Http\Controllers\ShopController::class , 'restore'])->name('shop.restore');
Route::post('order/status/{cart_item}' , [\App\Http\Controllers\OrderController::class , 'changeStatus'])->name('order.status');



//public Routes
Route::get('/public' , [\App\Http\Controllers\PublicController::class , 'public'])->name('public');
Route::get('public/products' , [\App\Http\Controllers\PublicController::class , 'products'])->name('public.products');
Route::get('public/product/{product}' , [\App\Http\Controllers\PublicController::class , 'singleProduct'])->name('public.product');
Route::get('public/shops' , [\App\Http\Controllers\PublicController::class , 'shops'])->name('public.shops');
Route::get('public/carts' , [\App\Http\Controllers\PublicController::class , 'carts'] )->name('public.carts');
Route::get('public/shops/{shop}' ,[\App\Http\Controllers\PublicController::class , 'showShop'])->name('shop.show');
Route::get('public/shop/info/{shop}' , [\App\Http\Controllers\PublicController::class , 'showShopInfo'])->name('shop.info');
Route::get('public/shop/products/{shop}' , [\App\Http\Controllers\PublicController::class , 'showShopProduct'])->name('shop.product');

//cart Routes
Route::post('cart/manage/{product}' , [\App\Http\Controllers\CartController::class, 'manage'])->name('cart.manage');
Route::post('cart/pay' , [\App\Http\Controllers\CartController::class, 'pay'] )->name('cart.pay');
Route::delete('cart/{cart_item}' , [\App\Http\Controllers\CartController::class, 'destroy'])->name('cart.destroy');

//comment
Route::post('comment' , [\App\Http\Controllers\CommentController::class , 'store'])->name('comment.store');


