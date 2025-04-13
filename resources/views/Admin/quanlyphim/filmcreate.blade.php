<x-index-admin>
    <x-slot name="title">Thêm phim</x-slot>
    <div class="add-movie-container">
        <div class="add-movie-form-container">
            <h1 STYLE="COLOR:BLUE;">THÊM PHIM</h1>
            @if(session('success'))
            <div class="alert alert-success" style="background-color: white; ">
                {{ session('success') }}
            </div> <br>
            @endif

            @if(session('error'))
            <div class="alert alert-danger" style="background-color: white;">
                {{ session('error') }}
            </div><br>
            @endif
            @if ($errors->has('new_password'))
            <div class="alert alert-danger" style="background-color: white; ">
                <ul>
                    <li>{{ $errors->first('new_password') }}</li>
                </ul>
            </div><br>
            @endif

            <form method="POST" action="{{ route('quanlyphim.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="add-movie-form-group">
                    <label for="ten-phim">Tên phim</label>
                    <input class="movies-input" id="ten-phim" type="text" name="ten-phim" placeholder="Tên phim"
                        required />
                </div>
                <div style="margin-left:10px;">
                    <label for="the-loai" style="font-weight: bold; ">Thể loại:</label>
                    <div class="add-movie-form-group" style="display: grid; grid-template-columns: repeat(4, 1fr);">
                        @foreach ($genres as $genre)
                        <div>
                            <input type="checkbox" name="theLoai[]" value="{{ $genre->maLoaiPhim }}">
                            {{ $genre->tenLoaiPhim }}
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="add-movie-form-group">
                    <label for="thoi-luong">Thời lượng (phút)</label>
                    <input class="movies-input" id="thoi-luong" type="text" name="thoi-luong"
                        placeholder="Bao nhiêu phút" required />
                </div>

                <div class="add-movie-form-group">
                    <label for="mo-ta">Mô tả</label>
                    <input class="movies-input" id="mo-ta" name="mo-ta" placeholder="Nhập mô tả" type="text" required />
                </div>

                <div class="add-movie-form-group">
                    <label for="quoc-gia">Quốc gia</label>
                    <select class="movies-input" id="quoc-gia" name="quoc-gia" required>
                        <option value="">Chọn quốc gia</option>
                        @foreach ($countries as $country)
                        <option value="{{ $country->maQuocGia }}">{{ $country->tenQuocGia }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="add-movie-form-group">
                    <label for="dao-dien">Đạo diễn</label>
                    <input class="movies-input" id="dao-dien" type="text" name="dao-dien" placeholder="Đạo diễn"
                        required />
                </div>

                <div class="add-movie-form-group">
                    <label for="nam-san-xuat">Năm sản xuất</label>
                    <input class="movies-input" id="nam-san-xuat" type="text" name="nam-san-xuat"
                        placeholder="Năm sản xuất" required />
                </div>

                <div class="add-movie-form-group">
                    <label for="trang-thai">Trạng thái</label>
                    <select class="movies-input" name="trang-thai">
                        <option value="Đang chiếu">Đang chiếu</option>
                        <option value="Sắp chiếu">Sắp chiếu</option>
                        <option value="Ngừng chiếu">Ngừng chiếu</option>
                    </select>
                </div>

                <div class="add-movie-form-group">
                    <label for="trailer">Trailer</label>
                    <input class="movies-input" id="trailer" type="text" name="trailer"
                        placeholder="Link trailer (https://www.youtube.com/watch?v=...)" required />
                </div>

                <div class="add-movie-form-group">
                    <label for="image-upload">Hình ảnh</label>
                    <input type="file" id="image-upload" name="image-upload" accept="image/*" />
                </div>

                <button type="submit" class="btn btn-success">Thêm phim</button>
            </form>
        </div>
    </div>
</x-index-admin>