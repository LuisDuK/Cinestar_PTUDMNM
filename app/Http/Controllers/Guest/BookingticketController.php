<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

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
                'lichchieuphim.maLichChieuphim as showtimeId',
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
       // dd($movie);
        return view('guest.booking.select_chair', compact('seats','movie', 'user','maLichChieuPhim'));
    }
    public function getBookedSeats(Request $request)
    {
        $showtimeId = $request->query('showtime_id', 0);

        // Lấy danh sách ghế đã đặt từ bảng `chitietdatve`
        $bookedSeats = DB::table('chitietdatve')
            ->where('id_lich_chieu', $showtimeId)
            ->pluck('danh_sach_ghes_da_dat')
            ->toArray();

        // Chuyển danh sách ghế đã đặt thành mảng
        $seats = [];
        foreach ($bookedSeats as $seatList) {
            $seats = array_merge($seats, explode(',', $seatList));
        }

        return response()->json(['bookedSeats' => $seats]);
    }
    public function bookTicket(Request $request)
{
    try {
        DB::beginTransaction();

        $seats_booked = $request->input('seats_booked');
        $total_amount = $request->input('total_amount');
        $payment_method = $request->input('payment_method');
        $showtime_id = $request->input('showtime_id');

        $customer = Auth::user(); 
        $customer_email = $customer->email;

        // Lưu đơn hàng vào bảng donhangonline
        $order_id = DB::table('donhangonline')->insertGetId([
            'maKH' => $customer->id,
            'ngayDat' => now(),
            'tongTien' => $total_amount,
            'phuongThucThanhToan' => $payment_method,
            'trangThai' => 'Đã hoàn tất',
        ]);

        // Lưu chi tiết vé vào bảng chitietdatve
        DB::table('chitietdatve')->insert([
            'so_tien' => $total_amount,
            'ngay_phat_hanh' => now(),
            'danh_sach_ghes_da_dat' => $seats_booked,
            'id_lich_chieu' => $showtime_id,
            'id_don_hang' => $order_id,
        ]);

        DB::commit();

        
        // Chuẩn bị dữ liệu gửi email
        $orderDetails = [
            'customer_name' => $customer->name,
            'order_id' => $order_id,
            'order_date' => now()->format('d/m/Y H:i'),
            'total_amount' => $total_amount,
            'seats_booked' => $seats_booked,
            'payment_method' => $payment_method,
        ];
        //dd($orderDetails['qrCode']);
        // Gửi email
        Mail::to($customer_email)->send(new BookingConfirmation($orderDetails));

        return response()->json(['status' => 'success', 'order_id' => $order_id]);

    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['status' => 'error', 'message' => 'Đã xảy ra lỗi: ' . $e->getMessage()], 500);
    }
}
}