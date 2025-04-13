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
        ->join('quocgia', 'phim.maQuocGia', '=', 'quocgia.maQuocGia')
        ->select(
            'phim.maPhim',
            'phim.ten',
            'phim.thoiLuong',
            'phim.tenDaoDien',
            'phim.moTa',
            'phim.hinhAnh',
            'phim.trangThai',
            'phim.namSanXuat',
            'phim.trailer',
            'phim.soLuongSuatChieu',
            'quocgia.tenQuocGia',
            DB::raw('GROUP_CONCAT(LoaiPhim.tenLoaiPhim SEPARATOR ", ") as tentheLoai')
        )
        ->groupBy('phim.maPhim', 'phim.ten', 'phim.thoiLuong', 'phim.tenDaoDien', 'phim.moTa', 'phim.hinhAnh', 'phim.trangThai', 'phim.namSanXuat', 'quocgia.tenQuocGia')
        ->get();
    
    
        return view('admin.quanlyphim.filmlist', compact('movies'));
    }
    public function destroy(Request $request)
    {
        $maPhim = $request->input('maPhim'); 
    
        // Kiểm tra phim có tồn tại không
        $phim = DB::table('phim')->where('maPhim', $maPhim)->first();
        if (!$phim) {
            return response()->json(['success' => false, 'message' => 'Phim không tồn tại!']);
        }
    
        // Xóa phim
        DB::table('phim')->where('maPhim', $maPhim)->delete();
    
        return response()->json(['success' => true, 'message' => 'Xóa phim thành công!']);
    }
      public function create()
    {
        $genres = DB::table('loaiphim')->whereNotNull('tenLoaiPhim')->get();
        $countries = DB::table('quocgia')->orderBy('tenQuocGia', 'asc')->get();

        return view('admin.quanlyphim.filmcreate', compact('genres', 'countries'));
    }
public function store(Request $request)
    {
        try {
            $request->validate([
                'ten-phim' => 'required|string',
                'thoi-luong' => 'required|integer',
                'dao-dien' => 'required|string',
                'quoc-gia' => 'required|integer',
                'mo-ta' => 'required|string',
                'nam-san-xuat' => 'required|integer',
                'trang-thai' => 'required|string',
                'trailer' => 'nullable|url',
                'image-upload' => 'nullable|image|max:2048'
            ]);
            
            $trailer = $request->input('trailer');
            if (!empty($trailer) && strpos($trailer, 'youtube.com') !== false) {
                $trailer = str_replace('watch?v=', 'embed/', $trailer);
            } else {
                $trailer = '';
            }
    
            $hinhAnh = null;
            if ($request->hasFile('image-upload')) {
                $file = $request->file('image-upload');
                $file->move(public_path('resources/uploads/thumbnail'), $file->getClientOriginalName());
            
                
                $hinhAnh = './uploads/thumbnail/' . $file->getClientOriginalName();
            }
    
            // Bắt đầu transaction để đảm bảo dữ liệu không bị lỗi
            DB::beginTransaction();
    
            // Thêm phim vào database
            $maPhim = DB::table('phim')->insertGetId([
                'ten' => $request->input('ten-phim'),
                'thoiLuong' => $request->input('thoi-luong'),
                'tenDaoDien' => $request->input('dao-dien'),
                'maQuocGia' => $request->input('quoc-gia'),
                'moTa' => $request->input('mo-ta'),
                'hinhAnh' => $hinhAnh,
                'trailer' => $trailer,
                'namSanXuat' => $request->input('nam-san-xuat'),
                'trangThai' => $request->input('trang-thai')
            ]);
    
            // Nếu không insert được phim thì rollback và báo lỗi
            if (!$maPhim) {
                DB::rollBack();
                return back()->with('error', 'Không thể thêm phim vào database.');
            }
    
            // Thêm thể loại vào bảng phim_loaiphim
            if ($request->has('theLoai')) {
                foreach ($request->input('theLoai') as $maLoaiPhim) {
                    DB::table('phim_loaiphim')->insert([
                        'maPhim' => $maPhim,
                        'maLoaiPhim' => $maLoaiPhim
                    ]);
                }
            }
    
            // Commit dữ liệu nếu mọi thứ thành công
            DB::commit();
    
            return redirect()->route('quanlyphim.create')->with('success', 'Thêm phim thành công!');
        
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
    public function edit($id)
{
    $movie = DB::table('phim')->where('maPhim', $id)->first();

    if (!$movie) {
        return redirect()->route('quanlyphim.index')->with('error', 'Phim không tồn tại!');
    }

    // Lấy thể loại phim đã chọn
    $selectedGenres = DB::table('phim_loaiphim')->where('maPhim', $id)->pluck('maLoaiPhim')->toArray();
    
    $genres = DB::table('loaiphim')->get();
    $countries = DB::table('quocgia')->get();

    return view('admin.quanlyphim.filmedit', compact('movie', 'genres', 'selectedGenres', 'countries'));
}
public function update(Request $request, $id)
{
    try {
        $request->validate([
            'ten-phim' => 'required|string',
            'thoi-luong' => 'required|integer',
            'mo-ta' => 'required|string',
            'dao-dien' => 'required|string',
            'nam-san-xuat' => 'required|integer',
            'trang-thai' => 'required|string',
            'trailer' => 'required|string',
        ]);

        $data = [
            'ten' => $request->input('ten-phim'),
            'thoiLuong' => $request->input('thoi-luong'),
            'moTa' => $request->input('mo-ta'),
            'tenDaoDien' => $request->input('dao-dien'),
            'namSanXuat' => $request->input('nam-san-xuat'),
            'trangThai' => $request->input('trang-thai'),
            'trailer' => $request->input('trailer'),
        ];
        $trailer = $request->input('trailer');
        if (!empty($trailer) && strpos($trailer, 'youtube.com') !== false) {
            $trailer = str_replace('watch?v=', 'embed/', $trailer);
        } else {
            $trailer = '';
        }
        $data['trailer'] = $trailer;
        if ($request->hasFile('image-upload')) {
            $file = $request->file('image-upload');
            $fileName = time() . '_' . $file->getClientOriginalName();
            
            // Lưu vào thư mục đúng
            $file->move(public_path('Resources/Uploads/Thumbnail'), $fileName);
        
            // Lưu đường dẫn vào database
            $data['hinhAnh'] = './Uploads/Thumbnail/' . $fileName;
        }
        DB::table('phim')->where('maPhim', $id)->update($data);

        return back()->with('success', 'Cập nhật phim thành công!');
    } catch (\Exception $e) {
        return back()->with('error', 'Lỗi: ' . $e->getMessage());
    }
}


}