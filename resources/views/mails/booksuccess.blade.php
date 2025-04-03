<!DOCTYPE html>
<html>

<head>
    <title>Xác nhận đặt vé</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        padding: 20px;
    }

    .container {
        max-width: 600px;
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    h2 {
        color: #2c3e50;
    }

    p {
        font-size: 16px;
        color: #555;
    }

    .details {
        text-align: left;
        margin-top: 20px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #f9f9f9;
    }

    .qr-code {
        margin-top: 20px;
    }
    </style>
</head>

<body>
    <div class="container">
        <h2>Chào {{ $orderDetails['customer_name'] }},</h2>
        <p>Cảm ơn bạn đã đặt vé tại hệ thống của chúng tôi.</p>

        <div class="details">
            <p><strong>Mã đơn hàng:</strong> {{ $orderDetails['order_id'] }}</p>
            <p><strong>Ngày đặt:</strong> {{ $orderDetails['order_date'] }}</p>
            <p><strong>Tổng tiền:</strong> {{ number_format($orderDetails['total_amount'], 0, ',', '.') }} VNĐ</p>
            <p><strong>Ghế đã đặt:</strong> {{ $orderDetails['seats_booked'] }}</p>
            <p><strong>Phương thức thanh toán:</strong> {{ $orderDetails['payment_method'] }}</p>
        </div>

        <p>Chúc bạn xem phim vui vẻ!</p>
    </div>
</body>

</html>