<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;

class RoleController extends Controller
{ 
    public function viewRole()
    {
        $employees = User::where('role', 1)->get();
        return view('admin.quanlyphanquyen.role', compact('employees'));
    }

    public function getPermissions($employeeId)
    {
        // Lấy danh sách các chức năng mà nhân viên này có
        $permissions = DB::table('nhanvien_chucnang')
            ->join('chucnang', 'nhanvien_chucnang.maChucNang', '=', 'chucnang.maChucNang')
            ->where('nhanvien_chucnang.maNV', $employeeId)
            ->select('chucnang.*')->orderBy('chucnang.maChucNang', 'asc')
            ->get();

        return response()->json($permissions);
    }

    public function addPermission(Request $request)
    {
        $request->validate([
            'maNV' => 'required|exists:users,id',
            'maChucNang' => 'required|exists:chucnang,maChucNang'
        ]);

        // Kiểm tra xem nhân viên đã có quyền này chưa
        $exists = DB::table('nhanvien_chucnang')
            ->where('maNV', $request->maNV)
            ->where('maChucNang', $request->maChucNang)
            ->exists();

        if (!$exists) {
            DB::table('nhanvien_chucnang')->insert([
                'maNV' => $request->maNV,
                'maChucNang' => $request->maChucNang
            ]);

            return back()->with('success', 'Phân quyền thành công!');
        }

        return back()->with('error', 'Nhân viên đã có quyền này!');
    }
    public function getAvailableFunctions($employeeId)
    {
        // Lấy danh sách ID các chức năng mà nhân viên đã có
        $assignedFunctions = DB::table('nhanvien_chucnang')
            ->where('maNV', $employeeId)
            ->pluck('maChucNang')
            ->toArray();

        // Lấy danh sách chức năng mà nhân viên chưa có
        $availableFunctions = DB::table('chucnang')
        ->whereNotIn('maChucNang', $assignedFunctions)
        ->orderBy('maChucNang', 'asc') // Sắp xếp tăng dần
        ->get();

        return response()->json($availableFunctions);
    }
    public function destroy($maNV, $maChucNang)
{
    DB::table('nhanvien_chucnang')->where([
        ['maNV', '=', $maNV],
        ['maChucNang', '=', $maChucNang]
    ])->delete();

    return response()->json(['message' => 'Xóa quyền thành công'], 200);
}
}