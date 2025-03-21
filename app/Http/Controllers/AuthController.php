<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{ 
  public function viewauth(){
    $phimDangChieu = DB::table("Phim")->where('trangThai', 'Đang chiếu')->get();
    return view('auth.auth',compact('phimDangChieu'));
  }
}