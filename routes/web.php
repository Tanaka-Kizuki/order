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

Route::get('/order','OrderController@index');
Route::get('/order/input','OrderController@input');
Route::post('/order/confirmation','OrderController@create');
Route::get('/order/history','OrderController@history');
Route::post('/order/history','OrderController@display');