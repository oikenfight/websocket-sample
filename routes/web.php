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

// message to broadcast
Route::get('/message', [
    'as' => 'message.index',
    'uses' => _uses(\App\Http\Controllers\MessageController::class, 'index'),
]);
Route::post('/message', [
    'as' => 'message.post',
    'uses' => _uses(\App\Http\Controllers\MessageController::class, 'post'),
]);

// message to a user
Route::get('/message-to-user', [
    'as' => 'message-to-user.index',
    'uses' => _uses(\App\Http\Controllers\MessageToUserController::class, 'index'),
]);
Route::post('/message-to-user', [
    'as' => 'message-to-user.post',
    'uses' => _uses(\App\Http\Controllers\MessageToUserController::class, 'post'),
]);

// message to group users
Route::get('/message-to-group', [
    'as' => 'message-to-group.index',
    'uses' => _uses(\App\Http\Controllers\MessageToGroupController::class, 'index'),
]);
Route::post('/message-to-group', [
    'as' => 'message-to-group.post',
    'uses' => _uses(\App\Http\Controllers\MessageToGroupController::class, 'post'),
]);

// api
Route::get('/get-all-users', [
    'as' => 'api.get.all-users',
    'uses' => _uses(\App\Http\Controllers\MessageToUserController::class, 'getAllUser'),
]);
Route::get('/get-all-groups', [
    'as' => 'api.get.all-groups',
    'uses' => _uses(\App\Http\Controllers\MessageToGroupController::class, 'getAllGroup'),
]);
Route::get('get-auth-user', function () {
    return Auth::user();
});



// test
Route::get('/test', 'HomeController@test')->name('test');
Route::get('/pusher', [
    'as' => 'message.post',
    'uses' => _uses(\App\Http\Controllers\HomeController::class, 'pusher'),
]);