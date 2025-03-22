<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{ 
  public function viewauth(){
    $phimDangChieu = DB::table("Phim")->where('trangThai', 'Đang chiếu')->get();
    return view('auth.auth',compact('phimDangChieu'));
  }
}