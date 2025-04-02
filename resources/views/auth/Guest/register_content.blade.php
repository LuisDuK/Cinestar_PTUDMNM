<div class="form-container" id="register-form" style="color: black;">
    <form action="{{ url('/register') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">{{ __('Họ và tên') }} <span>*</span></label>
            <input type="text" id="name" name="name" placeholder="{{ __('Nhập họ và tên') }}" required />
        </div>

        <div class="form-group">
            <label for="dob">{{ __('Ngày sinh') }} <span>*</span></label>
            <input type="date" id="dob" name="dob" required />
        </div>

        <div class="form-group">
            <label>{{ __('Giới tính') }} <span>*</span></label>
            <div class="gender-group" style="display: flex; gap: 10px;">
                <label for="male">{{ __('Nam') }}</label>
                <input type="radio" id="male" name="gender" value="male" required />
                <label for="female">{{ __('Nữ') }}</label>
                <input type="radio" id="female" name="gender" value="female" required />
                <label for="other">{{ __('Khác') }}</label>
                <input type="radio" id="other" name="gender" value="other" required />

            </div>
        </div>

        <div class="form-group">
            <label for="phone">{{ __('Số điện thoại') }} <span>*</span></label>
            <input type="text" id="phone" name="phone" placeholder="{{ __('Nhập số điện thoại') }}" required />
        </div>

        <div class="form-group">
            <label for="email">{{ __('Email') }} <span>*</span></label>
            <input type="email" id="email" name="email" placeholder="{{ __('Nhập email') }}" required />
        </div>

        <div class="form-group">
            <label for="password">{{ __('Mật khẩu') }} <span>*</span></label>
            <input type="password" id="password" name="password" placeholder="{{ __('Nhập mật khẩu') }}" required />
        </div>

        <div class="form-group">
            <label for="password_confirmation">{{ __('Xác thực mật khẩu') }} <span>*</span></label>
            <input type="password" id="password_confirmation" name="password_confirmation"
                placeholder="{{ __('Xác thực mật khẩu') }}" required />
        </div>

        <div class="form-group" style="display: flex; align-items: center; justify-content: space-between;">
            <label for="agree">{{ __('Tôi đồng ý với điều khoản và điều kiện của Cinestar') }}</label>
            <input type="checkbox" id="agree" required class="custom-checkbox"
                style="width: 15px; height: 15px; cursor: pointer;">
        </div>

        <button class="btn-dangnhap" type="submit">{{ __('ĐĂNG KÝ') }}</button>
        <p>{{ __('Bạn đã có tài khoản?') }} <button id="switch-login-btn" style="all: unset;
    cursor: pointer; "><a href="#">{{ __('Đăng nhập') }}</a></button></p>
    </form>

    <x-auth-validation-errors class="mb-4" :errors="$errors" />
</div>