<x-index-admin>
    <x-slot name="title">Quản lý lịch chiếu</x-slot>

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
        <h1 class="movies-title text-center">DANH SÁCH LỊCH CHIẾU</h1>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="d-flex justify-content-between mb-3">

            <a href="{{ route('quanlylichchieu.showForm') }}">
                <button class="movies-btn movies-add" style="font-size: 15px; font-weight: bold;" id="add-schedule-btn">
                    <p>Thêm lịch chiếu</p>
                </button>
            </a>

            <div class="d-flex">
                <div class="mb-3 mr-3">
                    <label for="start-date">Từ ngày:</label>
                    <input type="date" id="start-date" class="form-control" value="{{ $start_date }}">
                </div>
                <div class="mb-3">
                    <label for="end-date">Đến ngày:</label>
                    <input type="date" id="end-date" class="form-control" value="{{ $end_date }}">
                </div>
            </div>
        </div>

        <table class="table table-bordered" id="scheduleTable">
            <thead>
                <tr>
                    <th style="width: 10%;">Mã lịch chiếu</th>
                    <th>Tên phim</th>
                    <th>Ngày chiếu</th>
                    <th>Phòng chiếu</th>
                    <th>Suất chiếu</th>
                    <th>Loại chiếu</th>
                    <th>Giá vé</th>
                    <th style="width: 10%;">Điều chỉnh</th>
                </tr>
            </thead>
            <tbody id="schedule-list">
                @include('admin.quanlylichchieu.list', ['lichChieu' => $lichChieu])
            </tbody>
        </table>

    </div>

    <script>
    $(document).ready(function() {
        console.log("aloooo");
        var table = $('#scheduleTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('quanlylichchieu.data') }}",
                data: function(d) {
                    d.start_date = $('#start-date').val();
                    d.end_date = $('#end-date').val();
                    d.filter_date = $('#filter-date').val();
                }
            },
            language: {
                paginate: {
                    previous: "Trước",
                    next: "Tiếp"
                },
                search: "Tìm kiếm:",
                lengthMenu: "Hiển thị _MENU_ ",
                info: "Hiển thị _START_ đến _END_ của _TOTAL_ mục"
            },
            columns: [{
                    data: 'maLichChieuPhim',
                    name: 'lichchieuphim.maLichChieuPhim'
                },
                {
                    data: 'ten',
                    name: 'phim.ten'
                },
                {
                    data: 'ngayChieu',
                    name: 'lichchieuphim.ngayChieu'
                },
                {
                    data: 'tenPhongChieu',
                    name: 'phongchieuphim.tenPhongChieu'
                },
                {
                    data: 'suatChieu',
                    name: 'lichchieuphim.suatChieu'
                },
                {
                    data: 'loaiChieu',
                    name: 'lichchieuphim.loaiChieu'
                },
                {
                    data: 'giave',
                    name: 'lichchieuphim.giave'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        $('#start-date, #end-date').on('change', function() {
            table.ajax.reload();
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#scheduleTable').on('click', '.btn-delete', function() {
            console.log("Nút đã được nhấn");
            var lichChieuId = $(this).data('id'); // Lấy ID lịch chiếu
            console.log("Thực hiện xóa", lichChieuId);

            if (confirm("Bạn có chắc chắn muốn xóa lịch chiếu này?")) {
                $.ajax({
                    url: "{{ route('quanlylichchieu.destroy') }}", // Sử dụng route của Laravel
                    method: 'DELETE', // Phương thức DELETE
                    data: {
                        _token: "{{ csrf_token() }}", // CSRF token để bảo mật yêu cầu
                        lichChieuId: lichChieuId // ID của lịch chiếu cần xóa
                    },
                    success: function(response) {
                        console.log("Xóa thành công", response);
                        if (response.success) {
                            $('button[data-id="' + lichChieuId + '"]').closest('tr')
                                .remove();
                            alert("Lịch chiếu đã được xóa thành công.");
                        } else {
                            alert("Có lỗi xảy ra, vui lòng thử lại.");
                        }
                    },
                    error: function() {
                        console.log("Lỗi khi thực hiện yêu cầu xóa.");
                        alert("Lỗi khi thực hiện yêu cầu xóa.");
                    }
                });
            }
        });
        $(document).on('click', '.btn-edit', function() {
            let maLichChieu = $(this).data('id');

            window.location.href = `/admin/quanlylichchieu/edit/${maLichChieu}`;
        });

    });
    </script>
</x-index-admin>