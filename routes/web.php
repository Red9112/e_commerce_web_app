<?php

use App\Models\Comment;

use App\Mail\ProductCommentPosted;
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


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\DashboardController::class, 'dashboard'])->name('dashboard');
Route::get('/prodByCat/{id}', [App\Http\Controllers\DashboardController::class, 'prodByCat'])->name('prodByCat');
Route::resource('/category','App\Http\Controllers\CategoryController')->only(['index','store','edit','update','destroy']);
Route::resource('/role','App\Http\Controllers\RoleController')->only(['index','store','edit','update','destroy']);
Route::resource('/shop','App\Http\Controllers\shopController')->only(['index','create','store','edit','update','show','destroy']);
Route::resource('/product','App\Http\Controllers\productController')->only(['index','create','store','edit','update','show','destroy']);
Route::get('/pdf', [App\Http\Controllers\HomeController::class, 'pdf'])->name('pdf');
Route::get('/downloadPDF', [App\Http\Controllers\HomeController::class, 'downloadPDF'])->name('downloadPDF');
Route::post('/importCategory', [App\Http\Controllers\CategoryController::class, 'import'])->name('category.store.excel');
Route::get('/shopExportList', [App\Http\Controllers\ShopController::class, 'exportShopsList'])->name('shop.export.list');
Route::get('/shopExport', [App\Http\Controllers\ShopController::class, 'export'])->name('shop.export');
Route::resource('/image','App\Http\Controllers\ImageController')->only(['destroy']);
Route::resource('/blog','App\Http\Controllers\BlogController')->only(['index','create','store','edit','update','show','destroy']);
Route::resource('/user','App\Http\Controllers\UserController')->only(['index','create','store','edit','update','show','destroy']);  //->middleware('can:user.index');<=Gate

// for comments:
Route::post('/storePrdComt/{id}', [App\Http\Controllers\CommentController::class, 'storeProductComment'])->name('storeProductComment');
Route::post('/storeBlgComt/{id}', [App\Http\Controllers\CommentController::class, 'storeBlogComment'])->name('storeBlogComment');

//mail
Route::get('/mailPreview',function(){
    $comment=Comment::findOrFail(21);
    return new ProductCommentPosted($comment);
});
//notification
Route::get('/notifications',[App\Http\Controllers\NotificationController::class, 'index'])->name('notification')->middleware('can:notification');
Route::delete('/notification/{id}',[App\Http\Controllers\NotificationController::class, 'destroy'])->name('notification.destroy')->middleware('can:notification');
Route::put('/notification/{id}',[App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notification.markAsRead')->middleware('can:notification');


// cart routes
Route::get('/addToCart',[App\Http\Controllers\CartController::class, 'addToCart'])->name('addToCart');
Route::get('/removeSessionProduct/{id}',[App\Http\Controllers\CartController::class, 'removeSessionProduct'])->name('removeSessionProduct');
//>>>cart
Route::get('/cart/',[App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
//>>>wishlist
Route::get('/wishlist/',[App\Http\Controllers\WishlistController::class, 'index'])->name('wishlist.index');
Route::get('/destroyWishlist/{id}',[App\Http\Controllers\WishlistController::class, 'destroy'])->name('wishlist.destroy');
Route::get('/storeWishlist/{id}',[App\Http\Controllers\WishlistController::class, 'store'])->name('wishlist.store');

//Discount
Route::resource('/discount','App\Http\Controllers\DiscountController')->only(['index','create','store','edit','update','destroy']);
Route::get('/affect_to_products/{disId}',[App\Http\Controllers\DiscountController::class, 'affect_to_products'])->name('affect_to_products');
Route::get('/discount_product/{discountId}',[App\Http\Controllers\DiscountController::class, 'discount_product'])->name('discount_product');

// checkout
Route::post('/checkout_process_discount', [App\Http\Controllers\OrderController::class, 'checkout_process_discount'])->name('checkout_process_discount');
Route::post('/confirm_order', [App\Http\Controllers\OrderController::class, 'confirm_order'])->name('confirm_order');
Route::post('/save_order', [App\Http\Controllers\OrderController::class, 'save_order'])->name('save_order');


//Discount Type
Route::resource('/discount_type','App\Http\Controllers\DiscountTypeController')->only(['index','store','edit','update','destroy']);

//Shipping
Route::resource('/shipping','App\Http\Controllers\ShippingController')->only(['index','store','edit','update','destroy']);

//order_status
Route::resource('/orderStatus','App\Http\Controllers\OrderStatusController')->only(['index','store','edit','update','destroy']);
//adress
Route::resource('/address','App\Http\Controllers\AddressController')->only(['index','create','store','edit','update','destroy']);







