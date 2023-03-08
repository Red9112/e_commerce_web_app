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
Route::resource('/product','App\Http\Controllers\productController')->only(['index','create','store','edit','update','show','destroy']);
Route::get('/pdf', [App\Http\Controllers\HomeController::class, 'pdf'])->name('pdf');
Route::get('/downloadPDF', [App\Http\Controllers\HomeController::class, 'downloadPDF'])->name('downloadPDF');
Route::post('/importCategory', [App\Http\Controllers\CategoryController::class, 'import'])->name('category.store.excel');
Route::resource('/image','App\Http\Controllers\ImageController')->only(['destroy']);
Route::resource('/blog','App\Http\Controllers\BlogController')->only(['index','create','store','edit','update','show','destroy']);
Route::resource('/user','App\Http\Controllers\UserController')->only(['index','create','store','edit','update','show','destroy']);  //->middleware('can:user.index');<=Gate

//shops
Route::resource('/shop','App\Http\Controllers\shopController')->only(['index','create','store','edit','update','show','destroy']);
Route::get('/shopExportList', [App\Http\Controllers\ShopController::class, 'exportShopsList'])->name('shop.export.list');
Route::get('/shopExport', [App\Http\Controllers\ShopController::class, 'export'])->name('shop.export');
Route::get('/shops_view_user', [App\Http\Controllers\ShopController::class, 'shops_view_user'])->name('shop.view.user');
Route::get('/display_shop_products/{id}', [App\Http\Controllers\ShopController::class, 'display_shop_products'])->name('display.shop.products');
//-------------------
// for comments:
Route::post('/storePrdComt/{id}', [App\Http\Controllers\CommentController::class, 'storeProductComment'])->name('storeProductComment');
Route::post('/storeBlgComt/{id}', [App\Http\Controllers\CommentController::class, 'storeBlogComment'])->name('storeBlogComment');
//-------------------
//mail
Route::get('/mailPreview',function(){
    $comment=Comment::findOrFail(21);
    return new ProductCommentPosted($comment);
});
//-------------------
//notification
Route::get('/notifications',[App\Http\Controllers\NotificationController::class, 'index'])->name('notification')->middleware('can:notification');
Route::delete('/notification/{id}',[App\Http\Controllers\NotificationController::class, 'destroy'])->name('notification.destroy')->middleware('can:notification');
Route::put('/notification/{id}',[App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notification.markAsRead')->middleware('can:notification');
//-------------------
// cart routes
Route::get('/addToCart',[App\Http\Controllers\CartController::class, 'addToCart'])->name('addToCart');
Route::get('/removeSessionProduct/{id}',[App\Http\Controllers\CartController::class, 'removeSessionProduct'])->name('removeSessionProduct');
//-------------------

//>>>cart
Route::get('/cart/',[App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
//-------------------

//>>>wishlist
Route::get('/wishlist/',[App\Http\Controllers\WishlistController::class, 'index'])->name('wishlist.index');
Route::get('/destroyWishlist/{id}',[App\Http\Controllers\WishlistController::class, 'destroy'])->name('wishlist.destroy');
Route::get('/storeWishlist/{id}',[App\Http\Controllers\WishlistController::class, 'store'])->name('wishlist.store');
//-------------------

//Discount
Route::resource('/discount','App\Http\Controllers\DiscountController')->only(['index','create','store','edit','update','destroy']);
Route::get('/affect_to_products/{disId}',[App\Http\Controllers\DiscountController::class, 'affect_to_products'])->name('affect_to_products');
Route::get('/discount_product/{discountId}',[App\Http\Controllers\DiscountController::class, 'discount_product'])->name('discount_product');
//-------------------

// checkout
Route::post('/checkout_process_discount', [App\Http\Controllers\OrderController::class, 'checkout_process_discount'])->name('checkout_process_discount');
Route::post('/confirm_order', [App\Http\Controllers\OrderController::class, 'confirm_order'])->name('confirm_order');
Route::post('/save_order', [App\Http\Controllers\OrderController::class, 'save_order'])->name('order.store');
//-------------------

//Order
Route::get('/customer_orders', [App\Http\Controllers\OrderController::class, 'customer_orders_index'])->name('customer.orders');
Route::get('/vendor_orders', [App\Http\Controllers\OrderController::class, 'vendor_orders_index'])->name('vendor.orders');
Route::get('/admin_orders', [App\Http\Controllers\OrderController::class, 'admin_orders_index'])->name('admin.orders');
Route::get('/order_show/{order}', [App\Http\Controllers\OrderController::class, 'order_show'])->name('order.show');
Route::get('/order_vendor_show/{order}', [App\Http\Controllers\OrderController::class, 'order_vendor_show'])->name('order.vendor.show');
Route::post('/order_cancel/{order}', [App\Http\Controllers\OrderController::class, 'order_cancel'])->name('order.cancel');
Route::get('/order_destroy/{id}', [App\Http\Controllers\OrderController::class, 'destroy'])->name('order.destroy');
//-------------------

//Discount Type
Route::resource('/discount_type','App\Http\Controllers\DiscountTypeController')->only(['index','store','edit','update','destroy']);


//Shipping
Route::resource('/shipping','App\Http\Controllers\ShippingController')->only(['index','store','edit','update','destroy']);

//order_status
Route::resource('/orderStatus','App\Http\Controllers\OrderStatusController')->only(['index','store','edit','update','destroy']);
Route::put('/set_order_status/{order}', [App\Http\Controllers\OrderController::class, 'set_order_status'])->name('set.order.status');

//address
Route::resource('/address','App\Http\Controllers\AddressController')->only(['index','create','store','edit','update','destroy']);
Route::get('/My_addresses', [App\Http\Controllers\AddressController::class, 'user_addresses'])->name('My_addresses');


//payment
Route::resource('/payment','App\Http\Controllers\PaymentController')->only(['index','store','edit','update','destroy']);
Route::get('/payment/user_cards', [App\Http\Controllers\PaymentController::class, 'user_cards'])->name('user_cards');






