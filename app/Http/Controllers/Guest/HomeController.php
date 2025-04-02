<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{ 
    public function index() {
        $phimDangChieu = DB::table("Phim")->where('trangThai', 'Đang chiếu')->get();
        $phimSapChieu = DB::table("Phim")->where('trangThai', 'Sắp chiếu')->get();
        return view('guest.home', compact('phimDangChieu', 'phimSapChieu'));
    }
    public function movieshowing(){
        $phimDangChieu = DB::table("Phim")->where('trangThai', 'Đang chiếu')->get();
        return view('guest.movies_showing', compact('phimDangChieu'));
    }
    public function movieupcoming(){
        $phimSapChieu = DB::table("Phim")->where('trangThai', 'Sắp chiếu')->get();
        return view('guest.movies_upcoming', compact('phimSapChieu'));
    }
    public function getNgayChieu($maPhim)
    {
        if (!$maPhim) {
            return response()->json([]);
        }

        // Truy vấn danh sách ngày chiếu từ bảng `lichchieuphim`
        $ngayChieu = DB::table('lichchieuphim')
            ->where('maPhim', $maPhim)
            ->whereRaw("CONCAT(ngayChieu, ' ', suatChieu) > NOW()") // Điều kiện giống PHP cũ
            ->distinct()
            ->pluck('ngayChieu');

        return response()->json($ngayChieu);
    }
    public function getSuatChieu($maPhim, $ngayChieu)
    {
        if (!$maPhim || !$ngayChieu) {
            return response()->json([]);
        }

        // Truy vấn danh sách suất chiếu từ bảng `lichchieuphim`
        $suatChieu = DB::table('lichchieuphim')
            ->where('maPhim', $maPhim)
            ->where('ngayChieu', $ngayChieu)
            ->whereRaw("CONCAT(ngayChieu, ' ', suatChieu) > NOW()")
            ->select('suatChieu', 'loaiChieu')
            ->distinct()
            ->get();

        return response()->json($suatChieu);
    }
    public function getMaLichChieuPhim(Request $request)
    {
        $maPhim = $request->query('maPhim');
        $ngayChieu = $request->query('ngayChieu');
        $gioBatDau = $request->query('gioBatDau');
      
        if (!$maPhim || !$ngayChieu || !$gioBatDau) {
            return response()->json(['error' => 'Thiếu dữ liệu'], 400);
        }
    
        $maLichChieuPhim = DB::table('lichchieuphim')
            ->where('maPhim', $maPhim)
            ->where('ngayChieu', $ngayChieu)
            ->where('suatChieu', $gioBatDau)
            ->value('maLichChieuPhim');
    
        if ($maLichChieuPhim) {
            return response()->json(['maLichChieuPhim' => $maLichChieuPhim]);
        } else {
            return response()->json(['error' => 'Không tìm thấy lịch chiếu'], 404);
        }
    }
}