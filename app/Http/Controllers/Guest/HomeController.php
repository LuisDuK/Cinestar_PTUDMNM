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
    public function search(Request $request)
    {
        $query = $request->query('q');

        $results = DB::table("Phim")->where('ten', 'like', "%$query%")->get();

        return view('search.results', compact('results', 'query'));
    }
    public function suggest(Request $request)
    {
        $keyword = $request->query('keyword');
    
        $movies = DB::table("Phim")->where('ten', 'like', '%' . $keyword . '%')
                      ->limit(5)
                      ->get(['maPhim', 'ten']); // Trả về id + tên
    
        return response()->json($movies);
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
    
        // Truy vấn luôn mã lịch chiếu phim
        $suatChieu = DB::table('lichchieuphim')
            ->where('maPhim', $maPhim)
            ->where('ngayChieu', $ngayChieu)
            ->whereRaw("CONCAT(ngayChieu, ' ', suatChieu) > NOW()")
            ->select('suatChieu', 'loaiChieu', 'maLichChieuPhim')
            ->get();
    
        return response()->json($suatChieu);
    }    
 
}