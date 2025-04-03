<x-index-admin>
    <x-slot name="title">Quản lý phòng chiếu</x-slot>
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

    .modal-content {
        background-color: #f8f9fa !important;

        color: #212529;

        border-radius: 8px;

    }

    .modal-header {
        background-color: #007bff !important;

        color: white !important;

    }

    .modal-footer {
        background-color: #f1f1f1;

    }
    </style>
    <div class="movies-container" style="height:700px; justify-content: center;">
        <h1 class="movies-title text-center">Quản lý phòng chiếu</h1>

        <!-- Nút mở Modal Thêm -->
        <button class="movies-btn movies-add" data-bs-toggle="modal" data-bs-target="#addRoomModal"
            style="margin-bottom:10px;">Thêm phòng
            chiếu</button>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table id="room-table" class="table table-striped" style="text-align:center;">
            <thead>
                <tr>
                    <th>Mã Phòng</th>
                    <th>Tên Phòng</th>
                    <th>Số Ghế</th>
                    <th>Tình trạng</th>
                    <th style="width: 15%;">Số hàng</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rooms as $room)
                <tr>
                    <td>{{ $room->maPhongChieu }}</td>
                    <td>{{ $room->tenPhongChieu }}</td>
                    <td>{{ $room->soLuongGhe }}</td>
                    <td>{{ $room->trangThaiPhongChieu }}</td>
                    <td>{{ $room->soHang }}</td>
                    <td>
                        <!-- Nút mở Modal Sửa -->
                        <button class="btn btn-warning btn-sm edit-room-btn" data-bs-toggle="modal"
                            data-bs-target="#editRoomModal" data-id="{{ $room->maPhongChieu }}"
                            data-name="{{ $room->tenPhongChieu }}" data-seats="{{ $room->soLuongGhe }}"
                            data-status="{{ $room->trangThaiPhongChieu }}" data-rows="{{ $room->soHang }}">
                            Sửa
                        </button>

                        <!-- Nút Xóa -->
                        <form action="{{ route('quanlyphongchieu.destroy', $room->maPhongChieu) }}" method="POST"
                            class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Bạn có chắc chắn muốn xóa phòng này?')">Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $rooms->links() }}
    </div>

    <!-- Modal Thêm Phòng -->
    <div class="modal fade" id="addRoomModal" tabindex="-1" aria-labelledby="addRoomModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm phòng chiếu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('quanlyphongchieu.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Tên phòng:</label>
                            <input type="text" name="tenPhong" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Số ghế:</label>
                            <input type="number" name="soGhe" class="form-control" min="1" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Trạng thái:</label>
                            <select name="trangThai" class="form-control">
                                <option value="Hoạt động">Hoạt động</option>
                                <option value="Bảo trì">Bảo trì</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Số hàng:</label>
                            <input type="number" name="soHang" class="form-control" min="1" required>
                        </div>
                        <button type="submit" class="btn btn-success">Thêm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Sửa Phòng -->
    <div class="modal fade" id="editRoomModal" tabindex="-1" aria-labelledby="editRoomModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Chỉnh sửa phòng chiếu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editRoomForm" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" id="editRoomId" name="maPhongChieu">
                        <div class="mb-3">
                            <label class="form-label">Tên phòng:</label>
                            <input type="text" id="editRoomName" name="tenPhong" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Số ghế:</label>
                            <input type="number" id="editRoomSeats" name="soGhe" class="form-control" min="1" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Trạng thái:</label>
                            <select id="editRoomStatus" name="trangThai" class="form-control">
                                <option value="available">Hoạt động</option>
                                <option value="maintenance">Bảo trì</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Số hàng:</label>
                            <input type="number" id="editRoomRows" name="soHang" class="form-control" min="1" required>
                        </div>

                        <button type="submit" class="btn btn-success">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Script xử lý Modal -->
    <script>
    $(document).ready(function() {
        $('#room-table').DataTable({
            responsive: true,
            language: {
                paginate: {
                    previous: "Trước",
                    next: "Tiếp"
                },
                search: "Tìm kiếm:",
                lengthMenu: "Hiển thị _MENU_ phòng",
                info: "Hiển thị _START_ đến _END_ của _TOTAL_ phòng"
            }
        });

        // Load dữ liệu vào modal sửa
        $(".edit-room-btn").on("click", function() {
            let roomId = $(this).data("id");
            let roomName = $(this).data("name");
            let roomSeats = $(this).data("seats");
            let roomStatus = $(this).data("status");
            let roomRows = $(this).data("rows"); // Dữ liệu số hàng

            $("#editRoomId").val(roomId);
            $("#editRoomName").val(roomName);
            $("#editRoomSeats").val(roomSeats);
            $("#editRoomStatus").val(roomStatus);
            $("#editRoomRows").val(roomRows); // Đổ dữ liệu số hàng

            let updateUrl = "{{ route('quanlyphongchieu.update', ':id') }}".replace(':id', roomId);
            $("#editRoomForm").attr("action", updateUrl);
        });
    });
    </script>
</x-index-admin>