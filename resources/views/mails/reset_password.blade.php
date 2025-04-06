<!DOCTYPE html>
<html>

<head>
    <title>Đặt lại mật khẩu</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 600px;
        margin: 30px auto;
        background: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    h2 {
        color: #333;
    }

    p {
        color: #555;
        font-size: 16px;
        line-height: 1.5;
    }

    .btn {
        display: inline-block;
        padding: 12px 24px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        font-size: 16px;
        font-weight: bold;
        border-radius: 6px;
        margin-top: 20px;
    }

    .footer {
        margin-top: 20px;
        font-size: 14px;
        color: #777;
    }
    </style>
</head>

<body>
    <div class="container">
        <h2>Đặt lại mật khẩu</h2>
        <p>Xin chào,</p>
        <p>Bạn nhận được email này vì chúng tôi nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn.</p>
        <a href="{{ route('password.reset', ['token' => $token, 'email' => $email]) }}" class="btn">
            Đặt lại mật khẩu
        </a>

        <p class="footer">Nếu bạn không yêu cầu đặt lại mật khẩu, vui lòng bỏ qua email này.</p>
    </div>
</body>

</html>