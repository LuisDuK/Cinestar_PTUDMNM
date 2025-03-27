<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\MoMoController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\ScheduleController;


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
Route::get('/payment', 'App\Http\Controllers\Guest\BookingTicketController@bookTicket')->middleware('checkguest')->name('payment');
Route::get('/transhistory', 'App\Http\Controllers\Guest\TransHistoryController@showall')->middleware('checkguest')->name('transhistory');
Route::get('/ticket-detail/{maDonHang}', 'App\Http\Controllers\Guest\TransHistoryController@showticket')->middleware('checkguest')->name('ticket.detail');

Route::get('/account/profile', 'App\Http\Controllers\Guest\AuthController@index')->middleware('checkguest')->name('account.profile');
Route::post('/account/profile/change-password',  'App\Http\Controllers\Guest\AuthController@index')->middleware('checkguest')->name('account.change-password');
Route::post('/account/update', 'App\Http\Controllers\Guest\AuthController@update')->middleware('checkguest')->name('account.update');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('checkguest')->name('dashboard');

Route::get('/auth', 'App\Http\Controllers\Guest\AuthController@viewauth')->name('auth');;

Route::get('/auth/login', function () {
    return view('auth.Guest.login_content');
})->name('authlogin');;

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
/*----endGuest---*/
/*admin*/
Route::get('/admin/login', 'App\Http\Controllers\Admin\LoginController@viewauth')->name('admin.login');
Route::POST('admin/logon','App\Http\Controllers\Admin\LoginController@postLogon')->name('admin.logon');
Route::POST('admin/logout','App\Http\Controllers\Admin\LoginController@signOut')->name('admin.logout');
Route::get('/admin/dashboard', 'App\Http\Controllers\Admin\DashboardController@viewdash')->middleware([ 'admin'])->name('admin.dashboard');


Route::get('/admin/quanlyphim', 'App\Http\Controllers\Admin\FilmlistController@viewfilmlist')->middleware(['admin', 'check.permission:1'])->name('quanly.phim');
Route::get('/admin/quanlyphim/create', 'App\Http\Controllers\Admin\FilmlistController@create')->middleware(['admin', 'check.permission:1'])->name('quanlyphim.create');
Route::post('/admin/quanlyphim/store', 'App\Http\Controllers\Admin\FilmlistController@store')->middleware(['admin', 'check.permission:1'])->name('quanlyphim.store');
Route::delete('/admin/quanlyphim/destroy', 'App\Http\Controllers\Admin\FilmlistController@destroy')->middleware(['admin', 'check.permission:1'])->name('quanlyphim.destroy');
Route::get('/admin/quanlyphim/edit/{id}', 'App\Http\Controllers\Admin\FilmlistController@edit')->middleware(['admin', 'check.permission:1'])->name('quanlyphim.edit');
Route::post('/admin/quanlyphim/update/{id}', 'App\Http\Controllers\Admin\FilmlistController@update')->middleware(['admin', 'check.permission:1'])->name('quanlyphim.update');

Route::get('/admin/quanlylichchieu', 'App\Http\Controllers\Admin\ScheduleController@viewSchedule')->middleware(['admin', 'check.permission:3'])->name('quanly.lichchieu');
Route::get('/admin/quanlylichchieu/data', 'App\Http\Controllers\Admin\ScheduleController@getData')->middleware(['admin', 'check.permission:3'])->name('quanlylichchieu.data');
Route::delete('/admin/quanlylichchieu/delete', 'App\Http\Controllers\Admin\ScheduleController@delete')->middleware(['admin', 'check.permission:3'])->name('quanlylichchieu.destroy');
Route::get('/admin/quanlylichchieu/create', 'App\Http\Controllers\Admin\ScheduleController@showForm')->middleware(['admin', 'check.permission:3'])->name('quanlylichchieu.showForm');
Route::get('/admin/quanlylichchieu/loadSchedule', 'App\Http\Controllers\Admin\ScheduleController@loadSchedule')->middleware(['admin', 'check.permission:3'])->name('quanlylichchieu.loadSchedule');
Route::post('/admin/quanlylichchieu/create', 'App\Http\Controllers\Admin\ScheduleController@handleSubmit')->middleware(['admin', 'check.permission:3'])->name('quanlylichchieu.handleSubmit');
Route::post('/admin/quanlylichchieu/save', 'App\Http\Controllers\Admin\ScheduleController@saveSchedule')->middleware(['admin', 'check.permission:3'])->name('quanlylichchieu.saveSchedule');
Route::get('/admin/quanlylichchieu/edit/{maLichChieu}', 'App\Http\Controllers\Admin\ScheduleController@showFormEdit')->middleware(['admin', 'check.permission:3'])->name('quanlylichchieu.edit');

Route::get('/admin/quanlynhansu', 'App\Http\Controllers\Admin\EmployeesController@viewEmployees')->middleware(['admin', 'check.permission:7'])->name('quanly.nhansu');
Route::POST('/admin/quanlynhansu/save', 'App\Http\Controllers\Admin\EmployeesController@store')->middleware(['admin', 'check.permission:7'])->name('quanlynhansu.save');
Route::POST('/admin/quanlynhansu/change-password/{id}', 'App\Http\Controllers\Admin\EmployeesController@changePassword')->middleware(['admin', 'check.permission:7'])->name('quanlynhansu.change-password');
Route::POST('/admin/quanlynhansu/update/{id}', 'App\Http\Controllers\Admin\EmployeesController@update')->middleware(['admin', 'check.permission:7'])->name('quanlynhansu.update');

Route::get('/admin/profile', 'App\Http\Controllers\Admin\ProfileController@viewProfile')->middleware(['admin'])->name('admin.profile');
Route::post('/admin/profile/updateavatar/{id}', 'App\Http\Controllers\Admin\ProfileController@updateAvatar')->middleware(['admin'])->name('profile.updateAvatar');

Route::get('/admin/quanlyphanquyen/chucnang', 'App\Http\Controllers\Admin\RoleController@viewRole')->middleware(['admin', 'check.permission:6'])->name('quanly.phanquyen.chucnang');
Route::get('/admin/quanlyphanquyen/{employeeID}', 'App\Http\Controllers\Admin\RoleController@getPermissions')->middleware(['admin', 'check.permission:7']);
Route::get('/admin/quanlyphanquyen/quyencanhan/{employeeID}', 'App\Http\Controllers\Admin\RoleController@getAvailableFunctions')->middleware(['admin', 'check.permission:7']);
Route::post('/admin/quanlyphanquyen/assign', 'App\Http\Controllers\Admin\RoleController@addPermission')->middleware(['admin', 'check.permission:7'])->name('quanlyphanquyen.assign');
Route::delete('/admin/quanlyphanquyen/quyencanhan/xoa/{employeeID}/{permessionId}', 'App\Http\Controllers\Admin\RoleController@destroy')->middleware(['admin', 'check.permission:7']);


Route::middleware(['auth', 'check.permission:2'])->group(function () {
    Route::get('/admin/phongchieu', 'App\Http\Controllers\Admin\RoomController@viewRoomList')->name('quanly.phongchieu');
    Route::post('/admin/phongchieu', 'App\Http\Controllers\Admin\RoomController@store')->name('quanlyphongchieu.store');
    Route::put('/admin/phongchieu/{id}', 'App\Http\Controllers\Admin\RoomController@update')->name('quanlyphongchieu.update');
    Route::delete('/admin/phongchieu/{id}', 'App\Http\Controllers\Admin\RoomController@destroy')->name('quanlyphongchieu.destroy');
});
/*----endAdmin----*/