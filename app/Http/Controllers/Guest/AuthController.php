<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{ 
  public function viewauth(){
    $phimDangChieu = DB::table("Phim")->where('trangThai', 'Đang chiếu')->get();
    return view('auth.guest.auth',compact('phimDangChieu'));
  }
  public function index()
  {
      $user = Auth::user();
      return view('guest.profile.profile', compact('user'));
  }


  public function changePassword(Request $request)
  {
      $request->validate([
          'current_password' => 'required',
          'new_password' => 'required|min:6',
          'confirm_password' => 'required|same:new_password',
      ]);
  
      $user = Auth::user();
  
      if (!$user) {
          return back()->with('error', 'Không tìm thấy người dùng');
      }
  
      // Kiểm tra mật khẩu hiện tại
      if (!Hash::check($request->current_password, $user->password)) {
          return back()->with('error', 'Mật khẩu hiện tại không đúng');
      }
  
      // Cập nhật mật khẩu mới
      DB::table('users')
          ->where('id', $user->id)
          ->update([
              'password' => Hash::make($request->new_password),
              'updated_at' => now(),
          ]);
  
      return back()->with('success', 'Đổi mật khẩu thành công');
  }
 
  public function update(Request $request)
  {
      $request->validate([
          'name' => 'required|string|max:255',
          'email' => 'required|email|unique:users,email,' . Auth::id(),
          'phone' => 'nullable|string|max:15',
      ]);
  
      DB::table('users')
          ->where('id', Auth::id()) // Lấy đúng user đang đăng nhập
          ->update([
              'name' => $request->name,
              'email' => $request->email,
              'phone' => $request->phone,
              'updated_at' => now(), // Cập nhật thời gian sửa đổi
          ]);
  
      return back()->with('success', 'Cập nhật thông tin thành công');
  }
  
  

}  