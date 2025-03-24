<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class FilmListController extends Controller
{ 
    public function viewfilmlist() {
        $movies = DB::table('phim')
            ->join('phim_loaiPhim', 'phim.maPhim', '=', 'phim_loaiPhim.maPhim')
            ->join('LoaiPhim', 'phim_loaiPhim.maLoaiPhim', '=', 'LoaiPhim.maLoaiPhim')
            ->join('quocgia', 'phim.maQuocGia', '=', 'quocgia.maQuocGia') // Thêm join bảng quốc gia
            ->select('phim.*', 'LoaiPhim.tenLoaiPhim', 'quocgia.tenQuocGia') // Chọn thêm tenQuocGia
            ->get();
    
        return view('admin.filmlist', compact('movies'));
    }
  public function destroy(Request $request)
  {
      $maphim=$request->maPhim;
      $movie = DB::table('phim')->where('maPhim',$maphim)->get();

      if (!$movie) {
          return response()->json(['success' => false, 'message' => 'Phim không tồn tại']);
      }

      $movie->delete();

      return response()->json(['success' => true, 'message' => 'Xóa phim thành công']);
  }
}