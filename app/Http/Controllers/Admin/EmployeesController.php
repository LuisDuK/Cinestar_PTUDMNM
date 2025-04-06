<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class EmployeesController extends Controller
{ 
     public function viewEmployees(){
        $employees = DB::select("SELECT * FROM users where role =1" );
        return view('admin.quanlynhansu.employeelist', compact('employees'));
     }
     public function store(Request $request)
     {
         // Kiểm tra dữ liệu đầu vào
         $request->validate([
             'hoTen' => 'required|string|max:191',
             'ngaySinh' => 'required|date',
             'gioiTinh' => 'required|in:Nam,Nữ,Khác',
             'email' => 'required|email|unique:users,email',
             'soDienThoai' => 'required|string|max:20',
             'diaChi' => 'required|string',
             'hinhAnh' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
             'trangThai' => 'required|in:Hoạt động,Khóa'
         ]);
     
         try {
             // Chuyển đổi giới tính
             $genderMap = [
                 'Nam' => 'male',
                 'Nữ' => 'female',
                 'Khác' => 'other'
             ];
     
             // Dữ liệu ban đầu cần insert vào bảng users (không có avatar)
             $userData = [
                 'name' => $request->hoTen,
                 'email' => $request->email,
                 'password' => Hash::make('password123'), // Mật khẩu mặc định
                 'gender' => $genderMap[$request->gioiTinh],
                 'address' => $request->diaChi,
                 'phone' => $request->soDienThoai,
                 'status' => $request->trangThai == 'Hoạt động' ? 1 : 0,
                 'role' => 1, // Giá trị role mặc định là 1 (Admin)
                 'created_at' => now(),
                 'updated_at' => now(),
             ];
     
             // Insert vào bảng users và lấy ID của người dùng vừa insert
             $userId = DB::table('users')->insertGetId($userData);
     
             // Xử lý file ảnh (nếu có) và cập nhật avatar
             $avatar = null;
             if ($request->hasFile('hinhAnh')) {
                 // Tạo tên file bằng cách sử dụng ID người dùng và phần mở rộng của hình ảnh
                 $fileName = $userId . '.' . $request->file('hinhAnh')->extension();
                 
                 // Lưu file vào thư mục 'storage/app/public/profile'
                 $request->file('hinhAnh')->storeAs('public/profile', $fileName);
     
                 // Cập nhật avatar vào bảng users
                 $avatar = $fileName;
                 DB::table('users')->where('id', $userId)->update(['avatar' => $avatar]);
             }
     
             // Thông báo thành công
             return redirect()->back()->with('success', 'Thêm nhân sự thành công');
         } catch (\Exception $e) {
             // Nếu có lỗi, bạn có thể xử lý lỗi hoặc thông báo khác
             session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại.');
             return back();
         }
     }

     public function update(Request $request, $id)
     {
         $employee = User::findOrFail($id);
     
         $avatar = $employee->avatar;
         if ($request->hasFile('avatar')) {
            if ($employee->avatar && File::exists(public_path('storage/profile/' . $employee->avatar))) {
                File::delete(public_path('storage/profile/' . $employee->avatar));
            }
            $fileName = $id . '.' . $request->file('avatar')->extension();
        
            $request->file('avatar')->storeAs('public/profile', $fileName);
            $employee->avatar = $fileName;
         }
     
         $employee->name = $request->name;
         $employee->gender = $request->gender;
         $employee->address = $request->address;
         $employee->phone = $request->phone;
         $employee->email = $request->email;
         $employee->status = $request->status;  
     
         // Cập nhật trực tiếp
         $employee->save(); 
     
         return redirect()->back()->with('success', 'Cập nhật thông tin nhân viên thành công');
     }
     public function changePassword(Request $request, $id)
     {
         try {
           // dd($request->all());
             $request->validate([
                 'new_password' => 'required|min:6|confirmed',
             ]);
         
             $employee = User::findOrFail($id);
         
             $employee->password = Hash::make($request->new_password);
         
             $employee->save();
         
             return redirect()->back()->with('success', 'Mật khẩu đã được thay đổi thành công');
         } catch (\Exception $e) {
             // Bắt lỗi và hiển thị thông báo lỗi
             return redirect()->back()->with('error', 'Đã xảy ra lỗi khi thay đổi mật khẩu. Vui lòng thử lại sau.');
         }
     }
     
     
}