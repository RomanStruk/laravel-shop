<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function (){
    Route::get('/product/index', 'Api\v1\ProductController@index');
    Route::get('/product/search', 'Api\v1\ProductController@search');
    Route::get('/category/index', 'Api\v1\CategoryController@index');
    Route::get('/filter/index', 'Api\v1\FilterController@index');
    Route::get('/comment/index/product/{id}', 'Api\v1\CommentController@index');

    Route::get('/shipping/warehouses/{cityRef}', 'Api\v1\ShippingController@showWarehouse');
    Route::get('/shipping/city/{city}', 'Api\v1\ShippingController@showCity');

    //TODO токени авторизації
    Route::get('/dashboard/sales', 'Api\v1\DashboardController@sales')->middleware(['auth:api']);
//    Route::get('/dashboard/sales', 'Api\v1\DashboardController@sales');
    Route::post('/media/store', 'Api\v1\MediaController@store')->middleware(['auth:api']);
    Route::get('/media/detail/{media}', 'Api\v1\MediaController@show')->middleware(['auth:api']);
    Route::delete('/media/destroy/{media}', 'Api\v1\MediaController@destroy')->middleware(['auth:api']);


//    Route::post('/user/login', 'Api\v1\UserController@login');
});
