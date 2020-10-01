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

// 微信
//Route::get('/', 'WeChatServerController@index');

Route::any('wechat', 'WeChatServerController@index');

Route::post('wechat', 'WeChatServerController@server');

// 已设置菜单
Route::any('wechat/menus', 'WeChatServerController@menuList');

// 当前菜单
Route::any('wechat/current_menu', 'WeChatServerController@currentMenu');
// 创建菜单
Route::any('wechat/create_menus', 'WeChatServerController@createMenu');

