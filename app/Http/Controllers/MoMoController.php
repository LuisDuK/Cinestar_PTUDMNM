<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Mail\BookingConfirmation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use  Illuminate\Support\Facades\Log;

class MoMoController extends Controller
{
  
public function createPayment(Request $request)
{
 
    $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

    $partnerCode = 'MOMOBKUN20180529';
    $accessKey = 'klm05TvNBzhg7h7j';
    $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';



    $orderId = time() . rand(1000, 9999);
    // Mã đơn hàng (duy nhất)
    $orderInfo = "Thanh toán vé xem phim";
    $returnUrl = 'http://127.0.0.1:8000/momo/callback';
    $ipnUrl = 'http://127.0.0.1:8000/momo/notify';
    $redirectUrl = 'http://127.0.0.1:8000/momo/callback';  
    $requestId = time();
    $extraData = "";
    $cart = session('cart', []);

    if (empty($cart)) {
        return redirect()->back()->with('error', 'Giỏ hàng trống!');
    }

    $amount = $cart['totalPrice'];

    // Tạo signature
    $rawHash = "accessKey=$accessKey"
    ."&amount=$amount"
    ."&extraData=$extraData"
    ."&ipnUrl=$ipnUrl"
    ."&orderId=$orderId"
    ."&orderInfo=$orderInfo"
    ."&partnerCode=$partnerCode"
    ."&redirectUrl=$redirectUrl"  // 🚨 Bỏ dòng này đi nếu không có giá trị
    ."&requestId=$requestId"
    ."&requestType=payWithATM";
    $signature = hash_hmac("sha256", $rawHash, $secretKey);

    // Dữ liệu gửi đi
    $data = [
        'partnerCode' => $partnerCode,
        'accessKey' => $accessKey,
        'requestId' => $requestId,
        'amount' => $amount,
        'orderId' => $orderId,
        'orderInfo' => $orderInfo,
        'returnUrl' => $returnUrl,
        'redirectUrl' => $redirectUrl, 
        'ipnUrl' => $ipnUrl,  // Đảm bảo key là "ipnUrl"
        'extraData' => $extraData,
        'requestType' => 'payWithATM',
        'signature' => $signature
    ];

    // Gửi request bằng Laravel Http Client
    $response = Http::withOptions([
        'verify' => false, // Bỏ qua SSL
    ])->withHeaders([
        'Content-Type' => 'application/json'
    ])->post($endpoint, $data)->json();
    // Debug response nếu có lỗi
    if (!isset($response['payUrl'])) {
        dd("Lỗi MoMo:", $response);
    }

    // Chuyển hướng đến URL thanh toán
    return redirect($response['payUrl']);
}
public function paymentCallback(Request $request)
{
    Log::info('MoMo Callback Data:', $request->all()); // ✅ Log dữ liệu nhận được

    if (!$request->has('errorCode')) {
        return $this->bookTicket();
    }

    if ($request->input('errorCode') == "0") {
        // Gọi hàm bookTicket để xử lý đặt vé
        return $this->bookTicket();
    } else {
        return $this->bookTicket();
    }
}
    public function paymentNotify(Request $request)
{
    $data = $request->all();

    // Kiểm tra chữ ký để xác thực tính hợp lệ của giao dịch
    $partnerCode = 'MOMOBKUN20180529';
    $accessKey = 'klm05TvNBzhg7h7j';
    $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

    $rawHash = "accessKey=$accessKey&amount={$data['amount']}&extraData={$data['extraData']}&ipnUrl={$data['ipnUrl']}&orderId={$data['orderId']}&orderInfo={$data['orderInfo']}&partnerCode=$partnerCode&redirectUrl={$data['redirectUrl']}&requestId={$data['requestId']}&requestType={$data['requestType']}";
    $signature = hash_hmac("sha256", $rawHash, $secretKey);

    // Kiểm tra chữ ký hợp lệ
    if ($signature !== $data['signature']) {
        return response()->json(['message' => 'Invalid signature'], 400);
    }

    // Nếu thanh toán thành công, thực hiện đặt vé
    if ($data['resultCode'] == 0) {
        return $this->bookTicket();
    }

    return response()->json(['message' => 'Payment failed'], 400);
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
            ->with('success', 'Thanh toán MOMO thành công!');
    
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => 'Đã xảy ra lỗi: ' . $e->getMessage()], 500);
        }
    }
}