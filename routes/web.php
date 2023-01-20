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
