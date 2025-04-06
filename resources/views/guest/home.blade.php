<x-index-guest>
    <x-slot name="title">
        Cinestar
    </x-slot>
    <div class="km">
        <div class="banner">
            <div id="demo" class="carousel slide" data-bs-ride="carousel">
                <!-- Indicators/dots -->
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
                </div>

                <!-- The slideshow/carousel -->
                <div class="carousel-inner" style="justify-items: center; height: 400px;">
                    <div class="carousel-item active">
                        <img src="{{ asset('Resources/Images/DefaultPage/thieunu.jpg') }} " class="d-block"
                            style="width:100%; height: 80%;">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('Resources/Images/DefaultPage/iu.jpg') }} " class="d-block"
                            style="width:100%; height: 80%;">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('Resources/Images/DefaultPage/cuocxe.jpg') }} " class="d-block"
                            style="width:100%; height: 80%;">
                    </div>
                </div>

                <!-- Left and right controls/icons -->
                <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>

        <div class="quick-booking" id="quick-booking">
            <h2>ĐẶT VÉ NHANH</h2>
            <select class="booking-dropdown" id="phim-dropdown">
                <option value="" disabled selected hidden>1. Chọn Phim</option>
                @foreach($phimDangChieu as $phim)
                <option value="{{ $phim->maPhim }}">{{ $phim->ten }}</option>
                @endforeach
            </select>
            <select class="booking-dropdown" id="ngay-dropdown" disabled>
                <option value="" disabled selected hidden>2. Chọn Ngày</option>
            </select>
            <select class="booking-dropdown" id="suat-dropdown" disabled>
                <option value="" disabled selected hidden>3. Chọn Suất</option>
            </select>
            <button class="btn-book-now" id="btn-dat-ngay" disabled>ĐẶT NGAY</button>
        </div>
    </div>

    <div class="phim-dang-chieu">
        <h1>PHIM ĐANG CHIẾU</h1>
        <div class="movie-list">
            <?php $i=1; ?>
            @foreach($phimDangChieu as $phim)
            <?php $i++;?>
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
            @if($i > 3)
            @break
            @endif
            @endforeach
        </div>
        <button class="see-more-btn"><a href="{{ route('phimdangchieu') }}"
                style="text-decoration:none; color:black;"><b>XEM THÊM</b></a></button>
    </div>

    <div class="phim-sap-chieu">
        <h1>PHIM SẮP CHIẾU</h1>
        <div class="movie-list">
            <?php $j=1; ?>
            @foreach($phimSapChieu as $phim)
            <?php $j++;?>
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
            @if($j > 3)
            @break
            @endif
            @endforeach
        </div>
        <button class="see-more-btn"><a href="{{ route('phimsapchieu') }}"
                style="text-decoration:none; color:black;"><b>XEM THÊM</b></a></button>
    </div>
    <section class="promotions" style="margin-bottom:10px;">
        <div>
            <h1 class="text-center">KHUYẾN MÃI</h1>
            <div id="promotionCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner" style="background-color: var(--bs-body-bg);">
                    <div class="carousel-item active">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ asset('Resources/Images/DefaultPage/km1.webp') }}" class="d-block w-100"
                                    alt="Ngày Thành Viên">

                            </div>
                            <div class="col-md-4">
                                <img src="{{ asset('Resources/Images/DefaultPage/km1.webp') }}" class="d-block w-100"
                                    alt="Học Sinh Sinh Viên">

                            </div>
                            <div class="col-md-4">
                                <img src="{{ asset('Resources/Images/DefaultPage/km2.webp') }}" class="d-block w-100"
                                    alt="Ưu Đãi Trước 10h">

                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ asset('Resources/Images/DefaultPage/km3.jpeg') }}" class="d-block w-100"
                                    alt="Ưu Đãi Sau 10h">

                            </div>
                            <!-- Thêm các khuyến mãi khác vào đây nếu có -->
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#promotionCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#promotionCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>
    <section class="members">
        <div class="member-card">
            <img src="{{ asset('Resources/Images/DefaultPage/thanhvien-cfriend.webp') }}" alt="Thành viên C'FRIEND" />
            <div class="member-info">
                <h3>THÀNH VIÊN C'FRIEND</h3>
                <p>Thẻ C'Friend nhiều ưu đãi cho thành viên mới.</p>
                <button class="member-info-btn"><b>TÌM HIỂU NGAY</b></button>
            </div>
        </div>
        <div class="member-card">
            <img src="{{ asset("Resources/Images/DefaultPage/thanhvien-cvip.webp") }}" alt="Thành viên C'VIP" />
            <div class="member-info">
                <h3>THÀNH VIÊN C'VIP</h3>
                <p>Thẻ VIP CineStar mang đến sự ưu đãi độc quyền.</p>
                <button class="member-info-btn"><b>TÌM HIỂU NGAY</b></button>
            </div>
        </div>
    </section>
    <section class="entertainment">
        <h2>TẤT CẢ CÁC GIẢI TRÍ</h2>
        <p>
            Ngoài hệ thống rạp chiếu phim chất lượng cao, Cinestar còn cung cấp
            cho bạn nhiều loại hình giải trí tuyệt vời khác.
        </p>
        <div class="entertainment-grid">
            <div class="entertainment-card">
                <img src="{{ asset("Resources/Images/DefaultPage/kidzone.webp") }}" alt="Kidzone" />
            </div>
            <div class="entertainment-card">
                <img src="{{ asset("Resources/Images/DefaultPage/bowling.webp") }}" alt="Bowling" />
            </div>
            <div class="entertainment-card">
                <img src="{{ asset("Resources/Images/DefaultPage/billirard.webp") }}" alt="Billiards" />
            </div>
            <div class="entertainment-card">
                <img src="{{ asset("Resources/Images/DefaultPage/monngon.webp") }}" alt="Món Ngon" />
            </div>
            <div class="entertainment-card">
                <img src="{{ asset("Resources/Images/DefaultPage/gym.webp") }}" alt="Gym" />
            </div>
            <div class="entertainment-card">
                <img src="{{ asset("Resources/Images/DefaultPage/opera.webp") }}" alt="Dalat Opera House" />
            </div>
        </div>
    </section>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const phimDropdown = document.getElementById('phim-dropdown');
        const ngayDropdown = document.getElementById('ngay-dropdown');
        const suatDropdown = document.getElementById('suat-dropdown');
        const btnDatNgay = document.getElementById('btn-dat-ngay');

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
                fetch(`/get-ngay-chieu/${maPhim}`)
                    .then(response => response.json())
                    .then(data => {
                        ngayDropdown.innerHTML =
                            '<option value="" disabled selected hidden>Chọn Ngày</option>';
                        if (data.length > 0) {
                            data.forEach(ngay => {
                                ngayDropdown.innerHTML +=
                                    `<option value="${ngay}">${formatDate(ngay)}</option>`;
                            });
                            ngayDropdown.disabled = false;
                        } else {
                            alert("Không có lịch chiếu cho phim này!");
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
                fetch(`/get-suat-chieu/${maPhim}/${ngayChieu}`)
                    .then(response => response.json())
                    .then(data => {
                        suatDropdown.innerHTML =
                            '<option value="" disabled selected hidden>Chọn Suất</option>';
                        if (data.length > 0) {
                            data.forEach(suat => {
                                suatDropdown.innerHTML +=
                                    `<option value="${suat.suatChieu}">${suat.suatChieu} - ${suat.loaiChieu}</option>`;
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
                fetch(
                        `/get-ma-lich-chieu-phim?maPhim=${maPhim}&ngayChieu=${ngayChieu}&gioBatDau=${suatChieu}`
                    )
                    .then(response => response.json())
                    .then(data => {
                        if (data.maLichChieuPhim) {
                            // Chuyển hướng đến route Laravel thay vì index.php
                            window.location.href = `/dat-ghe/${data.maLichChieuPhim}`;
                        } else {
                            alert(data.error || 'Không thể tìm thấy lịch chiếu.');
                        }
                    })
                    .catch(error => {
                        console.error('Lỗi khi gọi API lấy maLichChieuPhim:', error);
                        alert('Có lỗi xảy ra khi xử lý. Vui lòng thử lại sau.');
                    });
            } else {
                alert('Vui lòng chọn đầy đủ thông tin trước khi đặt vé.');
            }
        });
    });

    /*   document.addEventListener("DOMContentLoaded", function() {
           console.log("DOM fully loaded and parsed.");

           // Lấy danh sách ngày chiếu khi chọn phim
           document.getElementById('phim-dropdown').addEventListener('change', function() {
               const maPhim = this.value;
               console.log(`Phim được chọn: ${maPhim}`);
               if (maPhim) {
                   fetch(`/get-ngay-chieu/${maPhim}`)
                       .then(response => response.json())
                       .then(data => {
                           console.log("Dữ liệu ngày chiếu nhận được:", data);
                           const ngayDropdown = document.getElementById('ngay-dropdown');
                           ngayDropdown.innerHTML =
                               '<option value="" disabled selected hidden>2. Chọn Ngày</option>';

                           if (data.length > 0) {
                               data.forEach(ngay => {
                                   ngayDropdown.innerHTML +=
                                       `<option value="${ngay}">${ngay}</option>`;
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
           document.getElementById('ngay-dropdown').addEventListener('change', function() {
               const maPhim = document.getElementById('phim-dropdown').value;
               const ngayChieu = this.value;
               console.log(`Ngày được chọn: ${ngayChieu} cho phim: ${maPhim}`);

               if (maPhim && ngayChieu) {
                   fetch(`/get-suat-chieu/${maPhim}/${ngayChieu}`)
                       .then(response => response.json())
                       .then(data => {
                           console.log("Dữ liệu suất chiếu nhận được:", data);
                           const suatDropdown = document.getElementById('suat-dropdown');
                           suatDropdown.innerHTML =
                               '<option value="" disabled selected hidden>3. Chọn Suất</option>';

                           if (data.length > 0) {
                               data.forEach(suat => {
                                   suatDropdown.innerHTML +=
                                       `<option value="${suat}">${suat}</option>`;
                               });
                               suatDropdown.disabled = false;
                               document.getElementById('btn-dat-ngay').disabled = false;
                           } else {
                               suatDropdown.innerHTML +=
                                   '<option value="">Không có suất chiếu</option>';
                               suatDropdown.disabled = true;
                               document.getElementById('btn-dat-ngay').disabled = true;
                           }
                       })
                       .catch(error => console.error('Lỗi khi lấy suất chiếu:', error));
               }
           });
           document.getElementById('btn-dat-ngay').addEventListener('click', function() {
               const maPhim = document.getElementById('phim-dropdown').value;
               const ngayChieu = document.getElementById('ngay-dropdown').value;
               const suatChieu = document.getElementById('suat-dropdown').value;

               console.log(`Đặt vé: Phim ${maPhim}, Ngày ${ngayChieu}, Suất ${suatChieu}`);

               if (maPhim && ngayChieu && suatChieu) {
                   fetch(`/get-ma-lich-chieu-phim/${maPhim}/${ngayChieu}/${suatChieu}`)
                       .then(response => response.json())
                       .then(data => {
                           if (data.maLichChieuPhim) {
                               console.log("maLichChieuPhim nhận được:", data.maLichChieuPhim);
                               // Chuyển hướng đến trang đặt ghế
                               window.location.href =
                                   `index.php?action=datghe&maLichChieuPhim=${data.maLichChieuPhim}`;
                           } else {
                               alert(data.error || 'Không thể tìm thấy lịch chiếu.');
                           }
                       })
                       .catch(error => {
                           console.error('Lỗi khi gọi API lấy maLichChieuPhim:', error);
                           alert('Có lỗi xảy ra khi xử lý. Vui lòng thử lại sau.');
                       });
               }
           });
       });

       function scrollToMain() {
           const section = document.getElementById("quick-booking");
           if (section) {
               console.log("Found the section:", section);
               section.scrollIntoView({
                   behavior: "smooth"
               });
           } else {
               console.error("Section with ID 'quick-booking' not found.");
           }
       }*/
    </script>
</x-index-guest>