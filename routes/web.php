<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FavouriteController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [HomeController::class, 'home'])->name('welcome');
Route::get('/products',[ProductController::class, 'index'])->name('products.index');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/home', [HomeController::class, 'redirect'])->name('home');
    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products/{product}/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('/products/{product}/update', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}/delete', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::post('/favourites/{product_id}/store',[FavouriteController::class, 'store'])->name('favourites.store');
    Route::get('/favourites',[FavouriteController::class, 'index'])->name('favourites.index');
    Route::post('/favourites',[FavouriteController::class, 'indexApi'])->name('favourites.api');

});

//Route::get('/mypage',[HomeController::class,'redirect'])->middleware('auth','verified');
// Route::get('/redirect',function(){
//     return redirect('/dashboard');
// })->middleware('auth','verified');

//  Route::get('/profile',function(){
//      return view('/profile/show');
//  })->middleware('auth','verified')->name('profile');

// Auth::user()->usertype == true ? 'admin' : 'web'