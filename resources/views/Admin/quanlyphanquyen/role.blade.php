<x-index-admin>
    <x-slot name="title">
        Quản lý phân quyền
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
    <div class="movies-container" style="height:auto;">
        <h1 class="movies-title" style="text-align: center;">Quản lý phân quyền theo chức năng</h1>
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
        <div class="row">
            <!-- Danh sách nhân viên -->
            <div class="col-md-5">
                <h2>Danh sách nhân viên</h2>
                <table id="employee-table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Mã NV</th>
                            <th>Họ tên</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                        <tr onclick="loadPermissions({{ $employee->id }})" style="cursor: pointer;">
                            <td>{{ $employee->id }}</td>
                            <td>{{ $employee->name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <!-- Danh sách chức năng -->
            <div class="col-md-7">
                <h4>Chức năng của nhân viên</h4>
                <table class="table" id="permission-table">
                    <thead>
                        <tr>
                            <th>Mã CN</th>
                            <th>Tên Chức Năng</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>

                <!-- Form thêm quyền -->
                <form action="{{ route('quanlyphanquyen.assign') }}" method="POST">
                    @csrf
                    <input type="hidden" id="selectedEmployee" name="maNV">
                    <div class="mb-3">
                        <label for="maChucNang" class="form-label">Thêm chức năng:</label>
                        <select name="maChucNang" class="form-select" id="chucnang-select"
                            style="color:black; background-color: white;">
                            <!-- Dữ liệu sẽ được cập nhật bằng AJAX -->
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Thêm quyền</button>
                </form>
            </div>
        </div>
    </div>


    <script>
    function loadPermissions(employeeId) {
        $('#selectedEmployee').val(employeeId); // Gán ID nhân viên vào input ẩn

        $.ajax({
            url: `/admin/quanlyphanquyen/${employeeId}`,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                let tableBody = $("#permission-table tbody");
                tableBody.empty(); // Xóa dữ liệu cũ trong bảng

                // Cập nhật bảng quyền đã có
                data.forEach(permission => {
                    tableBody.append(`<tr>
        <td>${permission.maChucNang}</td>
        <td>${permission.tenChucNang}</td>
        <td>
            <button class="btn btn-danger btn-sm" onclick="removePermission(${employeeId}, '${permission.maChucNang}')">Xóa</button>
        </td>
    </tr>`);
                });

                // Gọi API lấy danh sách quyền chưa có
                $.ajax({
                    url: `/admin/quanlyphanquyen/quyencanhan/${employeeId}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function(availableFunctions) {
                        let selectBox = $("#chucnang-select");
                        selectBox.empty(); // Xóa danh sách quyền trước đó

                        availableFunctions.forEach(p => {
                            selectBox.append(
                                `<option value="${p.maChucNang}">${p.tenChucNang}</option>`
                            );
                        });
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error("Lỗi khi tải quyền:", error);
            }
        });
    }

    function removePermission(employeeId, permissionId) {
        if (confirm("Bạn có chắc chắn muốn xóa quyền này không?")) {
            $.ajax({
                url: `/admin/quanlyphanquyen/quyencanhan/xoa/${employeeId}/${permissionId}`,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    alert("Đã xóa quyền thành công!");
                    loadPermissions(employeeId); // Cập nhật lại danh sách quyền
                },
                error: function(xhr, status, error) {
                    console.error("Lỗi khi xóa quyền:", error);
                }
            });
        }
    }


    $(document).ready(function() {
        $('#employee-table').DataTable({
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
                info: "Hiển thị _START_ đến _END_ của _TOTAL_ mục",
            }
        });
        $('#permission-table').DataTable({
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
                info: "Hiển thị _START_ đến _END_ của _TOTAL_ mục",
            }
        });
    });
    </script>
</x-index-admin>