<x-index-guest>
    <x-slot name="title"> {{$movie->ten  }}</x-slot>
    <div class="bg-[#0b1120] text-white font-sans" style="margin-bottom:40px;">
        <div class="p-6">
            <div style="display: flex; align-items: flex-start; gap: 20px;">
                <!-- Ảnh phim -->
                <div style="width: 20%;">
                    <img src="{{ asset('Resources/' . $movie->hinhAnh) }}" class="rounded-lg shadow-lg w-full"
                        style="height: 600px;" alt="{{ $movie->ten }}">
                </div>

                <!-- Thông tin phim -->
                <div style="width: 50%; margin-left:200px; margin-top:20px;">
                    <h1 class="text-3xl font-bold">{{ $movie->ten }}</h1>
                    <div class="mt-4">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-tags text-yellow-500 mr-2"></i>
                            <span style="color:white;">{{ $movie->tenLoaiPhim }}</span>
                        </div>
                        <div class="flex items-center mb-2">
                            <i class="fas fa-clock text-yellow-500 mr-2"></i>
                            <span style="color:white;">{{ $movie->thoiLuong }} phút</span>
                        </div>
                        <div class="flex items-center mb-2">
                            <i class="fas fa-globe text-yellow-500 mr-2"></i>
                            <span style="color:white;">{{ $movie->tenQuocGia ?? 'Đang cập nhật' }}</span>
                        </div>
                        <div class="flex items-center mb-2">
                            <i class="fas fa-tv text-yellow-500 mr-2"></i>
                            <span style="color:white;">{{ $movie->trangThai }}</span>
                        </div>

                        <div class="mt-6">
                            <h2 class="text-xl font-semibold">Mô tả</h2>
                            <p class="mt-2">{{ nl2br(e($movie->moTa ?? 'Đang cập nhật')) }}</p>
                        </div>

                        @if ($lichChieu->count() > 0)
                        <div id="btnShowtime">
                            <button class="btn yellow" style="height:50px;">
                                <img src="{{ asset('Resources/Images/DefaultPage/ic-ticket.svg') }}" alt="ảnh"
                                    style="width: 20px; height: 20px; margin-bottom: 2px" />
                                <a style="text-decoration:none; color:black;"
                                    href="{{ route("lich-chieu",['maPhim' => $movie->maPhim]) }}">
                                    <b>CHỌN LỊCH</b>
                                </a>
                            </button>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Trailer -->
        <div class="detail_lc" style="text-align: center;">
            <h1>Trailer</h1>
            <iframe width="100%" height="600px" src="{{ $movie->trailer }}" title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen>
            </iframe>
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