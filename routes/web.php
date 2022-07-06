<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\ProductVarianceController;
use App\Http\Controllers\ShippingAddressController;
use App\Http\Controllers\UserController;
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
    Route::get('/products/show', [ProductController::class, 'show_user'])->name('products.show');
    Route::middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified'
    ])->group(function () {
    Route::get('/home', [HomeController::class, 'redirect'])->name('home');
    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');

    Route::post('/favourites/{product_id}/store',[FavouriteController::class, 'store'])->name('favourites.store');
    Route::get('/favourites',[FavouriteController::class, 'index'])->name('favourites.index');
    Route::post('/favourites',[FavouriteController::class, 'indexApi'])->name('favourites.api');
    Route::get('/cart',[CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/delete', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::delete('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('/cart/store',[CartController::class, 'store'])->name('carts.store');
    Route::post('/cart/check',[CartController::class, 'is_in_cart'])->name('cart.check');
    Route::post('/variances/size',[ProductVarianceController::class, 'getSize'])->name('variances.size');
    // user views
    Route::get('/user/bill',function(){
        return view('user.bill');
    })->name('user.bill');
    Route::get('/user/bayment',function(){
        return view('user.bayment');
    })->name('user.bayment');
    Route::get('/user/shipping',[ShippingAddressController::class,'create'])->name('shipping.create');
    Route::get('/user/shipping/store',[ShippingAddressController::class,'store'])->name('shipping.store');
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
    

  
});

Route::middleware(Admin::class, 
    config('jetstream.auth_session'),
    'verified')->group(function () {

        Route::get('/admin/products/index', [ProductController::class, 'admin_index'])->name('products.indexAdmin');
        
        Route::get('/admin/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/admin/products/store', [ProductController::class, 'store'])->name('products.store');
        Route::get('/admin/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::post('/admin/products/update', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/admin/products/{product}/delete', [ProductController::class, 'destroy'])->name('products.destroy');
        Route::get('/admin/products/show', [ProductController::class, 'show'])->name('products.showAdmin');

        Route::get('/admin/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/admin/categories/api', [CategoryController::class, 'indexJson'])->name('categories.api');
        Route::get('/admin/categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/admin/categories/store', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/admin/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::post('/admin/categories/update', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/admin/categories/{category}/delete', [CategoryController::class, 'destroy'])->name('categories.destroy');
        Route::get('/admin/categories/show', [CategoryController::class, 'show'])->name('categories.show');
        
        
        Route::get('/admin/subcategories/addProduct', [SubcategoryController::class, 'addProduct'])->name('subcategories.addProduct');
        Route::get('/admin/subcategories/link', [SubcategoryController::class, 'link'])->name('subcategories.link');
        Route::get('/admin/subcategories/show', [SubcategoryController::class, 'show'])->name('subcategories.show');
        Route::get('/admin/subcategories', [SubcategoryController::class, 'index'])->name('subcategories.index');
        Route::get('/admin/subcategories/create', [SubcategoryController::class, 'create'])->name('subcategories.create');
        Route::post('/admin/subcategories/store', [SubcategoryController::class, 'store'])->name('subcategories.store');
        Route::get('/admin/subcategories/{subcategory}/edit', [SubcategoryController::class, 'edit'])->name('subcategories.edit');
        Route::post('/admin/subcategories/update', [SubcategoryController::class, 'update'])->name('subcategories.update');
        Route::delete('/admin/subcategories/{subcategory}/delete', [SubcategoryController::class, 'destroy'])->name('subcategories.destroy');
        Route::get('/admin/subcategories/api', [SubcategoryController::class, 'indexJson'])->name('subcategories.api');

 

        

        Route::post('/admin/media/store', [ProductController::class, 'mediaStore'])->name('media.store');
        Route::delete('/admin/media/{}/delete', [ProductController::class, 'mediaDestroy'])->name('media.destroy');

        Route::get('/admin/users/show', [UserController::class, 'show'])->name('users.show');
        Route::get('/admin/users/index', [UserController::class, 'index'])->name('users.index');
        
    });


