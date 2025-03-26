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
    if(Auth::attempt(['email'=>$request->email, 'password'=> $request->password, 'role'=>1])){
      return redirect()->route('admin.dashboard');
    }
    return redirect()->back()->with ('err','Sai thông tin');
  }
  public function signOut(){
    Auth::logout();
    return redirect()->route('admin.login');
  }
}