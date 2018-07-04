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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/{count?}',['uses'=>'MainController@index','as'=>'index']);
Route::post('/save/',['uses'=>'MainController@save','as'=>'save']);
Route::post('/priem/',['uses'=>'MainController@priem','as'=>'priem']);