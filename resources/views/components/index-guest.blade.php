<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title}}</title>
    <link rel="shortcut icon" href="https://cinestar.com.vn/pictures/logo/favicon.ico" />
    <link rel="stylesheet" href="{{ asset('css/trangchu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dangnhap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/phimdangchieu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/phimsapchieu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datbapnuoc.css') }}">
    <link rel="stylesheet" href="{{ asset('css/thanhtoan.css') }}">
    <link rel="stylesheet" href="{{ asset('css/phim_detail.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap4.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap4.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>
    <script src="https://js.stripe.com/v3/"></script>

    <style>
    .image_footer {
        width: 20px;
        height: 20px;
        margin-right: 5px;
        margin-bottom: 2px;
    }
    </style>

</head>

<body>

    <div class="app">
        <header class="cinestar-header">
            <div class="header-top">
                <div class="logo">
                    <a href="{{ route("homeindex") }}"> <img
                            src="{{ asset('Resources/Images/DefaultPage/logocinestar.webp') }}"
                            alt="Cinestar Logo" /></a>
                </div>
                <div class="actions">
                    <button class="btn yellow" id="btn-booking-now">
                        <img src=" {{ asset('Resources/Images/DefaultPage/ic-ticket.svg') }}" alt="ảnh"
                            style="width: 20px; height: 20px; margin-bottom: 2px" />
                        <b>ĐẶT VÉ NGAY</b>
                    </button>
                </div>
                <div class="search">
                    <input type="text" placeholder="Tìm phim, rạp" />
                    <button class="search-btn">🔍</button>
                </div>
                <div class="user-actions">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            @if (Auth::check())
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ __('Xin chào') }}, {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown"
                                style="background: linear-gradient(to left, #131921, #49136b);">
                                <li>
                                    <a class="dropdown-item" style="color:white;" href="{{ route('account.profile') }}">
                                        {{ __('Thông tin cá nhân') }}
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" style="color:white;" href="{{ route('transhistory') }}">
                                        {{ __('Lịch sử giao dịch') }}
                                    </a>
                                </li>
                                <li>
                                    <form action="{{ url('/logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item" style="color:white;">
                                            {{ __('Đăng xuất') }}
                                        </button>
                                    </form>
                                </li>
                            </ul>
                            @else
                            <a href="{{ url('/auth') }}" class="user-login">
                                <img src="{{ asset('Resources/Images/DefaultPage/ic-header-auth.svg') }}"
                                    alt="Cinestar Logo" style="width: 30px; height: 30px; margin-bottom: 2px" />
                                <b>{{ __('Đăng nhập') }}</b>
                            </a>
                            @endif
                        </li>
                    </ul>




                    <div class="language-selector">
                        <img src="https://flagcdn.com/w40/vn.png" alt="French Flag">
                        VN
                        <i class="fas fa-chevron-down" style="margin-left: 8px;"></i>
                        <div class="dropdown">
                            <div>
                                <img src="https://flagcdn.com/w40/us.png" alt="English Flag">
                                ENG
                            </div>
                            <div>
                                <img src="https://flagcdn.com/w40/vn.png" alt="French Flag">
                                VN
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom">
                <nav class="main-nav">
                    <a href="#" class="nav-item">
                        <i class="fas fa-map-marker-alt location-icon"></i> Chọn rạp
                    </a>
                    <a href="#" class="nav-item">
                        <i class="fas fa-map-marker-alt location-icon"></i> Lịch chiếu
                    </a>
                </nav>
                <nav class="extra-nav">
                    <a href="{{ route('khuyenmai') }}" class="extra-item">Khuyến mãi</a>
                    <a href="{{ route('tochucsukien') }}" class="extra-item">Thuê sự kiện</a>
                    <a href="{{ route('giaitri') }}" class="extra-item">Tất cả các giải trí</a>
                    <a href="{{ route('gioithieu') }}" class="extra-item">Giới thiệu</a>
                </nav>
            </div>
        </header>
        <main class="app-main">{{$slot}}</main>
        <footer class="footer">
            <div class="footer-container">
                <div class="footer-top" style="display:flow;">
                    <div class="footer-cinestar" style="float:left;">
                        <div class="logo">
                            <img src="{{ asset("Resources/Images/DefaultPage/logocinestar.webp") }}"
                                alt="Cinestar Logo" />
                        </div>
                        <h4>BE HAPPY, BE A STAR</h4>

                        <div>
                            <button class="btn yellow" id="footer-booking-ticket">
                                <b>ĐẶT VÉ</b>
                            </button>

                        </div>
                        <div class="footer-social-media">
                            <a href="#">
                                <img src="{{ asset("Resources/Images/DefaultPage/facebook-logo.png") }}" alt="Facebook"
                                    class="image_footer" />
                            </a>
                            <a href="#">
                                <img src="{{ asset("Resources/Images/DefaultPage/youtube.png") }}" alt="Youtube"
                                    class="image_footer" />
                            </a>
                            <a href="#">
                                <img src="{{ asset("Resources/Images/DefaultPage/tiktok.png") }}" alt="Tiktok"
                                    class="image_footer" />
                            </a>
                            <a href="#">
                                <img src="{{ asset("Resources/Images/DefaultPage/icons8-zalo-48.png") }}" alt="Zalo"
                                    class="image_footer" />
                            </a>
                        </div>
                        <div class="footer-language">
                            Ngôn ngữ:
                            <img src="{{ asset("Resources/Images/DefaultPage/footer-vietnam.svg") }}"
                                alt="Cinestar Logo" class="image_footer" />
                            VN
                        </div>
                    </div>
                    <div class="footer-links" style="float:right;">
                        <div class="footer-column">
                            <h3>TÀI KHOẢN</h3>
                            <ul>
                                <li>Đăng nhập</li>
                                <li>Đăng ký</li>
                                <li>Membership</li>
                            </ul>
                            <h3>XEM PHIM</h3>
                            <ul>
                                <li>Phim đang chiếu</li>
                                <li>Phim sắp chiếu</li>
                                <li>Suất chiếu đặc biệt</li>
                            </ul>
                        </div>
                        <div class="footer-column">
                            <h3>THUÊ SỰ KIỆN</h3>
                            <ul>
                                <li>Thuê rạp</li>
                                <li>Các loại hình cho thuê khác</li>
                            </ul>
                            <h3>CINESTAR</h3>
                            <ul>
                                <li>Giới thiệu</li>
                                <li>Liên hệ</li>
                                <li>Tuyển dụng</li>
                            </ul>
                        </div>

                        <div class="footer-column">
                            <h3>DỊCH VỤ KHÁC</h3>
                            <ul>
                                <li>Nhà hàng</li>
                                <li>Kidzone</li>
                                <li>Bowling</li>
                                <li>Billiards</li>
                                <li>Gym</li>
                                <li>Nhà hát Opera</li>
                                <li>Coffee</li>
                            </ul>
                        </div>
                        <div class="footer-column">
                            <h3>HỆ THỐNG RẠP</h3>
                            <ul>
                                <li>Tất cả hệ thống rạp</li>
                                <li>Cinestar Quốc Thanh</li>
                                <li>Cinestar Hai Bà Trưng (TP.HCM)</li>
                                <li>Cinestar Sinh Viên (Bình Dương)</li>
                                <li>Cinestar Mỹ Tho</li>
                                <li>Cinestar Kiên Giang</li>
                                <li>Cinestar Lâm Đồng</li>
                                <li>Cinestar Đà Lạt</li>
                                <li>Cinestar Huế</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <br style="clear:both;">
                <hr />
                <div class="footer-bot">
                    <div class="copyright">© 2023 Cinestar. All rights reserved.</div>
                    <div class="links">
                        <a href="#">Chính sách bảo mật</a>
                        <a href="#">Tin điện ảnh</a>
                        <a href="#">Hỏi và đáp</a>
                    </div>
                </div>
                <div class="footer-info">
                    <div class="footer-content">
                        <div class="footer-notice">
                            <img src="{{ asset("Resources/Images/DefaultPage/bocongthuong.webp") }}" alt="Kidzone" />
                        </div>
                        <div class="footer-details">
                            <p>
                                CÔNG TY CỔ PHẦN GIẢI TRÍ PHÁT HÀNH PHIM - RẠP CHIẾU PHIM NGÔI
                                SAO<br />
                                ĐỊA CHỈ: 135 HAI BÀ TRƯNG, PHƯỜNG BẾN NGHÉ, QUẬN 1, TP.HCM<br />
                                GIẤY CNĐKDN SỐ: 0312742744, ĐĂNG KÝ LẦN ĐẦU NGÀY
                                18/04/2014,<br />
                                ĐĂNG KÝ THAY ĐỔI LẦN THỨ 2 NGÀY 15/09/2014, CẤP BỞI SỞ KH&ĐT
                                TP.HCM
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

</body>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function() {
    $("#btn-booking-now").click(function() {
        window.location.href = "{{ route('homeindex') }}";
    });
});
</script>

</html>