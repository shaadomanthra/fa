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


/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/layout2', 'HomeController@index')->name('root');
Route::get('/', 'HomeController@welcome');

Route::get('/home', 'HomeController@dashboard')->name('home')->middleware('auth');

// login routes
Auth::routes();

//under construction page
Route::get('/construction', function () {
        return view('appl.pages.construction');
})->name('construction');

/* Admin Routes */
Route::get('/admin', 'Admin\AdminController@index')->name('admin')->middleware('auth');
Route::get('/admin/analytics', 'Admin\AdminController@analytics')->name('admin.analytics')->middleware('auth');
Route::post('/admin/contact', 'Admin\AdminController@contact')->name('admin.contact');
Route::post('/admin/notify', 'Admin\AdminController@notify')->name('admin.notify');

/* Admin Application Routes */
Route::resource('/admin/test', 'Test\TestController')->middleware('auth');
Route::get('/admin/test/{test}/view', 'Test\AttemptController@view')->middleware('auth')->name('test.view');
Route::get('/admin/test/{test}/cache', 'Test\TestController@cache')->middleware('auth')->name('test.cache');
Route::get('/admin/test/{test}/cache_delete', 'Test\TestController@cache_delete')->middleware('auth')->name('test.cache.delete');

Route::resource('/admin/category', 'Test\CategoryController')->middleware('auth');
Route::resource('/admin/tag', 'Test\TagController')->middleware('auth');
Route::resource('/admin/test/{test}/section', 'Test\SectionController')->middleware('auth');
Route::resource('/admin/test/{test}/extract', 'Test\ExtractController')->middleware('auth');
Route::resource('/admin/test/{test}/mcq', 'Test\McqController')->middleware('auth');
Route::resource('/admin/test/{test}/fillup', 'Test\FillupController')->middleware('auth');
Route::get('/admin/test/{test}/questions', 'Test\TestController@questions')->name('test.questions')->middleware('auth');
Route::get('/admin/test/{test}/analytics', 'Test\TestController@analytics')->name('test.analytics')->middleware('auth');
Route::resource('/admin/file', 'Test\FileController')->middleware('auth');
Route::get('/admin/{file}/download','Test\FileController@download')->name('file.download');
Route::get('/admin/{file}/notify','Test\FileController@notify')->name('review.notify');
Route::get('/admin/{file}/assign','Test\FileController@assign')->name('file.assign');
Route::post('/admin/{file}/assign','Test\FileController@assignupdate')->name('file.assign');

Route::get('/admin/prospect/dashboard', 'Admin\ProspectController@dashboard')->middleware('auth')->name('prospect.dashboard');
Route::resource('/admin/prospect', 'Admin\ProspectController')->middleware('auth');
Route::resource('/admin/followup', 'Admin\FollowupController')->middleware('auth');
Route::resource('/admin/group', 'Test\GroupController')->middleware('auth');
Route::resource('/admin/type', 'Test\TypeController')->middleware('auth');

Route::resource('/admin/form', 'Admin\FormController')->middleware('auth');

Route::get('/request-form','Admin\FormController@request')->name('form.request');
Route::post('/request-form','Admin\FormController@save')->name('form.save');

/* User Routes */
Route::resource('/admin/user', 'User\UserController')->middleware('auth');
Route::get('/admin/user/{user}/{test}','User\UserController@test')->middleware('auth')->name('user.test');
Route::post('/admin/user/{user}/{test}','User\UserController@test')->middleware('auth')->name('user.test');

/* Editor routes */
Route::get('/admin/editor','Admin\EditorController@index')->middleware('auth')->name('editor.index');
Route::get('/admin/editor/page','Admin\EditorController@page')->middleware('auth')->name('editor.page');
Route::post('/admin/editor/page','Admin\EditorController@page')->middleware('auth')->name('editor.post');



/* Test Attempt Routes */
Route::get('/test/','Test\TestController@public')->name('tests');
Route::get('/test/{test}','Test\TestController@details')->name('test');
Route::get('/test/{test}/instructions','Test\AttemptController@instructions')->name('test.instructions');
Route::get('/test/{test}/try','Test\AttemptController@try')->name('test.try');
Route::post('/test/{test}/try','Test\AttemptController@store')->name('attempt.store');
Route::post('/test/{test}/upload','Test\AttemptController@upload')->name('attempt.upload');
Route::get('/test/{test}/delete','Test\AttemptController@file_delete')->name('attempt.delete');
Route::get('/test/{test}/review','Test\AttemptController@review')->name('test.review');

