<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{ 
  public function viewdash(){
    $totalNV = DB::table('users')->where('role', 1)->count();

    $totalKH = DB::table('users')->where('role', 0)->count();

    // Tổng doanh thu (giá vé bán)
    $totalRevenue = DB::table('donhangonline')
        ->where('trangThai', 'Đã hoàn tất')
        ->sum('tongTien');

    // Số suất chiếu trong ngày
    $totalSuatChieu = DB::table('lichchieuphim')
        ->whereDate('ngayChieu', today())
        ->count();

    // Truy vấn dữ liệu biểu đồ doanh thu
    $revenueData = DB::table('chitietdatve')
        ->select(DB::raw("DATE(ngay_phat_hanh) as ngay"), DB::raw("SUM(so_tien) as doanhThu"))
        ->groupBy(DB::raw("DATE(ngay_phat_hanh)"))
        ->get();

    $revenueLabels = $revenueData->pluck('ngay');
    $revenueValues = $revenueData->pluck('doanhThu');

    return view('admin.dashboard', compact(
        'totalNV', 'totalKH', 'totalRevenue', 'totalSuatChieu', 'revenueLabels', 'revenueValues'
    ));
  }
}