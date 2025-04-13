<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class ScheduleController extends Controller
{ 
    public function viewSchedule()
{
    // Lấy ngày hiện tại
    $start_date = now()->toDateString(); // Ngày hiện tại

    // Lấy ngày của 1 tuần sau
    $end_date = now()->addWeek()->toDateString(); // 1 tuần sau

    $ngayBatDau = now()->addDays(7)->format('Y-m-d');
    $ngayKetThuc = now()->addDays(14)->format('Y-m-d'); 
    
    // Truy vấn danh sách lịch chiếu
    $lichChieu = DB::table('lichchieuphim')
        ->join('phim', 'lichchieuphim.maPhim', '=', 'phim.maPhim')
        ->join('phongchieuphim', 'lichchieuphim.maPhongChieuPhim', '=', 'phongchieuphim.maPhongChieu')
        ->select('lichchieuphim.*', 'phim.ten', 'phongchieuphim.tenPhongChieu')
        ->get();
    foreach ($lichChieu as $lich) {
        if ($lich->ngayChieu >= $ngayBatDau && $lich->ngayChieu <= $ngayKetThuc) {
            $lich->action = '
                <button class="btn btn-warning btn-edit" data-id="' . $lich->maLichChieuPhim . '">Sửa</button>
                <button class="btn btn-danger btn-delete" data-id="' . $lich->maLichChieuPhim . '">Xóa</button>
            ';
        } else {
            $lich->action = ''; // Không hiển thị nút nếu ngoài khoảng thời gian
        }
    }
    // Trả về view với các biến cần thiết
    return view('admin.quanlylichchieu.schedulelist', compact('lichChieu', 'start_date', 'end_date'));
}
public function getData(Request $request)
{
    
    $ngayBatDau = now()->addDays(7)->format('Y-m-d');
    $ngayKetThuc = now()->addDays(14)->format('Y-m-d');

    $query = DB::table('lichchieuphim')
        ->join('phim', 'lichchieuphim.maPhim', '=', 'phim.maPhim')
        ->join('phongchieuphim', 'lichchieuphim.maPhongChieuPhim', '=', 'phongchieuphim.maPhongChieu')
        ->select([
            'lichchieuphim.maLichChieuPhim',
            'phim.ten',
            'lichchieuphim.ngayChieu',
            'phongchieuphim.tenPhongChieu',
            'lichchieuphim.suatChieu',
            'lichchieuphim.loaiChieu',
            'lichchieuphim.giave'
        ]);

    // Lọc theo ngày bắt đầu và ngày kết thúc
    if ($request->has('start_date') && $request->has('end_date')) {
        $query->whereBetween('lichchieuphim.ngayChieu', [$request->start_date, $request->end_date]);
    }

    // Sắp xếp theo ngày chiếu và mã phim
    $query->orderBy('lichchieuphim.ngayChieu', 'asc')
          ->orderBy('phim.maPhim', 'asc');

          return DataTables::of($query)
          ->addColumn('action', function($row) use ($ngayBatDau, $ngayKetThuc) {
              // Chỉ hiển thị nút "Sửa" và "Xóa" nếu ngayChieu nằm trong khoảng thời gian yêu cầu
              if ($row->ngayChieu >= $ngayBatDau && $row->ngayChieu <= $ngayKetThuc) {
                  return '
                      <button class="btn btn-warning btn-edit" data-id="' . $row->maLichChieuPhim . '">Sửa</button>
                      <button class="btn btn-danger btn-delete" data-id="' . $row->maLichChieuPhim . '">Xóa</button>
                  ';
              }
              return ''; // Nếu ngoài khoảng thời gian, không hiển thị nút nào
          })
          ->rawColumns(['action'])  // Đảm bảo cột 'action' được render dưới dạng HTML
          ->make(true);
}
    
    public function delete(Request $request)
    {
        try {
            $lichChieuId=$request->input('lichChieuId');
            // Tìm và xóa lịch chiếu bằng DB::
            $lichChieu = DB::table('lichchieuphim')->where('maLichChieuPhim', $lichChieuId)->first();
            
            if ($lichChieu) {
                // Xóa lịch chiếu
                DB::table('lichchieuphim')->where('maLichChieuPhim', $lichChieuId)->delete();
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false, 'message' => 'Không tìm thấy lịch chiếu.']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Đã xảy ra lỗi.']);
        }
    }
    public function showForm(Request $request)
{
    // Lấy giá trị từ request, nếu không có thì dùng mặc định
    $ngayChieu = $request->query('ngayChieu', now()->addWeek()->format('Y-m-d'));
    $gioChieu = $request->query('gioChieu', '09:00');
    
    $ngayBatDau = now()->addDays(7)->format('Y-m-d');
    $ngayKetThuc = now()->addDays(14)->format('Y-m-d'); 
    
    $phongChieu = DB::table('phongchieuphim')->paginate(4, ['*'], 'phongPage');

    $phimDangChieu = DB::table('phim')
                        ->where('trangThai', 'Đang chiếu')
                        ->paginate(8, ['*'], 'phimPage');

    return view('admin.quanlylichchieu.schedulecreate', compact(
        'ngayChieu', 'gioChieu', 'ngayBatDau', 'ngayKetThuc', 'phongChieu', 'phimDangChieu'
    ));
}
public function showFormEdit($maLichChieu)
{
    // Lấy giá trị từ request, nếu không có thì dùng mặc định
   
    $schedule = DB::table('lichchieuphim')->where('maLichChieuPhim', $maLichChieu)->first();
    $ngayChieu = $schedule->ngayChieu;
    $gioChieu = substr($schedule->suatChieu, 0, 5);
    
    $ngayBatDau = now()->addDays(7)->format('Y-m-d');
    $ngayKetThuc = now()->addDays(14)->format('Y-m-d'); 
    
    $phongChieu = DB::table('phongchieuphim')->paginate(4, ['*'], 'phongPage');

    $phimDangChieu = DB::table('phim')
                        ->where('trangThai', 'Đang chiếu')
                        ->paginate(8, ['*'], 'phimPage');

    return view('admin.quanlylichchieu.schedulecreate', compact(
        'ngayChieu', 'gioChieu', 'ngayBatDau', 'ngayKetThuc', 'phongChieu', 'phimDangChieu'
    ));
}
public function handleSubmit(Request $request)
{
    $ngayChieu = $request->input('ngayChieu');
    $gioChieu = $request->input('gioChieu');

    // Kiểm tra dữ liệu đầu vào hợp lệ
    if (!$ngayChieu || !$gioChieu) {
        return redirect()->back()->with('error', 'Vui lòng chọn ngày và giờ chiếu hợp lệ.');
    }


    return redirect()->route('quanlylichchieu.showForm', [
        'ngayChieu' => $ngayChieu, 
        'gioChieu' => $gioChieu
    ])->with('success', 'Cập nhật lịch chiếu thành công!');
}
public function saveSchedule(Request $request)
{
    $data = $request->json()->all();
   // dd($data);
    if (!is_array($data) || empty($data)) {
        return response()->json([["message" => "Dữ liệu không hợp lệ."]], 400);
    }
    $ngayBatDau = now()->addDays(7)->format('Y-m-d');
    $ngayKetThuc = now()->addDays(14)->format('Y-m-d');
    $response = [];
    $schedules = $data['schedules'];
//dd($schedules);
    foreach ($schedules as $schedule) {
      //  dd($schedule, array_keys($schedule));
      
       // dd($schedule);
        $movieId = $schedule['maPhim'] ?? null;
        $cinemaId = $schedule['maPhongChieuPhim'] ?? null;
        $date = $schedule['ngayChieu'] ?? null;
        $time = $schedule['gioBatDau'] ?? null;
        $status = $schedule['status'] ?? null;
        $loaiHinhChieu = $schedule['loaiHinhChieu'] ?? "2D";
        $giaVe=$schedule['giaVe'];
       
        if (!$cinemaId || !$date || !$time) {
            $response[] = ["message" => "Dữ liệu thiếu hoặc không hợp lệ cho phòng chiếu $cinemaId."];
            continue;
        }
        if ($date < $ngayBatDau || $date > $ngayKetThuc) {
            $response[] = ["message" => "Ngày chiếu $date nằm ngoài phạm vi cho phép ($ngayBatDau - $ngayKetThuc)."];
            continue;
        }
    //    dd($status);
        if ($status === "delete") {
            if (!$movieId) {
                DB::table('lichchieuphim')
                    ->where('maPhongChieuPhim', $cinemaId)
                    ->where('ngayChieu', $date)
                    ->where('suatChieu', $time)
                    ->delete();

                DB::table('phim')
                    ->where('maPhim', $movieId)
                    ->decrement('soLuongSuatChieu');

                $response[] = ["message" => "Xóa lịch chiếu thành công số lượng suất chiếu."];
            } else {
                $response[] = ["message" => "Không thể xóa lịch chiếu vì mã phim vẫn tồn tại trong phòng $cinemaId."];
            }
        } elseif ($status === "update") {
            if ($movieId) {
                // /dd($giaVe);
                DB::table('lichchieuphim')
                ->where('maPhongChieuPhim', $cinemaId)
                ->where('ngayChieu', $date)
                ->where('suatChieu', $time)
                ->update([
                    'loaiChieu' => $loaiHinhChieu,
                    'giaVe' => $giaVe, // Cập nhật thêm giá vé
                ]);
                $response[] = ["message" => "Cập nhật thành công."];
            } else {
                $response[] = ["message" => "Không thể cập nhật vì không có mã phim trong phòng $cinemaId."];
            }
        } elseif ($status === "insert") {
            if ($movieId) {
                DB::table('lichchieuphim')->insert([
                    'maPhim' => $movieId,
                    'maPhongChieuPhim' => $cinemaId,
                    'ngayChieu' => $date,
                    'suatChieu' => $time,
                    'loaiChieu' => $loaiHinhChieu,
                    'giaVe'=>$giaVe
                ]);

                DB::table('phim')
                    ->where('maPhim', $movieId)
                    ->increment('soLuongSuatChieu');

                $response[] = ["message" => "Thêm lịch chiếu thành công."];
            } else {
                $response[] = ["message" => "Không thể thêm lịch chiếu vì không có mã phim trong phòng $cinemaId."];
            }
        } else {
            $response[] = ["message" => "Không có thay đổi gì cho phòng $cinemaId."];
        }
    }

    return response()->json($response);
}
    
}