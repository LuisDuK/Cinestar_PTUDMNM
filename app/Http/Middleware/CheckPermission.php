<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $permissionId)
    {
        $userId = Auth::id(); // Lấy ID nhân viên đang đăng nhập

        // Kiểm tra xem nhân viên có quyền này không
        $hasPermission = DB::table('nhanvien_chucnang')
            ->where('maNV', $userId)
            ->where('maChucNang', $permissionId)
            ->exists();

        if (!$hasPermission) {
            return abort(403, 'Bạn không có quyền truy cập chức năng này.');
        }

        return $next($request);
    }
}