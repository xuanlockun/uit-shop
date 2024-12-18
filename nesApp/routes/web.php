<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BillsController;
use App\Http\Controllers\ReceiverController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

// Route::get('/', function () {return view('welcome');})->name('home');

Route::get('/about',[PagesController::class,'about'])->name('about');
Route::get('/products',action: [ProductsController::class,'index'])->name('products');
Route::post('/products',[ProductsController::class,'store']);
Route::get('/products/{id}',[ProductsController::class,'detail'])->name('products.detail');
Route::get('/',action: [ProductsController::class,'chill'])->name('home');

Route::post('/cart/update', [BillsController::class, 'updateQuantity']);

Route::post('/products/{product}/add-to-cart', [CartController::class, 'add'])->name('cart.add');
Route::get('/products/{product}', [ProductsController::class, 'detail'])->name('products.show');
Route::get('/orders/{receiverID}', [ReceiverController::class, 'destroy'])->name('receiver.destroy');
Route::post('/receiver', [ReceiverController::class, 'store'])->name('receiver.store');
Route::get('/bills/{billID}',[BillsController::class,'detail'])->name('bill.detail');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::group(['middleware' => 'auth'], function () {
    Route::post('/cart/checkout', [OrderController::class,'store'])->name('cart.checkout'); 
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/dashboard/a', [CustomerController::class, 'store'])->name('customer.store');
    Route::put('/customer/update', [CustomerController::class, 'update'])->name('customer.update');
    Route::post('/cart/{product}', [CartController::class, 'store'])->name('cart.store');
    Route::put('/cart/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::get('/cart/{cartId}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::get('/dashboard', [CustomerController::class, 'index'])->name('dashboard');
});
Route::post('/apply-coupon', [CouponController::class, 'apply'])->name('apply.coupon');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

});


Route::get('/clear', function () {
    session()->flush();
    return 'Session cleared!';
});

Route::post('/cat', [BillsController::class, 'cat'])->name('orders.cat');

Route::post('/purchase', [OrderController::class,'update'])->name('purchase');

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/users', [AdminController::class,'user'])->name('admin.users');
Route::get('/admin/coupons', [AdminController::class,'coupon'])->name('admin.coupons');
Route::post('/admin/coupons', [CouponController::class,'store'])->name('coupons.store');
Route::put('/coupons/{id}', [CouponController::class,'update'])->name('coupons.update');
Route::delete('/coupons/{id}', [CouponController::class,'destroy'])->name('coupons.destroy');
Route::get('/admin/orders', [AdminController::class,'order'])->name('admin.orders');
Route::post('/admin/orders', [CouponController::class,'store'])->name('orders.store');
Route::put('/orders/{id}', [OrderController::class,'update'])->name('orders.update');
Route::delete('/orders/{id}', [CouponController::class,'destroy'])->name('orders.destroy');
Route::post('/admin/bills', [CouponController::class,'store'])->name('bills.store');
Route::put('/bills/{id}', [CouponController::class,'update'])->name('bills.update');
Route::delete('/bills/{id}', [CouponController::class,'destroy'])->name('bills.destroy');




// Route::post('/admin', [ProductsController::class,'store'])->name('products.store');
// Route::put('/admin', [ProductsController::class,'update'])->name('products.update');
// Route::delete('/admin', [ProductsController::class, 'destroy'])->name('products.destroy');
Route::put('/pending/{id}', [OrderController::class,'pending'])->name('orders.pending');

Route::get('/coupon/{code}', [CouponController::class, 'getCoupon']);
Route::get('/coupon-view', function () {
    return view('coup');
});

Route::get('/uit', [ProductsController::class,'admin_index'])->name('uit');
Route::get('/posts', [PostController::class, 'index'])->name('blog');
Route::get('/posts/{id}', [PostController::class, 'detail'])->name('blog.detail');
Route::get('/test2',[BillsController::class,'test2'])->name('test2');

require __DIR__.'/auth.php';