Route::get('/test/{test}/evaluation','Test\AttemptController@evaluation')->name('attempt.evaluation');
Route::get('/test/{test}/analysis','Test\AttemptController@analysis')->middleware('auth')->name('test.analysis');


/* Product Routes */
Route::resource('/admin/product', 'Product\ProductController')->middleware('auth');
Route::resource('/admin/coupon', 'Product\CouponController')->middleware('auth');
Route::resource('/admin/order', 'Product\OrderController')->middleware('auth');
Route::get('/orders', 'Product\OrderController@myorders')->middleware('auth')->name('myorders');
Route::get('/orders/{order}', 'Product\OrderController@myordersview')->middleware('auth')->name('myorder.view');

Route::resource('/admin/track', 'Course\TrackController')->middleware('auth');
Route::resource('/admin/track/{track}/session', 'Course\SessionController')->middleware('auth');
Route::get('/session/{session}','Course\SessionController@url')->name('session.url')->middleware('auth');
Route::get('/session/{session}/join','Course\SessionController@join')->name('session.join')->middleware('auth');

/* product redirect */
Route::get('products/ielts-short-test', function () {
    return redirect('products/ielts-mini-test');
});
/* Product/Orders Public Routes */
Route::get('/products','Product\ProductController@public')->name('product.public');
Route::get('/products/{product}','Product\ProductController@view')->name('product.view');
Route::get('/checkout/{product}','Product\OrderController@checkout')->name('product.checkout')->middleware('auth');
Route::get('/checkout-access/{product}','Product\OrderController@checkout_access')->name('product.checkout-access')->middleware('auth');
Route::post('/order','Product\OrderController@order')->name('product.order');
Route::get('/order_payment', 'Product\OrderController@instamojo_return');
Route::post('/order_payment', 'Product\OrderController@instamojo_return');
Route::get('/couponcode','Product\CouponController@try')->name('coupon.try')->middleware('auth');
Route::get('/couponcode/code','Product\CouponController@use')->name('coupon.use')->middleware('auth');


/* Pages */
Route::get('/terms', function(){ return view('appl.pages.terms');})->name('terms');
Route::get('/privacy', function(){ return view('appl.pages.privacy');})->name('privacy');
Route::get('/refund', function(){ return view('appl.pages.refund');})->name('refund');
Route::get('/disclaimer', function(){ return view('appl.pages.disclaimer');})->name('disclaimer');
Route::get('/contact', function(){ return view('appl.pages.contact');})->name('contact');
Route::get('/downloads', function(){ return view('appl.pages.downloads');})->name('downloads');

Route::get('/ieltswriting', function(){ return view('appl.pages.ieltswriting');})->name('ieltswriting');

Route::post('/api/register', 'User\UserController@register')->name('apiregister');
Route::post('/api/login', 'User\UserController@login')->name('apilogin');
Route::get('/api/login', 'User\UserController@login')->name('apilogin');
Route::get('/api/phone', 'User\UserController@phone')->name('apiphone');
Route::get('/user/edit', 'User\UserController@useredit')->name('useredit');
Route::post('/user/edit', 'User\UserController@userstore')->name('userstore');

/* user verify routes */
Route::get('/activation', 'User\VerifyController@activation')->name('activation')->middleware('auth');
Route::post('/activation', 'User\VerifyController@activation')->name('activation');
Route::get('/activation/mail/{token}', 'User\VerifyController@email')->name('email.verify');

Route::post('/activation/phone', 'User\VerifyController@sms')->name('sms.verify');

/* Blog Routes */
Route::post('/blog/tooltip', 'Blog\BlogController@tooltip')->name('tooltip');
Route::get('/blog/tooltip', 'Blog\BlogController@tooltip')->name('tooltip');
Route::resource('/blog', 'Blog\BlogController');

Route::resource('/admin/label', 'Blog\LabelController')->middleware('auth');
Route::resource('/admin/collection', 'Blog\CollectionController')->middleware('auth');

/* Page Routes */
Route::resource('/admin/page', 'Admin\PageController')->middleware('auth');


Route::get('/category/{category}', 'Blog\CollectionController@list')->name('category.list');
Route::get('/tag/{tag}', 'Blog\LabelController@list')->name('tag.list');
Route::get('/{year}/{month}', 'Blog\CollectionController@yearmonth')->name('year.list');

Route::get('/ieltspage', function(){
    return view('appl.pages.ielts');
})->name('ielts.page');

Route::get('/{page}','Admin\PageController@show')->name('page.view');
/* learners club */
Route::get('/learnersclub', function(){
    return view('appl.pages.lclub');
})->name('listening');

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
