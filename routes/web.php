<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FavouriteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Admin;
use App\Models\Order;

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
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/home', [HomeController::class, 'redirect'])->name('home');
    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products/{product}/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('/products/{product}/update', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}/delete', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::post('/favourites/{product_id}/store',[FavouriteController::class, 'store'])->name('favourites.store');
    Route::get('/favourites',[FavouriteController::class, 'index'])->name('favourites.index');
    Route::post('/favourites',[FavouriteController::class, 'indexApi'])->name('favourites.api');
    Route::get('/cart',[FavouriteController::class, 'index'])->name('cart.index');
    Route::post('/cart/{product_variance_id}/store',[CartController::class, 'store'])->name('cart.store');
    Route::post('/cart/check',[CartController::class, 'is_in_cart'])->name('cart.check');
    // user views
    Route::get('/user/bill',function(){
        return view('user.bill');
    })->name('user.bill');
    Route::get('/user/bayment',function(){
        return view('user.bayment');
    })->name('user.bayment');
    Route::get('/user/shipping',function(){
        return view('user.shipping');
    })->name('user.shipping');
    Route::get('/user/success',function(){
        return view('user.success');
    })->name('user.success');
    Route::get('/user/invoice',function(){
        return view('user.invoice');
    })->name('user.invoice'); 
    Route::get('/user/payment',function(){
        return view('user.payment');
    })->name('user.payment');
    Route::get('/user/order',[OrderController::class, 'show'])->name('order.show');
    
    Route::get('/user/invoice/{id}/pdf',[Order::class,'print_invoice'])->name('user.invoice.pdf');
    
  
    //Route::get('/cart/{product_variance_id}/delete',[CartController::class, 'destroy'])->name('cart.destroy');
    // Route::post('/cart/{product_variance_id}/update',[CartController::class, 'update'])->name('cart.update');
    // Route::get('/cart/{product_variance_id}/delete',[CartController::class, 'destroy'])->name('cart.destroy');
    // Route::get('/cart/{product_variance_id}/checkout',[CartController::class, 'checkout'])->name('cart.checkout');
    // Route::get('/cart/{product_variance_id}/checkout/{user_id}',[CartController::class, 'checkout'])->name('cart.checkout');
    // if (Auth::user()->usertype == '1') {
    //     Route::get('/admin', [HomeController::class, 'admin'])->name('admin');
       
    // }
    // add middleware to protect admin routes
    

  
});

Route::middleware(Admin::class, 
    config('jetstream.auth_session'),
    'verified')->group(function () {
        // Route::get('/admin', [HomeController::class, 'admin'])->name('admin');
        Route::get('/admin/products', [ProductController::class, 'admin_index'])->name('admin.products');
        // Route::get('/admin/products/{product}/edit', [ProductController::class, 'adminEdit'])->name('admin.products.edit');
        // Route::post('/admin/products/{product}/update', [ProductController::class, 'adminUpdate'])->name('admin.products.update');
        
    });


//Route::get('/mypage',[HomeController::class,'redirect'])->middleware('auth','verified');
// Route::get('/redirect',function(){
//     return redirect('/dashboard');
// })->middleware('auth','verified');

//  Route::get('/profile',function(){
//      return view('/profile/show');
//  })->middleware('auth','verified')->name('profile');

// Auth::user()->usertype == true ? 'admin' : 'web'