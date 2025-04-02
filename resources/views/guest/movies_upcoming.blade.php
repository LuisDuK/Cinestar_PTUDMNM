<x-index-guest>
    <x-slot name="title">Phim đang chiếu</x-slot>
    <div class="container" style="background-color:unset;">
        <section class="now-showing">
            <h2 style="color: white">PHIM SẮP CHIẾU</h2>
            <div class="movie-list">
                @if($phimSapChieu->count() > 0)
                @foreach($phimSapChieu as $phim)
                <div class="movie-card">
                    <img src="{{ asset('Resources/' . $phim->hinhAnh) }}" alt="{{ $phim->ten }}" />
                    <h3>{{ $phim->ten }} ({{ $phim->namSanXuat }})</h3>
                    <p style="color:white">Đạo diễn: {{ $phim->tenDaoDien }}</p>
                    <p style="color:white">Thời lượng: {{ $phim->thoiLuong }} phút</p>
                    <div class="movie-actions">
                        <a href="{{ $phim->trailer }}" target="_blank" class="trailer-btn">Xem Trailer</a>
                        <a class="book-btn" href="{{ route('phim', ['maPhim' => $phim->maPhim]) }}"><b>CHI TIẾT</b></a>
                    </div>
                </div>
                @endforeach
                @else
                <p>Không có phim nào sắp chiếu.</p>
                @endif
            </div>
        </section>
    </div>
</x-index-guest>