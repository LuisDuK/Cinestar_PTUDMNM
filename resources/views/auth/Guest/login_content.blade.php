<!-- Validation Errors -->

<div class="container" id="login-form" style="color: black; witdh:40%;">
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">Tài khoản, Email hoặc số điện thoại <span>*</span></label>
            <input type="text" id="email" name="email" placeholder="Nhập tài khoản" required />
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu <span>*</span></label>
            <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required />
        </div>
        <div class="form-group" style="display: flex; align-items: center; justify-content: space-between;">
            <label for="remember">Lưu mật khẩu đăng nhập</label>
            <input type="checkbox" id="remember" class="custom-checkbox"
                style="width: 10px; height: 10px; cursor: pointer;">
        </div>

        <div class="forgot-password">
            <a href="{{ route('password.request') }}" id="forgot-password-btn">Quên mật khẩu?</a>
        </div>
        <button class="btn-dangnhap" type="submit">ĐĂNG NHẬP</button>
    </form>
</div>
<x-auth-session-status class="mb-4" :status="session('status')" />
<x-auth-validation-errors class="mb-4" :errors="$errors" />