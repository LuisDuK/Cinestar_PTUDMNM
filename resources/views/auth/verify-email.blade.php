<x-index-guest>
    <x-slot name="title">Xác thực emails</x-slot>
    <div class="container" style="width: 40%; margin:100px; margin-left:400px;">
        <p class=" text-gray-700">
            {{ __('Cảm ơn bạn đã đăng ký! Hãy xác minh địa chỉ email của bạn bằng cách nhấp vào liên kết trong email. Nếu chưa nhận được, bạn có thể yêu cầu gửi lại.') }}
        </p>

        @if (session('status') == 'verification-link-sent')
        <div class="mt-2 p-2 text-green-700 bg-green-100 border border-green-400 rounded-md text-center w-full">
            {{ __('Một liên kết xác minh mới đã được gửi đến email của bạn.') }}
        </div>
        @endif

        <div style="display:flex; ">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button style="margin-right:260px; " class="btn btn-success">
                    {{ __('Gửi lại email') }}
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-warning">
                    {{ __('Đăng xuất') }}
                </button>
            </form>
        </div>
    </div>


</x-index-guest>