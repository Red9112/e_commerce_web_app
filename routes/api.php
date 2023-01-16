<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')
->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('App\Http\Controllers\Api\V1')->name('api.v1.')->group(function () {

Route::post('/login','ApiAuthController@login');

    Route::get('/test',function(){
        return response()->json([
            'id'=>1,
        ]);
        })->name('test');

    Route::apiResource('blog','BlogController');

});

