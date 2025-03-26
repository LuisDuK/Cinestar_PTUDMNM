<x-index-guest>
    <x-slot name="title">
        {{ $tenphim->ten }}
    </x-slot>
    <div id="nav-seat">
        <ul>
            <li><a href="#" id="first">CHỌN LỊCH CHIẾU</a></li>
            <li><a href="#" id="second">CHỌN NGÀY</a></li>
            <li><a href="#" id="third">THANH TOÁN</a></li>
        </ul>
    </div>

    <div class="showtime">
        <div class="showtime_main">
            <div id="select-showtime-details">
                @foreach ($ngayChieus as $ngayChieu)
                <div id="showtime-details">
                    @foreach ($phongChieuTheoNgay[$ngayChieu->ngayChieu] as $phong)
                    <div class="widget">
                        <div class="schedule-list">
                            <div class="location">
                                Phòng: {{ $phong->maPhongChieuPhim }} (Ngày: {{ $ngayChieu->ngayChieu }})
                            </div>
                            <div class="theatre-list">
                                <ul>
                                    @foreach ($lichChieuTheoPhong[$ngayChieu->ngayChieu][$phong->maPhongChieuPhim] as
                                    $lich)
                                    <li>
                                        <a href="{{ route('dat-ghe', ['maLichChieuPhim' => $lich->maLichChieuPhim]) }}">
                                            {{ date('h:i A', strtotime($lich->suatChieu)) }}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endforeach
            </div>
        </div>
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
        <button class="see-more-btn"><a href="{{ route('phimdangchieu') }}"
                style="text-decoration:none; color:black;"><b>XEM THÊM</b></a></button>
    </div>
</x-index-guest>