<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;

class RoomController extends Controller
{
    public function viewRoomList()
    {
        $rooms = DB::table('phongchieuphim') ->join('ghe', 'phongchieuphim.maPhongChieu', '=', 'ghe.maPhongChieu')
        ->select('phongchieuphim.*','ghe.soHang')
        ->orderBy('phongchieuphim.maPhongChieu', 'asc')->paginate(10);
        return view('admin.quanlyphongchieu.roomlist', compact('rooms'));
        }
    public function store(Request $request)
        {
        $request->validate([
        'tenPhong' => 'required|string|max:255',
        'soGhe' => 'required|integer|min:1',
        ]);

        DB::table('phongchieuphim')->insert([
        'tenPhongChieu' => $request->tenPhong,
        'soLuongGhe' => $request->soGhe,
        ]);
        DB::table('ghe')->insert([
            'maPhongChieu' => DB::getPdo()->lastInsertId(), 
            'soHang' => $request->soHang,
            'soGhe' => ($request->soGhe/$request->soHang)
        ]);
        return redirect()->route('quanly.phongchieu')->with('success', 'Thêm phòng chiếu thành công!');
        }


    public function update(Request $request, $id)
    {
        // Ép kiểu ID thành số nguyên để tránh lỗi SQL
        $roomId = (int) $id;

        // Kiểm tra nếu ID hợp lệ
        $room = DB::table('phongchieuphim')->where('maPhongChieu', $roomId)->first();
        if (!$room) {
            return redirect()->back()->with('error', 'Phòng chiếu không tồn tại.');
        }

        // Validate dữ liệu đầu vào
        $request->validate([
            'tenPhong' => 'required|string|max:255',
            'soGhe' => 'required|integer|min:1',
            'trangThai' => 'required|string|max:100',
        ]);
        
        // Cập nhật thông tin phòng chiếu
        DB::table('phongchieuphim')->where('maPhongChieu', $roomId)->update([
            'tenPhongChieu' => $request->tenPhong,
            'soLuongGhe' => $request->soGhe,
            'trangThaiPhongChieu' => $request->trangThai
        ]);
        DB::table('ghe')->where('maPhongChieu', $roomId)->update([
            'soHang' => $request->soHang,
            'soGhe' => ($request->soGhe/$request->soHang)
        ]);

        return redirect()->route('quanly.phongchieu')->with('success', 'Cập nhật phòng chiếu thành công!');
    }


    public function destroy($id)
    {
        DB::table('ghe')->where('maPhongChieu', $id)->delete();
        DB::table('phongchieuphim')->where('maPhongChieu', $id)->delete();
        return redirect()->route('quanly.phongchieu')->with('success', 'Xóa phòng chiếu thành công!');
    }
}