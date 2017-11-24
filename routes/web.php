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
    return view('welcome');
});


Auth::routes();



Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    // 1 on 1
    Route::get('/1on1', [
        'as' => 'chat-1on1.index',
        'uses' => _uses(\App\Http\Controllers\Chat1on1Controller::class, 'index'),
    ]);
});
