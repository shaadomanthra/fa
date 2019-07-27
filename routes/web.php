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
    if(\auth::guest())
        return view('welcome');
    else
        return view('appl.pages.dashboard');
});



Route::get('/home', function () {
    return redirect('/');
})->name('home');

// login routes
Auth::routes(['verify' => true]);

//under construction page
Route::get('/construction', function () {
        return view('appl.pages.construction');
})->name('construction');

/* Admin Routes */
Route::get('/admin', 'Admin\AdminController@index')->name('admin')->middleware('auth');
Route::get('/admin/analytics', 'Admin\AdminController@analytics')->name('admin.analytics')->middleware('auth');

/* Admin Application Routes */
Route::resource('/admin/test', 'Test\TestController')->middleware('auth');
Route::resource('/admin/category', 'Test\CategoryController')->middleware('auth');
Route::resource('/admin/tag', 'Test\TagController')->middleware('auth');
Route::resource('/admin/test/{test}/section', 'Test\SectionController')->middleware('auth');
Route::resource('/admin/test/{test}/extract', 'Test\ExtractController')->middleware('auth');
Route::resource('/admin/test/{test}/mcq', 'Test\McqController')->middleware('auth');
Route::resource('/admin/test/{test}/fillup', 'Test\FillupController')->middleware('auth');
Route::resource('/admin/file', 'Test\FileController')->middleware('auth');
Route::resource('/admin/group', 'Test\GroupController')->middleware('auth');
Route::resource('/admin/type', 'Test\TypeController')->middleware('auth');


/* User Routes */
Route::resource('/admin/user', 'User\UserController')->middleware('auth');

/* Test Attempt Routes */
Route::get('/test/{test}','Test\AttemptController@instructions')->middleware('auth')->name('test');
Route::get('/test/{test}/try','Test\AttemptController@try')->middleware('auth')->name('test.try');
Route::post('/test/{test}/try','Test\AttemptController@store')->name('attempt.store');
Route::post('/test/{test}/upload','Test\AttemptController@upload')->name('attempt.upload');
Route::get('/test/{test}/delete','Test\AttemptController@file_delete')->name('attempt.delete');
Route::get('/test/{test}/evaluation','Test\AttemptController@evaluation')->name('attempt.evaluation');
Route::get('/test/{test}/analysis','Test\AttemptController@analysis')->middleware('auth')->name('test.analysis');


/* Product Routes */
Route::resource('/admin/product', 'Product\ProductController')->middleware('auth');
Route::resource('/admin/coupon', 'Product\CouponController')->middleware('auth');

/* Product/Orders Public Routes */
Route::get('/products','Product\ProductController@public')->name('product.public');
Route::get('/products/{product}','Product\ProductController@view')->name('product.view');
Route::get('/checkout/{product}','Product\OrderController@checkout')->name('product.checkout')->middleware('auth');
Route::post('/order','Product\OrderController@order')->name('product.order');
Route::get('/order_payment', 'Product\OrderController@instamojo_return');
Route::post('/order_payment', 'Product\OrderController@instamojo_return');

/* Sample Routes */
Route::get('/listening', function(){
    return view('appl.pages.listening');
})->name('listening');

Route::get('/reading', function(){
    return view('appl.pages.reading')->with('reading',1);
})->name('reading');

Route::get('/pricing', function(){
    return view('appl.pages.pricing');
})->name('pricing');
