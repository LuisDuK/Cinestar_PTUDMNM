<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //dd(Auth::check(), Auth::user(), session()->all()); 
       // dd(Auth::check(), Auth::user());
        // Kiểm tra nếu chưa đăng nhập
        if (!Auth::check() || Auth::user()->role != 1) {
            Auth::logout();
            return redirect('/admin/login');
        }

        return $next($request);
    }
}