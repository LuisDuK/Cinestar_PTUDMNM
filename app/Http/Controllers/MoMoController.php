<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MoMoController extends Controller
{
    public function createPayment(Request $request)
    {
        $endpoint = env('MOMO_ENDPOINT');
        $partnerCode = env('MOMO_PARTNER_CODE');
        $accessKey = env('MOMO_ACCESS_KEY');
        $secretKey = env('MOMO_SECRET_KEY');

        $orderId = time(); // Mã đơn hàng (duy nhất)
        $orderInfo = "Thanh toán vé xem phim";
        $amount = "10000"; // Số tiền (đơn vị VNĐ)
        $returnUrl = env('MOMO_RETURN_URL');
        $notifyUrl = env('MOMO_NOTIFY_URL');
        $requestId = time();
        $extraData = "";

        // Tạo chuỗi signature
        $rawHash = "partnerCode=$partnerCode&accessKey=$accessKey&requestId=$requestId&amount=$amount&orderId=$orderId&orderInfo=$orderInfo&returnUrl=$returnUrl&notifyUrl=$notifyUrl&extraData=$extraData";
        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        // Tạo dữ liệu gửi đi
        $data = [
            'partnerCode' => $partnerCode,
            'accessKey' => $accessKey,
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'returnUrl' => $returnUrl,
            'notifyUrl' => $notifyUrl,
            'extraData' => $extraData,
            'requestType' => 'captureWallet',
            'signature' => $signature
        ];

        // Gửi request đến MoMo
        $ch = curl_init($endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        $result = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($result, true);
        
        // Chuyển hướng đến URL thanh toán của MoMo
        if (isset($response['payUrl'])) {
            return redirect($response['payUrl']);
        }

        return back()->with('error', 'Không thể tạo thanh toán MoMo');
    }

    public function paymentCallback(Request $request)
    {
        if ($request->errorCode == "0") {
            return redirect()->route('checkout')->with('success', 'Thanh toán MoMo thành công!');
        } else {
            return redirect()->route('checkout')->with('error', 'Thanh toán MoMo thất bại!');
        }
    }
}