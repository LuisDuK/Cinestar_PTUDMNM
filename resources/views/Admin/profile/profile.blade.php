<x-index-admin>
    <x-slot name="title">Thông tin cá nhân</x-slot>
    <style>
    span {
        color: black;
    }
    </style>
    <div class="schedule-container" style="height: 650px;">
        <h1 style="text-align:center; font-size:40px; padding:10px;"><b>Thông tin cá nhân </b></h1>
        <div class="private-information" style="display: flex; justify-content: space-between; gap: 20px;">

            <!-- Thông tin nhân viên (Bên trái) -->
            <div class="employee-info" style="width: 60%; margin-left:20px;">
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
                <!-- Thông tin nhân viên -->
                <div class="mb-3">
                    <label for="name" class="form-label" style="display: inline;">Họ tên:</label>
                    <strong><span>{{ $employee->name }}</span></strong>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label" style="display: inline;">Email:</label>
                    <strong><span>{{ $employee->email }}</span></strong>
                </div>

                <div class="mb-3">
                    <label for="gender" class="form-label" style="display: inline;">Giới tính:</label>
                    <strong>
                        <span>
                            @if($employee->gender == 'male')
                            Nam
                            @elseif($employee->gender == 'female')
                            Nữ
                            @else
                            Khác
                            @endif
                        </span>
                    </strong>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label" style="display: inline;">Địa chỉ:</label>
                    <strong><span>{{ $employee->address }}</span></strong>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label" style="display: inline;">Số điện thoại:</label>
                    <strong><span>{{ $employee->phone }}</span></strong>
                </div>


                <form action="{{ route('quanlynhansu.change-password', $employee->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <!-- Chỉ có trường mật khẩu mới và xác nhận mật khẩu mới -->
                    <div class="mb-3">
                        <label for="new_password" class="form-label">Mật khẩu mới</label>
                        <input type="password" name="new_password" class="form-control"
                            style="color:black; background-color:white;" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_password_confirmation" class="form-label">Xác nhận mật khẩu mới</label>
                        <input type="password" name="new_password_confirmation"
                            style="color:black; background-color:white;" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <!-- Nút Lưu mật khẩu -->
                        <button type="submit" class="btn btn-primary">Lưu mật khẩu mới</button>
                    </div>
                </form>
            </div>

            <!-- Hình ảnh hiện tại (Bên phải) -->
            <div class="employee-image"
                style="width: 40%; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                <div class="image-preview-wrapper"
                    style="width: 170px; height: 200px; display: flex; justify-content: center; align-items: center; margin-top: 15px;">
                    @if($employee->avatar)
                    <img src="{{ asset('storage/profile/'.$employee->avatar) }}" width="100" alt="Avatar">
                    @else
                    <p>Chưa có hình ảnh.</p>
                    @endif
                </div>
                <label><b>Ảnh đại diện</b></label>

                <form action="{{ route('profile.updateAvatar', $employee->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="avatar" class="form-label">Chọn ảnh mới (nếu muốn thay đổi)</label>
                        <input type="file" name="avatar" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Cập nhật ảnh đại diện</button>
                </form>
            </div>

        </div>
    </div>

</x-index-admin>