<?php

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


Route::get('/', function () {
    return view('index');
});
Route::get('/index-2', function () {
    return view('index-2');
});
Route::get('/index-3', function () {
    return view('index-3');
});

Route::group(['prefix' => '/shop', 'middleware' => ['web']], function () {

    Route::get('/category/{cat}', [
        'uses' => 'ProductController@showProducts',
        'as' => 'shop_category'
    ]);
    Route::get('/category/{cat}/filter/{filter}', [
        'uses' => 'ProductController@showProducts',
        'as' => 'shop_category_filter'
    ]);
    Route::post('/category/{cat}/filter/{filter}', [
        'uses' => 'ProductController@showProducts'
    ]);;
    Route::post('/category/{cat}', [
        'uses' => 'ProductController@showProducts'
    ]);
    Route::get('/', [
        'uses' => 'ProductController@index',
        'as' => 'shop_main'
    ]);
});

Route::get('/product/{alias}', 'ProductController@showSingleProduct')
    ->name('product')
    ->middleware('test')
    ->middleware('web');

Route::post('/product/{id}/comment/create', 'CommentController@create')
    ->name('comment.create')
    ->middleware('web');

Route::post('/checkout', 'OrderController@checkOut')
    ->name('checkout');


Route::get('/about', function () {
    return view('about');
});
Route::get('/account', function () {
    return view('account');
})->middleware(['web', 'auth']);;
Route::get('/blog', function () {
    return view('blog');
});
Route::get('/blog-details', function () {
    return view('blog-details');
});



Route::get('/checkout', function () {
    return view('vue.checkout');
});


Route::get('/compare', function () {
    return view('compare');
});


Route::get('/contact', 'ContactController@show');
Route::post('/contact', 'ContactController@processingData');

Route::get('/wishlist', function () {
    return view('wishlist');
});

Route::get('/forgot-password', function () {
    return view('forgot-password');
});
Route::get('/login2', function () {
    return view('login');
});
Route::get('/register', function () {
    return view('register');
});

Route::get('/404', function () {
    return view('404');
});

Auth::routes();


Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth']], function (){
    Route::get('/', ['uses' => 'Admin\HomeController@index', 'as' => 'admin.dashboard.index']);
    Route::get('/order', ['uses' => 'Admin\OrderController@index', 'as' => 'admin.order.index']);
    Route::get('/order/{id}', ['uses' => 'Admin\OrderController@revision', 'as' => 'admin.order.revision']);
});

Route::get('/shop/json', 'ProductController@apiShowProducts');
Route::get('/shop2', 'ProductController@showProducts')->middleware('web')->name('shop2');
Route::get('/category/get/json', 'CategoriesController@getDataCategoriesJson');
Route::get('/filter/get/json', 'AttributeController@getDataAttributesJson');


Route::get('/test', 'ProductController@apiTest')->middleware('web');
