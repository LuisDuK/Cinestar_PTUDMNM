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
/*Guest*/
Route::get('/homeindex','App\Http\Controllers\HomeController@index')->name('homeindex');
Route::get('/phim/dang-chieu', 'App\Http\Controllers\HomeController@movieshowing')->name('phimdangchieu');
Route::get('/phim/sap-chieu', 'App\Http\Controllers\HomeController@movieupcoming')->name('phimsapchieu');
Route::get('/dat-ve/{maPhim}', 'App\Http\Controllers\HomeController@index')->name('datve');

Route::get('/phim/{maPhim}', 'App\Http\Controllers\FilmController@show')->name("phim");
Route::get('/lich-chieu/{maPhim}', 'App\Http\Controllers\BookingticketController@showLichChieu')->name('lich-chieu');
Route::get('/dat-ghe/{maLichChieuPhim}', 'App\Http\Controllers\BookingticketController@showPhongChieu')->name('dat-ghe');
/*Ham sử dụng*/
Route::get('/get-ngay-chieu/{maPhim}', 'App\Http\Controllers\HomeController@getNgayChieu');
Route::get('/get-suat-chieu/{maPhim}/{ngayChieu}', 'App\Http\Controllers\HomeController@getSuatChieu');
Route::get('/get-ma-lich-chieu-phim/{maPhim}/{ngayChieu}/{gioBatDau}', 'App\Http\Controllers\HomeController@getMaLichChieuPhim');
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/auth', 'App\Http\Controllers\AuthController@viewauth')->name('auth');;

// Trả về nội dung form đăng nhập
Route::get('/auth/login', function () {
    return view('auth.login_content');
})->name('authlogin');;

// Trả về nội dung form đăng ký
Route::get('/auth/register', function () {
    return view('auth.register_content');
})->name('authregister');;

require __DIR__.'/auth.php';
/*--Guest---*/