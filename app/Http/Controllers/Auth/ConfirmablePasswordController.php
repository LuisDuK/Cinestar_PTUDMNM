<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;



class ConfirmablePasswordController extends Controller
{
    /**
     * Show the confirm password view.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('auth.confirm-password');
    }

    /**
     * Confirm the user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $credentials = $request->only('email', 'password');

    if (!Auth::attempt($credentials)) {
        throw ValidationException::withMessages([
            'email' => __('auth.failed'), // Thông báo lỗi nếu đăng nhập thất bại
        ]);
    }

    // Lấy thông tin người dùng đã đăng nhập
    $user = Auth::user();

    // Lưu thời gian xác nhận mật khẩu
    $request->session()->put('auth.password_confirmed_at', time());

    // Kiểm tra account_type và điều hướng
    if ($user->account_type == 0) {
        return redirect()->route('homeindex'); // Khách hàng
    } elseif ($user->account_type == 1) {
        return redirect()->route('admin.dashboard'); // Nhân viên / Admin
    }

    // Nếu không xác định được loại tài khoản, quay về mặc định
    return redirect()->intended(RouteServiceProvider::HOME);
}
}