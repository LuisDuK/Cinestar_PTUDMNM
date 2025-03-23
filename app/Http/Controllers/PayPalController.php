<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayPalController extends Controller
{
    public function createPayment()
    {
        $paypal = new PayPalClient;
        $paypal->setApiCredentials(config('paypal'));
        $paypal->getAccessToken();

        $order = $paypal->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => "10.00"  // Giá trị thanh toán (có thể lấy từ database)
                    ]
                ]
            ],
            "application_context" => [
                "return_url" => route('paypal.success'),
                "cancel_url" => route('paypal.cancel'),
            ]
        ]);
        dd($order);

        return redirect($order['links'][1]['href']); // Chuyển hướng tới trang thanh toán PayPal
    }

    public function successPayment(Request $request)
    {
        $paypal = new PayPalClient;
        $paypal->setApiCredentials(config('paypal'));
        $paypal->getAccessToken();

        $response = $paypal->capturePaymentOrder($request->query('token'));

        if ($response['status'] == 'COMPLETED') {
            return redirect()->route('checkout')->with('success', 'Thanh toán PayPal thành công!');
        }

        return redirect()->route('checkout')->with('error', 'Thanh toán thất bại.');
    }

    public function cancelPayment()
    {
        return redirect()->route('checkout')->with('error', 'Bạn đã hủy thanh toán.');
    }
}