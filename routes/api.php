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

Route::group(['prefix' => 'v1', 'as' => 'api.v1.'], function (){
    //auth
    Route::post('/login', 'Api\v1\AuthController@login');
    Route::post('/fast-register', 'Api\v1\AuthController@fastRegister');
    Route::get('/logout', 'Api\v1\AuthController@logout')->middleware(['auth:api']);

    // order
    Route::apiResource('order', 'Api\v1\OrderController')->middleware(['auth:api']);

    // Admin API
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth:api']], function () {
        Route::apiResource('order', 'Api\v1\Admin\OrderController');
        Route::apiResource('user', 'Api\v1\Admin\UserController');
        Route::apiResource('category', 'Api\v1\Admin\CategoryController');
        Route::apiResource('filter', 'Api\v1\Admin\FilterController');
        Route::apiResource('media', 'Api\v1\Admin\MediaController');
        Route::apiResource('product', 'Api\v1\Admin\ProductController');
        Route::apiResource('supplier', 'Api\v1\Admin\SupplierController');
        Route::apiResource('syllable', 'Api\v1\Admin\SyllableController');
    });

    Route::get('/product/index', 'Api\v1\ProductController@index');
    Route::get('/product/search', 'Api\v1\ProductController@search');
    Route::get('/category/index', 'Api\v1\CategoryController@index');
    Route::get('/filter/index', 'Api\v1\FilterController@index');
    Route::get('/comment/index/product/{id}', 'Api\v1\CommentController@index');

    Route::get('/shipping/address', 'Api\v1\ShippingController@listOfAddresses');
    Route::get('/shipping/city', 'Api\v1\ShippingController@listOfCities');
    Route::get('/search/shipping/city', 'Api\v1\SearchController@shippingCity');
    // validate unique email
    Route::get('/validate/email/{email}', 'Api\v1\ValidateController@email');



    //TODO токени авторизації
    Route::get('/dashboard/sales', 'Api\v1\DashboardController@sales')->middleware(['auth:api']);
//    Route::get('/dashboard/sales', 'Api\v1\DashboardController@sales');
    Route::post('/media/store', 'Api\v1\MediaController@store')->middleware(['auth:api']);
    Route::get('/media/detail/{media}', 'Api\v1\MediaController@show')->middleware(['auth:api']);
    Route::delete('/media/destroy/{media}', 'Api\v1\MediaController@destroy')->middleware(['auth:api']);

    Route::get('/search/users', 'Api\v1\SearchController@users')->middleware(['auth:api']);
    Route::get('/search/products', 'Api\v1\SearchController@products')->middleware(['auth:api']);
    Route::apiResource('supplier', 'Api\v1\SupplierController');
    Route::apiResource('syllable', 'Api\v1\SyllableController');
//    Route::post('/user/login', 'Api\v1\UserController@login');
});
