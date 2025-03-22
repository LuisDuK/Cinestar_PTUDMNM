<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{ 
    public function index() {
        $phimDangChieu = DB::table("Phim")->where('trangThai', 'Đang chiếu')->limit(3)->get();
        $phimSapChieu = DB::table("Phim")->where('trangThai', 'Sắp chiếu')->limit(3)->get();
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
            ->whereRaw("CONCAT(ngayChieu, ' ', gioBatDau) > NOW()") // Điều kiện giống PHP cũ
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
            ->whereRaw("CONCAT(ngayChieu, ' ', gioBatDau) > NOW()")
            ->select('gioBatDau', 'loaiHinhChieu')
            ->distinct()
            ->get();

        return response()->json($suatChieu);
    }
    public function getMaLichChieuPhim($maPhim, $ngayChieu, $gioBatDau)
    {
        // Truy vấn database để lấy maLichChieuPhim
        $maLichChieuPhim = DB::table('lichchieuphim')
            ->where('maPhim', $maPhim)
            ->where('ngayChieu', $ngayChieu)
            ->where('gioBatDau', $gioBatDau)
            ->value('maLichChieuPhim');

        if ($maLichChieuPhim) {
            return response()->json(['maLichChieuPhim' => $maLichChieuPhim]);
        } else {
            return response()->json(['error' => 'Không tìm thấy lịch chiếu'], 404);
        }
    }
}