<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng nhập-Admin </title>
    <link rel="shortcut icon" href="https://cinestar.com.vn/pictures/logo/favicon.ico" />
    <style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        background: linear-gradient(to right, #131921, #49136b);
        color: #FFFFFF;
    }

    form {
        border: 3px solid linear-gradient(to right, #555, #333);
        /* Màu tối hơn cho border */
        background: linear-gradient(to right, #7d669f, #49136b);
        color: #FFFFFF;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }


    .boxcenter {
        width: 500px;
        margin: 0px auto;
        padding-top: 20px;
    }

    .boxcenter h2 {
        margin-bottom: 30px;
        color: white;
        text-align: center;

    }

    input[type=text],
    input[type=password] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;

        box-sizing: border-box;
    }

    button {
        background-color: #04AA6D;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        border-radius: 20px;
        width: 50%;
        /* Set button width to 50% */
        display: block;
        /* Ensure the button takes full width */
        margin-left: auto;
        margin-right: auto;
        text-align: center;
        font-size: 20px;
    }


    .container label {
        color: white;
    }

    button:hover {
        opacity: 0.8;
    }

    .cancelbtn {
        width: auto;
        padding: 10px 18px;
        background-color: #f44336;
    }

    .imgcontainer {
        text-align: center;
        margin: 24px 0 12px 0;
    }

    img.avatar {
        width: 40%;
    }

    .container {
        padding: 16px;
    }

    .container input {
        border-radius: 20px;
    }

    span.psw {
        float: right;
        padding-top: 16px;
    }

    /* Change styles for span and cancel button on extra small screens */
    @media screen and (max-width: 300px) {
        span.psw {
            display: block;
            float: none;
        }

        .cancelbtn {
            width: 100%;
        }
    }
    </style>
</head>

<body>
    <div class="boxcenter">

        <form action="{{ route('admin.logon') }}" method="POST">
            @csrf
            <h2>ĐĂNG NHẬP</h2>
            <div class="imgcontainer">
                <img src="{{ asset('Resources/Images/DefaultPage/logocinestar.webp') }}" alt="Avatar" class="avatar">
            </div>
            <div class="container">
                <label for="username"><b>Tên đăng nhập</b></label>
                <input type="text" id="email" name="email" placeholder="Nhập tài khoản" required />
                <label for="password"><b>Mật khẩu</b></label>
                <input type="password" placeholder="Enter Password" name="password" required>

                <button type="submit"><b>ĐĂNG NHẬP</b></button>
                @if ($errors->has('loginError'))
                <p class="error">{{ $errors->first('loginError') }}</p>
                @endif
            </div>
        </form>
    </div>
</body>

</html>