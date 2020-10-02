<?php

use Illuminate\Support\Facades\Route;

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

//発注画面
Route::get('/order','OrderController@index');
Route::get('/order/input','OrderController@input');
Route::post('/order/confirmation','OrderController@create');

//発注履歴
Route::get('/order/history','OrderController@history');
Route::post('/order/history','OrderController@display');

//食材の表示・追加
Route::get('/order/item','OrderController@item');
Route::post('/order/item','OrderController@itemCreate');

//食材の編集
Route::get('/order/item/edit','OrderController@itemEdit');
ROute::post('/order/item/edit','OrderController@itemUpdate');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
