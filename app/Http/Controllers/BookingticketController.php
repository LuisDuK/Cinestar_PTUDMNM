<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BookingTicketController extends Controller
{ 
    public function showLichChieu($maPhim)
    {
        $tenphim = DB::table("phim")
        ->whereRaw("maPhim = ?", [$maPhim])
        ->first();
        // Lấy danh sách ngày chiếu khác nhau (chỉ lấy ngày có suất chiếu trong tương lai)
        $ngayChieus = DB::table("lichchieuphim")->where('maPhim', $maPhim)
            ->whereRaw("CONCAT(ngayChieu, ' ', gioBatDau) > NOW()")
            ->select('ngayChieu')
            ->distinct()
            ->get();

        // Lấy danh sách phòng chiếu theo từng ngày chiếu
        $phongChieuTheoNgay = [];
        foreach ($ngayChieus as $ngayChieu) {
            $phongChieuTheoNgay[$ngayChieu->ngayChieu] = DB::table("lichchieuphim")->where('maPhim', $maPhim)
                ->where('ngayChieu', $ngayChieu->ngayChieu)
                ->whereRaw("CONCAT(ngayChieu, ' ', gioBatDau) > NOW()")
                ->select('maPhongChieuPhim')
                ->distinct()
                ->get();
        }

        // Lấy danh sách suất chiếu theo từng phòng
        $lichChieuTheoPhong = [];
        foreach ($phongChieuTheoNgay as $ngayChieu => $phongChieus) {
            foreach ($phongChieus as $phong) {
                $lichChieuTheoPhong[$ngayChieu][$phong->maPhongChieuPhim] = DB::table("lichchieuphim")->where('maPhim', $maPhim)
                    ->where('maPhongChieuPhim', $phong->maPhongChieuPhim)
                    ->where('ngayChieu', $ngayChieu)
                    ->whereRaw("CONCAT(ngayChieu, ' ', gioBatDau) > NOW()")
                    ->get();
            }
        }
        $phimDangChieu = DB::table("Phim")->where('trangThai', 'Đang chiếu')->get();
        return view('guest.booking.select_time', compact('tenphim','maPhim', 'ngayChieus', 'phongChieuTheoNgay', 'lichChieuTheoPhong', 'phimDangChieu'));
    }
    public function showPhongChieu($maLichChieuPhim){

        // Truy vấn dữ liệu từ database
        $seats = DB::table('ghe')
            ->join('phongchieuphim', 'phongchieuphim.maPhongChieu', '=', 'ghe.maPhongChieu')
            ->join('lichchieuphim', 'lichchieuphim.maPhongChieuPhim', '=', 'phongchieuphim.maPhongChieu')
            ->where('lichchieuphim.maLichChieuPhim', $maLichChieuPhim)
            ->select('ghe.maGhe', 'ghe.soGhe', 'ghe.trangThai', 'ghe.soHang')
            ->get();
            $movie = DB::table('phim')
            ->join('lichchieuphim', 'lichchieuphim.maphim', '=', 'phim.maphim')
            ->where('lichchieuphim.maLichChieuPhim', $maLichChieuPhim)
            ->select(
                'phim.ten AS movie_title',
                'phim.hinhAnh AS movie_image',
                'lichchieuphim.ngayChieu AS showtime_date',
                'lichchieuphim.gioBatDau AS start_time',
                'lichchieuphim.loaiHinhChieu AS show_type',
                'lichchieuphim.giave AS ticket_price'
            )
            ->first();

        // Lấy thông tin người dùng từ session (nếu đã đăng nhập)
        $user = Auth::user();

        return view('guest.booking.select_chair', compact('seats','movie', 'user'));
    }
}