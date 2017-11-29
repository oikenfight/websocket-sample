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

Route::get('/message', [
    'as' => 'message.index',
    'uses' => _uses(\App\Http\Controllers\MessageController::class, 'index'),
]);
Route::post('/message', [
    'as' => 'message.post',
    'uses' => _uses(\App\Http\Controllers\MessageController::class, 'post'),
]);

Route::get('/test', 'HomeController@test')->name('test');
Route::get('/pusher', [
    'as' => 'message.post',
    'uses' => _uses(\App\Http\Controllers\HomeController::class, 'pusher'),
]);