<x-index-admin>
    <x-slot name="title">Quản lý nhân sự</x-slot>
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

    .table.dataTable thead>tr>th {
        padding-right: 5px !important;
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

    input[type="radio"] {
        appearance: none;
        /* Loại bỏ kiểu mặc định */
        width: 18px;
        height: 18px;
        border: 2px solid #007bff;
        /* Viền xanh */
        border-radius: 50%;
        /* Hình tròn */
        outline: none;
        display: block;
        cursor: pointer;
        position: relative;
        background-color: white;
        /* Nền trắng để không bị trùng màu */
    }

    /* Khi được chọn, thêm màu nền */
    input[type="radio"]:checked {
        background-color: #007bff;
        border: 2px solid #0056b3;
    }
    </style>
    <div class="movies-container" style="height:auto;">
        <h1 class="movies-title" style="text-align: center;">Danh sách nhân viên</h1>
        <div class="movies-controls" style="margin-bottom:10px;">

            <button type="button" class="movies-btn movies-add" data-bs-toggle="modal" data-bs-target="#addNewModal">
                Thêm nhân sự
            </button>
        </div>
        @if(session('success'))
        <div class="alert alert-success" style="background-color: white; ">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger" style="background-color: white;">
            {{ session('error') }}
        </div>
        @endif
        @if ($errors->has('new_password'))
        <div class="alert alert-danger" style="background-color: white; ">
            <ul>
                <li>{{ $errors->first('new_password') }}</li>
            </ul>
        </div>
        @endif
        <table id="employees-table" class="table table-striped table-bordered bg-white text-dark"
            style="background-color:white;">
            <thead>
                <tr>
                    <th>Mã NV</th>
                    <th>Họ tên</th>
                    <th>Giới tính</th>
                    <th>Hình ảnh</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Trạng thái</th>
                    <th width="11%">Điều chỉnh</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $employee)
                <tr>
                    <td>{{ $employee->id }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>
                        @php

                        $genderMap = [
                        'male' => 'Nam',
                        'female' => 'Nữ',
                        'other' => 'Khác',
                        ];
                        @endphp

                        {{ $genderMap[$employee->gender] ?? 'Không xác định' }}
                    </td>
                    <td>
                        @if($employee->avatar)
                        <img src="{{ asset('storage/profile/'.$employee->avatar) }}" width="50">
                        @endif
                    </td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->phone }}</td>
                    <td>
                        @if($employee->status == 1)
                        <span style="color: green;">Hoạt động</span>
                        @else
                        <span $employee="color: red;">Không hoạt động</span>
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-info btn-sm me-2 w-100" data-bs-toggle="modal"
                            data-bs-target="#detailModal{{ $employee->id }}">
                            Xem chi tiết
                        </button>
                        <button type="button" class="btn btn-warning btn-sm w-100" data-bs-toggle="modal"
                            data-bs-target="#changePasswordModal{{ $employee->id }}">
                            Đổi mật khẩu
                        </button>
                        <form action="{{ route('quanlynhansu.destroy', $employee->id) }}" method="POST"
                            onsubmit="return confirm('Bạn có chắc muốn xóa nhân viên này không?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm w-100">
                                Xóa nhân viên
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @foreach($employees as $employee)
        <!-- Modal cho thông tin chi tiết -->
        <div class="modal fade" id="detailModal{{ $employee->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thông tin chi tiết nhân viên</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('quanlynhansu.update', $employee->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <!-- Thông tin nhân viên -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Họ tên</label>
                                <input type="text" name="name" class="form-control" value="{{ $employee->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $employee->email }}">
                            </div>
                            <div class="mb-3">
                                <label for="gender" class="form-label">Giới tính</label>
                                <select name="gender" class="form-select" style="color:black; background-color:white;">
                                    <option value="male" {{ $employee->gender == 'male' ? 'selected' : '' }}>Nam
                                    </option>
                                    <option value="female" {{ $employee->gender == 'female' ? 'selected' : '' }}>Nữ
                                    </option>
                                    <option value="other" {{ $employee->gender == 'other' ? 'selected' : '' }}>Khác
                                    </option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Địa chỉ</label>
                                <input type="text" name="address" class="form-control" value="{{ $employee->address }}">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Số điện thoại</label>
                                <input type="text" name="phone" class="form-control" value="{{ $employee->phone }}">
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Trạng thái</label>
                                <select name="status" class="form-select" style="color:black; background-color:white;">
                                    <option value="1" {{ $employee->status == 1 ? 'selected' : '' }}>Hoạt động</option>
                                    <option value="0" {{ $employee->status == 0 ? 'selected' : '' }}>Ngừng hoạt động
                                    </option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="avatar" class="form-label">Hình ảnh hiện tại</label>
                                @if($employee->avatar)
                                <div>
                                    <img src="{{ asset('storage/profile/'.$employee->avatar) }}" width="100"
                                        alt="Avatar">
                                </div>
                                @else
                                <p>Chưa có hình ảnh.</p>
                                @endif
                            </div>

                            <!-- Chọn file thay đổi hình ảnh -->
                            <div class="mb-3">
                                <label for="hinhAnh" class="form-label">Chọn ảnh mới (nếu muốn thay đổi)</label>
                                <input type="file" name="avatar" class="form-control">
                            </div>
                            <div class="modal-footer">
                                <!-- Nút Lưu thông tin điều chỉnh -->
                                <button type="submit" class="btn btn-primary">Lưu thông tin điều chỉnh</button>

                                <!-- Nút Đổi mật khẩu -->

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Đổi mật khẩu -->
        <div class="modal fade" id="changePasswordModal{{ $employee->id }}" tabindex="-1"
            aria-labelledby="changePasswordModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="changePasswordModalLabel">Đổi mật khẩu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('quanlynhansu.change-password', $employee->id) }}" method="POST">
                            @csrf
                            <!-- Mật khẩu mới -->
                            <div class="mb-3">
                                <label for="new_password" class="form-label">Mật khẩu mới</label>
                                <input type="password" class="form-control" name="new_password" required>
                            </div>

                            <!-- Nhập lại mật khẩu mới -->
                            <div class="mb-3">
                                <label for="new_password_confirmation" class="form-label">Nhập lại mật khẩu</label>
                                <input type="password" class="form-control" name="new_password_confirmation" required>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Đổi mật khẩu</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="modal fade" id="addNewModal" tabindex="-1" aria-labelledby="addNewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewModalLabel">Thêm Nhân Sự</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('quanlynhansu.save') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="hoTen" class="form-label">Họ tên:</label>
                            <input type="text" name="hoTen" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="ngaySinh" class="form-label">Ngày sinh:</label>
                            <input type="date" name="ngaySinh" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Giới tính:</label>
                            <div class="form-check">
                                <input type="radio" name="gioiTinh" value="Nam" class="form-check-input" required>
                                <label class="form-check-label">Nam</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="gioiTinh" value="Nữ" class="form-check-input" required>
                                <label class="form-check-label">Nữ</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="gioiTinh" value="Khác" class="form-check-input" required>
                                <label class="form-check-label">Khác</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="soDienThoai" class="form-label">Số điện thoại:</label>
                            <input type="text" name="soDienThoai" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="diaChi" class="form-label">Địa chỉ:</label>
                            <input type="text" name="diaChi" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="hinhAnh" class="form-label">Hình ảnh:</label>
                            <input type="file" name="hinhAnh" class="form-control" accept="image/*">
                        </div>

                        <div class="mb-3">
                            <label for="trangThai" class="form-label">Trạng thái:</label>
                            <select name="trangThai" class="form-select" style="color:black; background-color:white;">
                                <option value="Hoạt động">Hoạt động</option>
                                <option value="Khóa">Khóa</option>
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $('#employees-table').DataTable({
            responsive: true,
            "bStateSave": true,
            "pageLength": 10,
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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</x-index-admin>