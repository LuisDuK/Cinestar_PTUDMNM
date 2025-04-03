<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.baocao.report');
    }

    public function getData(Request $request) {
        $month = $request->query('month');
        $movieId = $request->query('movie');
    
        // Tạo query chung
        $queryRevenueByDay = DB::table('chitietdatve')
            ->join('lichchieuphim', 'chitietdatve.id_lich_chieu', '=', 'lichchieuphim.maLichChieuPhim')
            ->select(DB::raw('DATE(ngayChieu) as day, SUM(so_tien) as revenue'))
            ->whereMonth('ngayChieu', date('m', strtotime($month)))
            ->whereYear('ngayChieu', date('Y', strtotime($month)))
            ->groupBy('day');
    
        $queryRevenueByMovie = DB::table('chitietdatve')
            ->join('lichchieuphim', 'chitietdatve.id_lich_chieu', '=', 'lichchieuphim.maLichChieuPhim')
            ->join('phim', 'lichchieuphim.maPhim', '=', 'phim.maPhim')
            ->select('phim.ten as movie', DB::raw('SUM(so_tien) as revenue'))
            ->whereMonth('ngayChieu', date('m', strtotime($month)))
            ->whereYear('ngayChieu', date('Y', strtotime($month)))
            ->groupBy('movie');
    
        $queryRevenueByHour = DB::table('chitietdatve')
            ->join('lichchieuphim', 'chitietdatve.id_lich_chieu', '=', 'lichchieuphim.maLichChieuPhim')
            ->select(DB::raw('suatChieu, SUM(so_tien) as revenue'))
            ->whereMonth('ngayChieu', date('m', strtotime($month)))
            ->whereYear('ngayChieu', date('Y', strtotime($month)))
            ->groupBy('suatChieu');
    
        // Nếu có movieId, lọc theo phim
        if ($movieId) {
            $queryRevenueByDay->where('lichchieuphim.maPhim', $movieId);
            $queryRevenueByMovie->where('lichchieuphim.maPhim', $movieId);
            $queryRevenueByHour->where('lichchieuphim.maPhim', $movieId);
        }
    
        $revenueByDay = $queryRevenueByDay->get();
        $revenueByMovie = $queryRevenueByMovie->get();
        $revenueByHour = $queryRevenueByHour->get();
    
      
    
        return response()->json([
            'revenueByDay' => $revenueByDay,
            'revenueByMovie' => $revenueByMovie,
            'revenueByHour' => $revenueByHour,
        ]);
    }
    
    
    public function getMovies() {
        $movies = DB::table('phim')->select('maPhim as id', 'ten as name')->get();
       // dd($movies);
        return response()->json($movies);
    }
    
}