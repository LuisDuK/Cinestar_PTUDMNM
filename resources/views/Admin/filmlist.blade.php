<x-index-admin>
    <x-slot name="title">
        Quản lý phim
    </x-slot>
    <style>
    .table {
        --bs-table-bg: white !important;
        /* Nền trắng */
        --bs-table-color: black !important;
        /* Chữ đen */
    }

    .table-striped>tbody>tr:nth-of-type(odd)>* {
        --bs-table-color-type: black !important;
        /* Ghi đè nền về trắng */
    }

    .custom-select,
    .form-control {
        background-color: white !important;
        /* Đổi màu nền */
        color: black !important;
        /* Đổi màu chữ */
        border: 1px solid #ccc;
        /* Thêm viền nhẹ */
    }

    .dt-paging-button.page-item.disabled a,
    .dt-paging-button.page-item.disabled span {
        color: #6c757d !important;
        /* Đổi màu chữ về xám */
        pointer-events: none;
        /* Ngăn người dùng nhấn vào */
        opacity: 0.6;
        /* Làm mờ để nhìn rõ là bị disabled */
    }
    </style>
    <div class="movies-container">
        <h1 class="movies-title text-center">DANH SÁCH PHIM</h1>

        <div class="movies-controls">

            <div class="movies-action-buttons">
                <a href="{{ route('quanlyphim.create') }}" class="movies-btn movies-add">Add New</a>
            </div>
        </div>

        <table id="movies-table" class="table table-striped table-bordered bg-white text-dark"
            style="background-color:white;">
            <thead>
                <tr>
                    <th>Điều chỉnh</th>
                    <th>Thumbnail</th>
                    <th>Trailer</th>
                    <th>Tên phim</th>
                    <th>Thể loại</th>
                    <th>Nước</th>
                    <th>Năm</th>
                    <th>SLSC</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody id="film-list">
                @foreach ($movies as $movie)
                <tr>
                    <td>
                        <button class="btn-delete" data-id="{{ $movie->maPhim }}">Xóa</button>
                    </td>
                    <td><img src="{{ asset($movie->hinhAnh) }}" width="50"></td>
                    <td><a href="{{ $movie->trailer }}" target="_blank">Xem</a></td>
                    <td>{{ $movie->ten }}</td>
                    <td>{{ $movie->tenLoaiPhim }}</td>
                    <td>{{ $movie->tenQuocGia }}</td>
                    <td>{{ $movie->namSanXuat }}</td>
                    <td>{{ $movie->soLuongSuatChieu }}</td>
                    <td>{{ $movie->trangThai }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>


    </div>

    <script>
    $(document).ready(function() {
        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();
            var maPhim = $(this).data('id');

            if (confirm('Bạn có chắc chắn muốn xóa phim này?')) {
                $.ajax({
                    url: "{{ route('quanlyphim.destroy') }}",
                    method: 'DELETE',
                    data: {
                        _token: "{{ csrf_token() }}",
                        maPhim: maPhim
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            loadFilmData(1);
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function() {
                        alert('Có lỗi xảy ra khi gửi yêu cầu!');
                    }
                });
            }
        });


        $('#movies-table').DataTable({
            responsive: true,
            "bStateSave": true,
            language: {
                paginate: {
                    previous: "Trước",
                    next: "Tiếp"
                },
                search: "Tìm kiếm:",
                lengthMenu: "Hiển thị _MENU_ ",
                info: "Hiển thị _START_ đến _END_ của _TOTAL_ mục"
            }
        });
    });
    </script>
</x-index-admin>