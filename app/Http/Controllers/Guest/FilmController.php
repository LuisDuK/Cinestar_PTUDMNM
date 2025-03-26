<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class FilmController extends Controller
{ 
    public function show($maPhim)
    {
            // Lấy thông tin phim
            $movie = DB::table('phim')
                ->leftJoin('phim_loaiphim', 'phim.maPhim', '=', 'phim_loaiphim.maPhim')
                ->leftJoin('loaiphim', 'phim_loaiphim.maLoaiPhim', '=', 'loaiphim.maLoaiPhim')
                ->leftJoin('quocgia', 'phim.maQuocGia', '=', 'quocgia.maQuocGia')
                ->where('phim.maPhim', $maPhim)
                ->select(
                    'phim.*',
                    DB::raw('GROUP_CONCAT(loaiphim.tenLoaiPhim SEPARATOR ", ") AS tenLoaiPhim'),
                    'quocgia.tenQuocGia'
                )
                ->groupBy('phim.maPhim')
                ->first();
    
            if (!$movie) {
                return view('movies.not_found'); // Trang báo lỗi nếu không tìm thấy phim
            }
    
            // Lấy danh sách lịch chiếu của phim
            $lichChieu = DB::table('lichchieuphim')
                ->where('maPhim', $maPhim)
                ->whereRaw("CONCAT(ngayChieu, ' ', suatChieu) > NOW()")
                ->select('maLichChieuPhim', 'suatChieu')
                ->get();
            $phimDangChieu = DB::table("Phim")->where('trangThai', 'Đang chiếu')->get();
            return view('guest.movies_detail', compact('movie', 'lichChieu','phimDangChieu'));
    }
}