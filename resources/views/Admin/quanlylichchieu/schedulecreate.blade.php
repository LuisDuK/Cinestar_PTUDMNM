<x-index-admin>
    <x-slot name="title">
        Điều chỉnh lịch chiếu
    </x-slot>
    <style>
    .pagination p {
        display: none !important;
    }

    .pagination span,
    .pagination a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        height: 30px;
        min-width: 40px;
        padding: 8px 12px;
        border-radius: 5px;
    }
    </style>
    <div class="add-schedule-container" style="height: 700px;">
        <h1>Thêm Lịch Chiếu</h1>
        <div class="schedule-top-section">
            <form method="POST" action="{{ route('quanlylichchieu.handleSubmit') }}" id="update-schedule-form">
                @csrf
                <input type="hidden" name="action" value="quanlylichchieu">
                <input type="hidden" name="query" value="themlichchieu">
                <input type="hidden" name="trang" value="{{ request('trang', 1) }}">

                <div class="schedule-input-with-icon">
                    <label for="schedule-choose-date">Ngày chiếu:</label>
                    <input type="date" id="schedule-choose-date" name="ngayChieu" class="schedule-input"
                        value="{{ request('ngayChieu', $ngayChieu) }}" min="{{ $ngayBatDau }}"
                        max="{{ $ngayKetThuc }}" />

                </div>

                <div class="schedule-time-selector">
                    <div class="time-group">
                        @foreach (["09:00", "12:00", "13:30", "14:45", "16:00", "17:00"] as $index => $time)
                        <label>
                            <input type="radio" id="gioChieu{{ $index }}" name="gioChieu" value="{{ $time }}"
                                {{ request('gioChieu', $gioChieu) === $time ? 'checked' : '' }}>

                            <span class="custom-radio"></span>{{ $time }}
                        </label>
                        @endforeach
                    </div>
                    <div class="time-group">
                        @foreach (["18:30", "19:30", "20:00", "20:45", "22:00", "23:00"] as $index => $time)
                        <label>
                            <input type="radio" id="gioChieu{{ $index+6 }}" name="gioChieu" value="{{ $time }}"
                                {{ old('gioChieu', $gioChieu) === $time ? 'checked' : '' }}>
                            <span class="custom-radio"></span>{{ $time }}
                        </label>
                        @endforeach
                    </div>
                </div>

                <input type="hidden" name="ngayBatDau" value="{{ $ngayBatDau }}">
                <input type="hidden" name="ngayKetThuc" value="{{ $ngayKetThuc }}">

                <button type="submit" class="btn-update">Cập nhật</button>
            </form>
        </div>

        <div class="schedule-main-content">
            <div class="room" style="width: 50%; ">
                <div class="schedule-cinema-section" style="width: 100%; height: 450px;">
                    @foreach ($phongChieu as $phong)
                    @php
                    $lichPhim = DB::table('lichchieuphim')
                    ->join('phim', 'lichchieuphim.maPhim', '=', 'phim.maPhim')
                    ->join('phongchieuphim', 'lichchieuphim.maPhongChieuPhim', '=', 'phongchieuphim.maPhongChieu')
                    ->select('lichchieuphim.*', 'phim.ten as tenPhim', 'phongchieuphim.tenPhongChieu')
                    ->where('lichchieuphim.maPhongChieuPhim', $phong->maPhongChieu)
                    ->where('lichchieuphim.ngayChieu', $ngayChieu)
                    ->where('lichchieuphim.suatChieu', $gioChieu)
                    ->first();

                    $previousData = json_encode([
                    "maPhim" => $lichPhim->maPhim ?? null,
                    "loaiHinhChieu" => $lichPhim->loaiChieu ?? "2D",
                    "giaVe"=>$lichPhim->giave??null,
                    ]);
                    @endphp

                    <div class="schedule-cinema" data-cinema-id="{{ $phong->maPhongChieu }}"
                        data-previous='{{ $previousData }}'>

                        <h2>{{ $phong->tenPhongChieu }}</h2>

                        <div class="movie-details">
                            <label>Loại hình chiếu:</label>
                            <select class="loaiHinhChieu"
                                name="loaiHinhChieu[{{ $lichPhim ? $lichPhim->maLichChieuPhim : 'new' }}]"
                                style="background-color:white; color:black;">
                                <option value="2D" {{ $lichPhim && $lichPhim->loaiChieu == '2D' ? 'selected' : '' }}>2D
                                </option>
                                <option value="3D" {{ $lichPhim && $lichPhim->loaiChieu == '3D' ? 'selected' : '' }}>3D
                                </option>
                                <option value="IMAX"
                                    {{ $lichPhim && $lichPhim->loaiChieu == 'IMAX' ? 'selected' : '' }}>IMAX</option>
                            </select>

                            <label style="margin-top:5px;">Giá vé:</label>
                            <input type="number" class="giaVe"
                                name="giaVe[{{ $lichPhim ? $lichPhim->maLichChieuPhim : 'new' }}]"
                                style="background-color:white; color:black; width: 80px;"
                                value="{{ $lichPhim ? $lichPhim->giave : '' }}" min="0">

                            <p class="movie-title" data-movie-id="{{ $lichPhim ? $lichPhim->maPhim : '' }}">
                                {{ $lichPhim ? $lichPhim->tenPhim : 'Chưa có phim' }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="pagination">
                    {{ $phongChieu->appends(request()->except('page'))->appends(['page_phim' => request('page_phim')])->links() }}
                </div>
            </div>



            <div class="schedule-movie-list">
                <div class="schedule-movies-section">
                    @foreach ($phimDangChieu as $phim)
                    <a class="schedule-btn" draggable="true" data-movie-id="{{ $phim->maPhim }}">
                        {{ $phim->ten }}<br>({{ $phim->soLuongSuatChieu }} suất chiếu)
                    </a>
                    @endforeach
                </div>
                <div class="pagination">
                    {{ $phimDangChieu->appends(request()->except('page'))->appends(['page_phong' => request('page_phong')])->links() }}
                </div>
            </div>

        </div>
        <button type="button" class="btn btn-success btn-save-schedule" onclick="saveSchedule()">Lưu lịch chiếu</button>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div id="schedule-modal" class="class-schedule-modal">
            <div class="schedule-modal-content">
                <span class="schedule-close-button">&times;</span>
                <p id="schedule-notification-message"></p>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/schedule.js') }}">

    </script>
</x-index-admin>