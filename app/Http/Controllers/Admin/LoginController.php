<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{ 
  public function viewauth(){
    
    return view('admin.index');
  }
  public function postLogon(Request $request){

    if (Auth::check()) {
      Auth::logout();
      session()->invalidate(); 
      session()->regenerateToken(); 
  }

    if(Auth::attempt(['email'=>$request->email, 'password'=> $request->password, 'role'=>1])){
      $user = Auth::user();
      session(['auth_role' => $user->role]);
      return redirect()->route('admin.dashboard');
    }
    return redirect()->back()->withErrors(['loginError' => 'Sai thông tin đăng nhập hoặc không có quyền truy cập.']);
  }
  public function signOut(){
    session()->forget('auth_role');
    Auth::logout();
    return redirect()->route('admin.login');
  }
}