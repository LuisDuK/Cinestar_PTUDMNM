<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        //return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
{
    $request->authenticate();
    $request->session()->regenerate();

    $user = Auth::user(); // Lấy thông tin người dùng

    // Chuyển hướng dựa trên account_type
    if ($user->account_type == 0) {
        return redirect()->intended('/homeindex');
    } elseif ($user->account_type == 1) {
        return redirect()->intended('/adminhome');
    }

    // Mặc định nếu không có điều kiện nào khớp
    return redirect()->intended('/');
}


    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $user = Auth::user(); // Lấy thông tin user trước khi đăng xuất
        $redirectRoute = '/'; // Mặc định về trang chủ
    
        if ($user) {
            if ($user->account_type == 0) {
                $redirectRoute = '/auth'; // Người dùng thường về trang đăng nhập
            } elseif ($user->account_type == 1) {
                $redirectRoute = '/adminlogin'; // Quản trị viên về trang đăng nhập admin
            }
        }
    
        Auth::guard('web')->logout();
    
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect($redirectRoute);
    }
    
}