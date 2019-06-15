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
//登录
Route::get('/login','user\UserssController@login');

Route::get('/curl','Text\TextController@curl');//百度
Route::get('/curl1','Text\TextController@curl1');//access_token
Route::post('/curl3','Text\TextController@curl3');//access_token
Route::get('/curlpost','Text\TextController@curlpost');//access_token
Route::get('/menu','Text\TextController@menu');//access_token
Route::get('/file','Text\TextController@file');//access_token
Route::post('/filedo','Text\TextController@filedo');//access_token
Route::get('/form_data','Text\TextController@form_data');//access_token
Route::get('/urlencoded','Text\TextController@urlencoded');//access_token
Route::get('/raw','Text\TextController@raw');//access_token
Route::get('/jm','Text\TextController@jm');//测试 加密
Route::get('/encrypt','Text\TextController@encrypt');//对称加密
Route::get('/asymm','Text\TextController@asymm');//非对称加密
Route::get('/personal','Text\TextController@personal');//私钥非对称加密
Route::get('/exercise','Text\TextController@exercise');//练习私钥非对称加密
Route::post('/syntony','Text\TextController@syntony');//练习接收回调私钥非对称加密
Route::get('/alipay','Text\TextController@alipay');//  支付宝






Route::get('/ceshi','Text\TextController@ceshi');//$_SERVER