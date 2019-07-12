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



Route::get('/home', 'HomeController@index')->name('home');

// login routes
Auth::routes();

//under construction page
Route::get('/construction', function () {
        return view('appl.pages.construction');
})->name('construction');

/* Admin Routes */
Route::get('/admin', 'Admin\AdminController@index')->name('admin')->middleware('auth');

/* Test Application Routes */
Route::resource('/admin/test', 'Test\TestController')->middleware('auth');
Route::resource('/admin/category', 'Test\CategoryController')->middleware('auth');
Route::resource('/admin/tag', 'Test\TagController')->middleware('auth');
Route::resource('/admin/test/{test}/section', 'Test\SectionController')->middleware('auth');
Route::resource('/admin/test/{test}/extract', 'Test\ExtractController')->middleware('auth');
Route::resource('/admin/test/{test}/mcq', 'Test\McqController')->middleware('auth');
Route::resource('/admin/test/{test}/fillup', 'Test\FillupController')->middleware('auth');

/* Test Attempt Routes */
Route::get('/test/{test}','Test\AttemptController@instructions')->middleware('auth')->name('test');
Route::get('/test/{test}/try','Test\AttemptController@try')->middleware('auth')->name('test.try');
Route::post('/test/{test}/try','Test\AttemptController@store')->name('test.store');
Route::get('/test/{test}/analysis','Test\AttemptController@analysis')->middleware('auth')->name('test.analysis');

/* Sample Routes */
Route::get('/listening', function(){
    return view('appl.pages.listening');
})->name('listening');

Route::get('/reading', function(){
    return view('appl.pages.reading');
})->name('reading');
