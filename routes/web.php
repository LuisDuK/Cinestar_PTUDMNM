<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\MoMoController;
use App\Http\Controllers\PayPalController;


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
Route::get('/homeindex','App\Http\Controllers\Guest\HomeController@index')->name('homeindex');

Route::get('/phim/dang-chieu', 'App\Http\Controllers\Guest\HomeController@movieshowing')->name('phimdangchieu');
Route::get('/phim/sap-chieu', 'App\Http\Controllers\Guest\HomeController@movieupcoming')->name('phimsapchieu');
Route::get('/dat-ve/{maPhim}', 'App\Http\Controllers\Guest\HomeController@index')->name('datve');

/*Thông tin*/
Route::get('/gioithieu', 'App\Http\Controllers\Guest\InformationController@showAbout')->name('gioithieu');
Route::get('/tochucsukien', 'App\Http\Controllers\Guest\InformationController@showEventorganization')->name('tochucsukien');
Route::get('/giaitri', 'App\Http\Controllers\Guest\InformationController@showEntertaiment')->name('giaitri');
Route::get('/khuyenmai', 'App\Http\Controllers\Guest\InformationController@showPromotion')->name('khuyenmai');
/* hết thông tin*/

Route::get('/phim/{maPhim}', 'App\Http\Controllers\Guest\FilmController@show')->name("phim");
Route::get('/lich-chieu/{maPhim}', 'App\Http\Controllers\Guest\BookingticketController@showLichChieu')->name('lich-chieu');
Route::get('/dat-ghe/{maLichChieuPhim}', 'App\Http\Controllers\Guest\BookingticketController@showPhongChieu')->name('dat-ghe');
/*Ham sử dụng*/
Route::get('/get-ngay-chieu/{maPhim}', 'App\Http\Controllers\Guest\HomeController@getNgayChieu');
Route::get('/get-suat-chieu/{maPhim}/{ngayChieu}', 'App\Http\Controllers\Guest\HomeController@getSuatChieu');
Route::get('/get-ma-lich-chieu-phim','App\Http\Controllers\Guest\HomeController@getMaLichChieuPhim');


Route::get('/get-booked-seats', 'App\Http\Controllers\Guest\BookingTicketController@getBookedSeats')->name('bookedseats');
Route::POST('/update-cart', 'App\Http\Controllers\Guest\BookingTicketController@updatecart')->name('update.cart');
Route::get('/payment', 'App\Http\Controllers\Guest\BookingTicketController@bookTicket')->name('payment');
Route::get('/transhistory', 'App\Http\Controllers\Guest\TransHistoryController@showall')->name('transhistory');
Route::get('/transtable', 'App\Http\Controllers\Guest\TransHistoryController@get_table')->name('get.trans.table');
Route::get('/ticket.detail/{maDonHang}', 'App\Http\Controllers\Guest\TransHistoryController@showticket')->name('ticket.detail');
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/auth', 'App\Http\Controllers\Guest\AuthController@viewauth')->name('auth');;

// Trả về nội dung form đăng nhập
Route::get('/auth/login', function () {
    return view('auth.Guest.login_content');
})->name('authlogin');;

// Trả về nội dung form đăng ký
Route::get('/auth/register', function () {
    return view('auth.Guest.register_content');
})->name('authregister');;
Route::get('/login', function () {
    abort(404); 
})->name('login');

/*Xác thực email*/
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/homeindex');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Liên kết xác thực đã được gửi!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
/*----*/


Route::post('/vnpay/payment','App\Http\Controllers\VNPayController@createPayment')->name('vnpay.payment');
Route::get('/vnpay/callback', 'App\Http\Controllers\VNPayController@paymentCallback')->name('vnpay.callback');



Route::post('/momo/payment', [MoMoController::class, 'createPayment'])->name('momo.payment');
Route::get('/momo/callback', [MoMoController::class, 'paymentCallback'])->name('momo.callback');

Route::post('/paypal/payment', [PayPalController::class, 'createPayment'])->name('paypal.payment');
Route::get('/paypal/success', [PayPalController::class, 'successPayment'])->name('paypal.success');
Route::get('/paypal/cancel', [PayPalController::class, 'cancelPayment'])->name('paypal.cancel');

Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');

require __DIR__.'/auth.php';
/*--Guest---*/