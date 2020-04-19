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


Route::get('/admin/lte', function () {
    return view('admin.layouts.root');
});

Route::get('/', function () {
    return view('index');
});
Route::get('/index-2', function () {
    return view('index-2');
});
Route::get('/index-3', function () {
    return view('index-3');
});

Route::group(['prefix' => '/shop'], function () {

    Route::get('/category/{cat}', [
        'uses' => 'ProductController@index',
        'as' => 'shop_category'
    ]);
    Route::get('/', [
        'uses' => 'ProductController@index',
        'as' => 'shop_main'
    ]);
});

Route::get('/product/{alias}', 'ProductController@show')
    ->name('product.index')
    ->middleware('test');

Route::post('/product/{id}/comment/create', 'CommentController@create')
    ->name('comment.create');

Route::post('/checkout', 'OrderController@checkOut')
    ->name('checkout');

Route::get('/checkout', function () {
    return view('vue.checkout');
});

Route::get('/about', function () {
    return view('about');
});
Route::get('/blog', function () {
    return view('blog');
});
Route::get('/blog-details', function () {
    return view('blog-details');
});

Route::get('/compare', function () {
    return view('compare');
});


Route::get('/contact', 'ContactController@show');
Route::post('/contact', 'ContactController@processingData');

Route::get('/wishlist', function () {
    return view('wishlist');
});

Route::get('/account', function () {
    return view('account');
})->middleware(['auth']);;
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


Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => ['auth', 'role.check:Admin']
], function (){

    Route::get('/', [
        'uses' => 'Admin\HomeController@index',
        'as' => 'dashboard.index'
    ]);

    Route::resource('/order', 'Admin\OrderController');
    Route::post('/order/status/{order}/update', [
        'uses' => 'Admin\OrderController@updateStatus',
        'as' => 'order.updateStatus'
    ]);


    Route::resource('category', 'Admin\CategoryController')->except(['show']);
    Route::resource('product', 'Admin\ProductController');
    Route::resource('media', 'Admin\MediaController');
    Route::resource('user', 'Admin\UserController');
    Route::resource('filter', 'Admin\FilterController');
});


Route::get('/shop2', 'ProductController@index2')->middleware('web')->name('shop2');


Route::get('/test', 'ProductController@apiTest')->middleware('web');

Route::get('/php', function (){
   phpinfo();
});
