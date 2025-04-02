<x-index-guest>
    <x-slot name="title">
        Quên mật khẩu
    </x-slot>
    <div class="container" id="login-form" style="color: black; width:40%; text-align:center;margin: 100px;
    margin-left: 400px; ">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Quên mật khẩu?</h2>
        <p class="text-sm text-gray-600 mb-4">
            Nhập địa chỉ email của bạn và chúng tôi sẽ gửi cho bạn liên kết đặt lại mật khẩu.
        </p>

        <!-- Hiển thị thông báo session -->
        @if (session('status'))
        <div class="mb-4 text-sm text-green-600">
            {{ session('status') }}
        </div>
        @endif

        <!-- Hiển thị lỗi xác thực -->
        @if ($errors->any())
        <div class="mb-4 text-sm text-red-600">
            @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Ô nhập email -->
            <div class="mb-4">
                <label for="email" class="block text-left text-sm font-medium text-gray-600">Email</label>
                <input id="email" type="email" name="email" class="mt-1 w-full p-2 border border-gray-300 rounded-lg"
                    required autofocus>
            </div>

            <!-- Nút gửi -->
            <button type="submit" class="btn btn-success">
                Gửi liên kết đặt lại mật khẩu
            </button>
        </form>
    </div>
</x-index-guest>