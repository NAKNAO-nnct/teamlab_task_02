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

use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('welcome');
});

# # # # #
#  ログイン系
# # # # #
// ログインページ
Route::get('/login', function () {
    return view('login');
});

// ログイン処理
Route::post('/login', function () {
});

// ログアウト処理
Route::get('/logout', function () {
});

# # # # #
# OAuth
# # # # #
Route::get('/callback', 'LoginController@getLineUserProfile');

# # # # #
# マイページ
# # # # #
// マイページ
Route::get('/myPage', function () {
});

