<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class TransHistoryController extends Controller
{
    public function showall()
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để xem lịch sử giao dịch.');
    }

    $maKH = Auth::id(); // Lấy ID khách hàng đăng nhập

    // Lấy danh sách đơn hàng có phân trang
    $orders = DB::table('donhangonline')
        ->where('maKH', $maKH)
        ->orderBy('ngayDat', 'DESC')
       ->get(); // Laravel tự động xử lý phân trang

    return view('guest.cart.transaction', compact('orders')); // Truyền biến orders vào view
}

        public function get_table(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Không tìm thấy mã khách hàng'], 403);
        }

        $maKH = Auth::id(); // Lấy ID của khách hàng hiện tại

        // Lấy danh sách đơn hàng với phân trang
        $orders = DB::table('donhangonline')
            ->where('maKH', $maKH)
            ->orderBy('ngayDat', 'DESC')
            ->paginate(10);

        // Tạo HTML danh sách đơn hàng
        $orderHTML = '';
        foreach ($orders as $order) {
            $orderHTML .= "
            <tr>
                <td>{$order->maDonHang}</td>
                <td>{$order->ngayDat}</td>
                <td>" . number_format($order->tongTien, 0) . " VND</td>
                <td>{$order->trangThai}</td>
                <td>{$order->phuongThucThanhToan}</td>
                <td><a href='" . route('ticket.detail', ['maDonHang' => $order->maDonHang]) . "'>Xem chi tiết</a></td>
            </tr>";
        }
      

        return response()->json([
            'orderHTML' => $orderHTML,
        ]);
    }
    public function showticket($maDonHang)
    {
        // Query to check if the order exists in chitietdatve
        $checkQuery = "
            SELECT 1 
            FROM chitietdatve 
            WHERE id_don_hang = :maDonHang
        ";
    
        $resultCheck = DB::select($checkQuery, ['maDonHang' => $maDonHang]);
    
        // Check if there's an entry in chitietdatve
       
            // Query to get the order details with associated 'chitietdatve'
            $query = "
                SELECT 
                    dh.maDonHang,
                    dh.ngayDat,
                    dh.tongTien,
                    dh.trangThai AS donHangTrangThai,
                    dh.phuongThucThanhToan,
                    ctv.id_chi_tiet_dat_ve,
                    ctv.so_tien,
                    ctv.ngay_phat_hanh,
                    ctv.danh_sach_ghes_da_dat,
                    lp.giave,
                    lp.ngayChieu,
                    lp.suatChieu,
                    lp.loaiChieu,
                    p.ten AS phimTen,
                    p.hinhAnh as hinhAnh
                FROM 
                    donhangonline dh
                LEFT JOIN 
                    chitietdatve ctv ON dh.maDonHang = ctv.id_don_hang
                LEFT JOIN 
                    lichchieuphim lp ON ctv.id_lich_chieu = lp.maLichChieuPhim
                LEFT JOIN 
                    phim p ON lp.maPhim = p.maPhim
                WHERE 
                    dh.maDonHang = :maDonHang
            ";

        // Fetch the order details
        $orderDetails = DB::select($query, ['maDonHang' => $maDonHang]);

    if (empty($orderDetails)) {
        return response()->json(['error' => 'Không tìm thấy đơn hàng'], 404);
    }

    // Lấy đối tượng đầu tiên từ mảng (vì DB::select() trả về mảng)
    $order = $orderDetails[0];

    // Generate the QR code data
    $qrData = route('ticket.detail', ['maDonHang' => $maDonHang]);

    // Trả về view và truyền dữ liệu
    return view('guest.cart.detail_transaction', compact('order', 'qrData'));
    }
    
}