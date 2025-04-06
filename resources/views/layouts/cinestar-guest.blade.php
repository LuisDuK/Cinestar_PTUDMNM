<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="shortcut icon" href="https://cinestar.com.vn/pictures/logo/favicon.ico" />
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
                    <a href="index.php?action=trangchu"> <img src="Resources/Images/logocinestar.webp"
                            alt="Cinestar Logo" /></a>
                </div>
                <div class="actions">
                    <button class="btn yellow" onclick="scrollToMain()">
                        <img src="Resources/Images/ic-ticket.svg" alt="ảnh"
                            style="width: 20px; height: 20px; margin-bottom: 2px" />
                        <b>ĐẶT VÉ NGAY</b>
                    </button>
                    <button class="btn purple">
                        <img src="Resources/Images/ic-cor.svg" alt="ảnh" style="
                  width: 20px;
                  height: 20px;
                  margin-right: 5px;
                  margin-bottom: 2px;
                " /> <a style="text-decoration:none; color:white;" href="index.php?action=datbapnuoc"><b>ĐẶT BẮP
                                NƯỚC</b></a>
                    </button>
                </div>
                <div class="search">
                    <input type="text" placeholder="Tìm phim, rạp" />
                    <button class="search-btn">🔍</button>
                </div>
                <div class="user-actions">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <?php  if (isset($_SESSION['maTaiKhoan'])): ?>
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Xin chào, <?php echo htmlspecialchars($_SESSION['hoTen']); ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown"
                                style="background: linear-gradient(to left, #131921, #49136b);">
                                <li>
                                    <a class="dropdown-item" style="color:white;"
                                        href="index.php?action=thongtincanhan">
                                        Thông tin cá nhân
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" style="color:white;" href="index.php?action=giohang">
                                        Giỏ hàng
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" style="color:white;" href="index.php?action=dangxuat">
                                        Đăng xuất
                                    </a>
                                </li>
                            </ul>
                            <?php else: ?>
                            <a href="index.php?action=dangnhap" class="user-login">
                                <img src="Resources/Images/ic-header-auth.svg" alt="Cinestar Logo"
                                    style="width: 30px; height: 30px; margin-bottom: 2px" />
                                <b>Đăng nhập</b>
                            </a>
                            <?php endif; ?>
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
                    <a href="index.php?action=khuyenmai" class="extra-item">Khuyến mãi</a>
                    <a href="index.php?action=thuesukien" class="extra-item">Thuê sự kiện</a>
                    <a href="index.php?action=tatcahinhthucgiaitri" class="extra-item">Tất cả các giải trí</a>
                    <a href="index.php?action=gioithieu" class="extra-item">Giới thiệu</a>
                </nav>
            </div>
        </header>
        <main class="app-main">{{$slot}}</main>
        <footer class="footer">
            <div class="footer-container">
                <div class="footer-top" style="display:flow;">
                    <div class="footer-cinestar" style="float:left;">
                        <div class="logo">
                            <img src="Resources/Images/logocinestar.webp" alt="Cinestar Logo" />
                        </div>
                        <h4>BE HAPPY, BE A STAR</h4>

                        <div>
                            <button class="btn yellow" id="footer-booking-ticket">
                                <b>ĐẶT VÉ</b>
                            </button>
                            <button class="btn purple" id="footer-booking-corn">
                                <b>ĐẶT BẮP NƯỚC</b>
                            </button>
                        </div>
                        <div class="footer-social-media">
                            <a href="#">
                                <img src="Resources/Images/facebook-logo.png" alt="Facebook" class="image_footer" />
                            </a>
                            <a href="#">
                                <img src="Resources/Images/youtube.png" alt="Youtube" class="image_footer" />
                            </a>
                            <a href="#">
                                <img src="Resources/Images/tiktok.png" alt="Tiktok" class="image_footer" />
                            </a>
                            <a href="#">
                                <img src="Resources/Images/icons8-zalo-48.png" alt="Zalo" class="image_footer" />
                            </a>
                        </div>
                        <div class="footer-language">
                            Ngôn ngữ:
                            <img src="Resources/Images/footer-vietnam.svg" alt="Cinestar Logo" class="image_footer" />
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
                            <img src="Resources/Images/bocongthuong.webp" alt="Kidzone" />
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
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Lấy các phần tử từ DOM
        const phimDropdown = document.getElementById('phim-dropdown');
        const ngayDropdown = document.getElementById('ngay-dropdown');
        const suatDropdown = document.getElementById('suat-dropdown');
        const btnDatNgay = document.getElementById('btn-dat-ngay');

        // Hàm định dạng ngày dd/mm/yyyy
        function formatDate(inputDate) {
            const date = new Date(inputDate);
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const year = date.getFullYear();
            return `${day}/${month}/${year}`;
        }

        // Lấy danh sách ngày chiếu khi chọn phim
        phimDropdown.addEventListener('change', function() {
            const maPhim = this.value;
            if (maPhim) {
                console.log(`Fetching ngày chiếu for maPhim=${maPhim}`);
                fetch(`modules/trangchu/getNgayChieu.php?maPhim=${maPhim}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log("Ngày chiếu nhận được:", data);
                        ngayDropdown.innerHTML =
                            '<option value="" disabled selected hidden>3. Chọn Ngày</option>';
                        if (data.length > 0) {
                            data.forEach(ngay => {
                                ngayDropdown.innerHTML +=
                                    `<option value="${ngay}">${formatDate(ngay)}</option>`;
                            });
                            ngayDropdown.disabled = false;
                        } else {
                            ngayDropdown.innerHTML +=
                                '<option value="">Không có ngày chiếu</option>';
                            ngayDropdown.disabled = true;
                        }
                    })
                    .catch(error => console.error('Lỗi khi lấy ngày chiếu:', error));
            }
        });

        // Lấy danh sách suất chiếu khi chọn ngày
        ngayDropdown.addEventListener('change', function() {
            const maPhim = phimDropdown.value;
            const ngayChieu = this.value;
            if (maPhim && ngayChieu) {
                console.log(`Fetching suất chiếu for maPhim=${maPhim}, ngayChieu=${ngayChieu}`);
                fetch(`modules/trangchu/getSuatChieu.php?maPhim=${maPhim}&ngayChieu=${ngayChieu}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log("Suất chiếu nhận được:", data);
                        suatDropdown.innerHTML =
                            '<option value="" disabled selected hidden>4. Chọn Suất</option>';
                        if (data.length > 0) {
                            data.forEach(suat => {
                                suatDropdown.innerHTML +=
                                    `<option value="${suat.gioBatDau}">${suat.gioBatDau} - ${suat.loaiHinhChieu}</option>`;
                            });
                            suatDropdown.disabled = false;
                            btnDatNgay.disabled = false;
                        } else {
                            suatDropdown.innerHTML +=
                                '<option value="">Không có suất chiếu</option>';
                            suatDropdown.disabled = true;
                            btnDatNgay.disabled = true;
                        }
                    })
                    .catch(error => console.error('Lỗi khi lấy suất chiếu:', error));
            }
        });

        // Xử lý khi bấm nút "Đặt Ngay"
        btnDatNgay.addEventListener('click', function() {
            const maPhim = phimDropdown.value;
            const ngayChieu = ngayDropdown.value;
            const suatChieu = suatDropdown.value;

            if (maPhim && ngayChieu && suatChieu) {
                console.log(
                    `Redirecting to phim_detail.php?maPhim=${maPhim}&ngayChieu=${ngayChieu}&suatChieu=${suatChieu}`
                );
                window.location.href =
                    `modules/trangchu/phim_detail.php?maPhim=${maPhim}&ngayChieu=${ngayChieu}&suatChieu=${suatChieu}`;
            }
        });
    });
    </script>

</body>

</html>
<?php
ob_end_flush(); // Kết thúc buffer
?>