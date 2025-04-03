<x-index-guest>
    <x-slot name="title">Đăng nhập</x-slot>
    <div class="container" style="width: 60%;">
        <div class="tabs">
            <div class="tab" id="tab-login">
                <button id="login-btn" style="all: unset;">ĐĂNG NHẬP</button>
            </div>
            <div class="tab" id="tab-register">
                <button id="register-btn" style="all: unset;">ĐĂNG KÝ</button>
            </div>
        </div>

        <div id="dangnhap">
            @include('auth.guest.login_content')
        </div>
        @if(session('success'))
        <script>
        alert("{{ session('success') }}");
        </script>
        @endif
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
        $(document).ready(function() {
            $('#tab-login').addClass('active'); // Mặc định tab đăng nhập là active

            // Xử lý sự kiện khi click vào Đăng nhập
            $('#login-btn').on('click', function(e) {
                e.preventDefault();
                $('#dangnhap').load("{{ route('authlogin') }}");
                $('#tab-login').addClass('active');
                $('#tab-register').removeClass('active');
            });
            $('#switch-login-btn').on('click', function(e) {
                e.preventDefault();
                $('#dangnhap').load("{{ route('authlogin') }}");
                $('#tab-login').addClass('active');
                $('#tab-register').removeClass('active');
            });

            // Xử lý sự kiện khi click vào Đăng ký
            $('#register-btn').on('click', function(e) {
                e.preventDefault();
                $('#dangnhap').load("{{ route('authregister') }}");
                $('#tab-register').addClass('active');
                $('#tab-login').removeClass('active');
            });
        });
        </script>
    </div>
    <div class="phim-dang-chieu">
        <h1>MỘT VÀI PHIM ĐANG CHIẾU KHÁC</h1>
        <div class="movie-list">
            @foreach($phimDangChieu as $phim)
            <div class="movie">
                <img src="{{ asset('Resources/' . $phim->hinhAnh) }}" alt="{{ $phim->ten }}" />
                <div class="info">
                    <h3>{{ $phim->ten }} ({{ $phim->namSanXuat }})</h3>
                    <div class="trailer-booking">
                        <a class="trailer" href="{{ $phim->trailer }}" target="_blank">
                            <img src="{{ asset('Resources/Images/DefaultPage/icon-play-vid.svg') }}" alt="play"
                                class="play-btn" />
                            Xem trailer
                        </a>
                        <a class="book-btn" href="{{ route('phim', ['maPhim' => $phim->maPhim]) }}"><b>CHI TIẾT</b></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
</x-index-guest>