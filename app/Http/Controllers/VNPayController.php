<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Guest\BookingTicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Mail\BookingConfirmation;
use Illuminate\Support\Facades\Mail;

class VNPayController extends Controller
{
    public function createPayment(Request $request)
    {
        $vnp_TmnCode = env('VNP_TMN_CODE');
        $vnp_HashSecret = env('VNP_HASH_SECRET');
        $vnp_Url = env('VNP_URL');
        $vnp_Returnurl = env('VNP_RETURN_URL');
        $vnp_TxnRef = time(); // Mã đơn hàng (duy nhất)
        $vnp_OrderInfo = "Thanh toán đơn hàng";
        $vnp_OrderType = "billpayment";
        $vnp_Locale = "vn";
        $vnp_BankCode = "";
        $vnp_IpAddr = request()->ip();

        $cart = session('cart', []);
  

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Giỏ hàng trống!');
        }
        $vnp_Amount = $cart['totalPrice']*100; 
    
       
        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        ];

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        $vnp_Url = $vnp_Url . "?" . $query . "vnp_SecureHash=" . $vnpSecureHash;

        return redirect($vnp_Url);
    }
    public function bookTicket()
{
    try {
        DB::beginTransaction();

        // Lấy thông tin giỏ hàng từ session
        $cart = session('cart');
        
        // Lấy các giá trị từ giỏ hàng
        $seats_booked = $cart['seats']; // Danh sách ghế đã đặt
        $total_amount = $cart['totalPrice']; // Tổng số tiền
        
        $showtime_id = $cart['showtimeId']; // ID lịch chiếu
        $payment_method=$cart['paymentMethod'];

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
            'danh_sach_ghes_da_dat' => implode(',', $seats_booked), // Nối các ghế đã đặt thành chuỗi, cách nhau bởi dấu phẩy
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
            'seats_booked' => implode(',', $seats_booked),
            'payment_method' => $payment_method,
        ];

        // Xóa dữ liệu giỏ hàng sau khi hoàn tất thanh toán
        session()->forget('cart');

        // Gửi email xác nhận
        Mail::to($customer_email)->send(new BookingConfirmation($orderDetails));

        // Trả về phản hồi thành công
        return redirect()->route("ticket.detail", ['maDonHang' => $order_id])
        ->with('success', 'Thanh toán VNPAY thành công!');

    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['status' => 'error', 'message' => 'Đã xảy ra lỗi: ' . $e->getMessage()], 500);
    }
}
    public function paymentCallback(Request $request)
    {
        if ($request->vnp_ResponseCode == "00") {
            return $this->bookTicket();
            
        } else {
            return redirect()->route('homeindex')->with('error', 'Thanh toán VNPAY thất bại!');
        }
    }
}